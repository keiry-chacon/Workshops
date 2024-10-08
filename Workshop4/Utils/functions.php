<?php

/**
 *  Gets the provinces from the database
 */
function getProvinces(): array {
    $conn = getConnection();
    // Consulta SQL para seleccionar todas las provincias
    $sql    = "SELECT * FROM provincia";
    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Recorrer los resultados y agregar al array
        while ($row = $result->fetch_assoc()) {
            $provinces[$row['Id']] = $row['Nombre'];
        }
    } else {
        throw new Exception("No se encontraron provincias.");
    }

    // Cerrar la conexión
    $conn->close();


// Retornar el array con las provincias
return $provinces;
}


function getConnection(): bool|mysqli {
    $servername = "localhost"; // Nombre del servidor donde está la BD
    $username   = "root"; // Usuario por defecto
    $password   = ""; // Contraseña (vacía por defecto)
    $dbname     = "workshop3"; // Nombre de la base de datos

    try {
        // Crear la conexión usando la extensión mysqli
        $conn = new mysqli($servername, $username, $password, $dbname, 3306);

        // Verificar si hay errores de conexión
        if ($conn->connect_error) {
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }

        return $conn; // Retorna el objeto de conexión si es exitosa
    } catch (Exception $e) {
        // Manejar el error de conexión
        echo "Error de conexión: " . $e->getMessage();
        return false; // Retorna false si hay algún problema
    }
}

/**
 * Saves an specific user into the database
 */function updateUser($user) {
    $conn = getConnection(); // Conexión a la base de datos

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta
    if (!empty($user['Contrasena'])) {
        // Cifrar la contraseña de manera segura
        $contrasena = md5($user['Contrasena']);
        // Consulta SQL para actualizar el usuario
        $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Usuario = ?, Contrasena = ?, Id_Provincia = ?, Estado = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisi", $user['Nombre'], $user['Apellido'], $user['Usuario'], $contrasena, $user['Id_Provincia'], $user['Estado'], $user['Id']);
    } else {
        // Consulta SQL sin actualizar la contraseña
        $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Usuario = ?, Id_Provincia = ?, Estado = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiii", $user['Nombre'], $user['Apellido'], $user['Usuario'], $user['Id_Provincia'], $user['Estado'], $user['Id']);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $result = true; // La actualización fue exitosa
    } else {
        $result = false; // Hubo un error al ejecutar la consulta
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();

    return $result; // Devolver el resultado de la operación
}


 function getID($Id): array {
    $conn = getConnection(); // Conexión a la base de datos

    // Preparar la consulta SQL con un marcador de posición
    $sql = "SELECT Id, Nombre, Apellido, Usuario, Estado, Id_Provincia FROM usuario WHERE Id = ? ";

    // Preparamos la consulta
    $stmt = $conn->prepare($sql);

    // Vinculamos el parámetro
    $stmt->bind_param("i", $Id); // 'i' indica que es un número entero

    // Ejecutamos la consulta
    $stmt->execute();

    // Obtenemos el resultado
    $result = $stmt->get_result();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Solo esperamos un usuario, así que usamos fetch_assoc()
        $user = $result->fetch_assoc();

        return $user; // Retornamos el array asociativo con los datos del usuario
    } else {
        return []; // Retornar un array vacío si no hay resultados
    }

    // Cerramos la declaración y la conexión
    $stmt->close();
    $conn->close();
}

function getAllUsers(): array {
    $conn = getConnection(); // Conexión a la base de datos

    // Consulta SQL para obtener los usuarios con el nombre de la provincia
    $sql = "SELECT u.Id, u.Nombre, u.Apellido, u.Usuario,u.Estado,p.Nombre as Provincia
            FROM usuario u
            JOIN provincia p ON u.Id_Provincia = p.Id
            Where  Estado = 1";

    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        $users = [];
        // Recorrer los resultados y agregarlos al array
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users; // Retornar el array con los usuarios
    } else {
        return []; // Retornar un array vacío si no hay resultados
    }
}
function saveUser(): bool{
    $conn = getConnection();

    $query = "SELECT Id FROM usuario ORDER BY Id DESC LIMIT 1";
    // se ejecuta la consulta y el resultado se almacena en la variable result
    $result = $conn->query($query);
    
    // Verificar si el resultado es mayor a 1
    if ($result->num_rows > 0) {
        // Si hay registros, obtener el último Id y sumarle 1
        //fetch_assoc lo convierte en un array asociativo es decir clave y valor para que sea mas facil acceder
        $row = $result->fetch_assoc();
        $nuevoId = $row['Id'] + 1;
    } else {
        // Si no hay registros, el nuevo Id será 1
        $nuevoId = 1;
    }
    $firstName   = $_REQUEST['firstName'];
    $lastName    = $_REQUEST['lastName'];
    $user        = $_REQUEST['user'];
    $provinceId  = $_REQUEST['province'];
    $password    = md5($_REQUEST['password']);

    // SQL para insertar en la tabla users incluyendo el ID de la provincia
    $sql = "INSERT INTO usuario (Id,Nombre, Apellido, Usuario, Contrasena, Id_Provincia) VALUES ($nuevoId,'$firstName', '$lastName', '$user', '$password', $provinceId)";
  try {
    mysqli_query($conn, $sql);
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

/**
 * Get one specific student from the database
 *
 * @id Id of the student
 */
function authenticate($username, $password): bool|array|null{
  $conn     = getConnection();
  $password = md5($password);
  $sql      = "SELECT * FROM usuario WHERE `Usuario` = '$username' AND `Contrasena` = '$password'";
  $result = $conn->query($sql);

  try {
    $result = $conn->query($sql);
    
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    
    $results = $result->fetch_array();
    $conn->close();
    return $results;
    
} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), "Table 'workshop3.usuario' doesn't exist") !== false) {
        // Redirigir con el mensaje de error en la URL
        header("Location: ../index.php?error=¡No estás registrado aún! Por favor regístrate para continuar.");
        exit();
    } else {
        // Si es otro error, redirigir con un mensaje genérico
        header("Location: ../index.php?error=Error en la base de datos.");
        exit();
    }
}
}
<?php

function Connection(): bool|mysqli {
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
function getProvinces(): array {
    $conn = Connection();
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

function saveUser(): bool{
    $conn = Connection();
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
    $conn = Connection();
    mysqli_query($conn, $sql);
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}
function getAllUsers(): array {
    $conn = Connection(); // Conexión a la base de datos

    // Consulta SQL para obtener los usuarios con el nombre de la provincia
    $sql = "SELECT u.Id, u.Nombre, u.Apellido, u.Usuario, p.Nombre as Provincia
            FROM usuario u
            JOIN provincia p ON u.Id_Provincia = p.Id";

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
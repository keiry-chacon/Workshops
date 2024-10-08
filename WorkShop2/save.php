<?php
// Incluiye el archivo para la conexion con la bd
include 'conection.php';

// Obtener los datos del formulario
$nombre   = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$telefono = $_REQUEST['telefono'];
$correo   = $_REQUEST['correo'];

// Obtener el último Id de la bd
$query = "SELECT Id FROM registro ORDER BY Id DESC LIMIT 1";
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

//stmt objeto que representa una declaracion preparada
// Preparar la consulta SQL para insertar con el nuevo Id
$stmt = $conn->prepare("INSERT INTO registro (Id, Nombre, Apellido, Telefono, Correo) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $nuevoId, $nombre, $apellido, $telefono, $correo);// issss indica los tipos de datos

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Datos guardados correctamente";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
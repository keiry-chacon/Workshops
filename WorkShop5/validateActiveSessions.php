<?php
// validateActiveSessions.php

// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workshop3";

try {
    // Crear conexión con mysqli
    $conn = new mysqli($servername, $username, $password, $dbname, 3306);

    // Verificar si hay errores en la conexión
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    echo "Conexión exitosa.\n"; // Mensaje de depuración

    // Verificar si se ha pasado un parámetro de horas
    if ($argc !== 2) {
        die("Uso: php validateActiveSessions.php <horas>\n");
    }

    echo "Parámetro de horas recibido: " . $argv[1] . "\n"; // Mensaje de depuración

    // Obtener el valor de horas desde la línea de comandos
    $hoursParam = (int)$argv[1];
    if ($hoursParam <= 0) {
        die("El valor de horas debe ser un número positivo mayor a 0.\n");
    }

    // Consulta para obtener todos los usuarios activos
    $sql = "SELECT Id, fecha_ultimo_login, Estado FROM usuarios WHERE Estado = 1";
    
    echo "Ejecutando la consulta para obtener usuarios activos...\n"; // Mensaje de depuración
    // Ejecutar la consulta
    $result = $conn->query($sql);
    
    // Verificar si se encontraron usuarios activos
    if ($result === false) {
        die("Error en la consulta: " . $conn->error . "\n"); // Mensaje de depuración
    }

    echo "Consulta ejecutada. Resultados: " . $result->num_rows . "\n"; // Mensaje de depuración

    if ($result->num_rows > 0) {
        // Iterar sobre los usuarios activos
        while ($row = $result->fetch_assoc()) {
            $userId = $row['Id'];
            $lastLogin = $row['fecha_ultimo_login'];

            // Convertir la fecha_ultimo_login a un objeto DateTime
            $lastLoginDateTime = new DateTime($lastLogin);
            $currentDateTime = new DateTime();

            // Calcular la diferencia entre las dos fechas
            $interval = $lastLoginDateTime->diff($currentDateTime);
            $hoursElapsed = ($interval->days * 24) + $interval->h;

            // Comparar si las horas transcurridas son mayores al parámetro
            if ($hoursElapsed > $hoursParam) {
                // Marcar el estado como 'inactive'
                $updateQuery = "UPDATE usuarios SET Estado = 0 WHERE Id = ?";
                if ($updateStmt = $conn->prepare($updateQuery)) {
                    $updateStmt->bind_param("i", $userId);
                    $updateStmt->execute();
                    echo "Usuario con ID " . $userId . " marcado como inactivo. Han pasado " . $hoursElapsed . " horas desde el último login.\n";
                } else {
                    echo "Error al preparar la actualización para el usuario con ID: " . $userId . "\n";
                }
            } else {
                echo "Usuario con ID " . $userId . " permanece activo. Han pasado " . $hoursElapsed . " horas desde el último login.\n";
            }
        }
    } else {
        echo "No se encontraron usuarios activos.\n";
    }

    // Cerrar la conexión
    $conn->close();
    echo "Conexión cerrada.\n"; // Mensaje de depuración

} catch (Exception $e) {
    // Manejar errores de conexión
    echo "Error de conexión: " . $e->getMessage();
}



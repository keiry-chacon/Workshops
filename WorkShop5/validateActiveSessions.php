<?php
// validateActiveSessions.php

    // Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workshop3";
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
    
    // Ejecutar la consulta
    echo "Ejecutando la consulta para obtener usuarios activos...\n"; // Mensaje de depuración
    $result = $conn->query($sql);
    
    // Verificar si se encontraron usuarios activos
    if ($result->num_rows > 0) {
        echo "Se encontraron " . $result->num_rows . " usuarios activos.\n"; // Mensaje de depuración
        // ... (resto del código)
    } else {
        echo "No se encontraron usuarios activos.\n";
    }

    // Cerrar la conexión
    $conn->close();



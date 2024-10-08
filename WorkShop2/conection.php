<?php
$servername = "localhost"; //Nombre del servif¿dor donde esta la BD
$username = "root";//usuario por defecto
$password = "";
$dbname = "formulario";// nombre d ela bd

// Crear la conexión, creando una instancia de mysqli ( extension para bd)
$conn = new mysqli($servername, $username, $password, $dbname,3306);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);// si la conexion falla
}

?>
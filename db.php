<?php
$servername = "localhost";
$username = "root";
$password = "Miamor.2011";
$dbname = "edulink";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
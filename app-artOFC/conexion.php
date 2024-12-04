<?php
$servername = "localhost"; // Cambia si tu servidor tiene un nombre diferente
$username = "root";  // Cambia por tu usuario de la base de datos
$password = "Coralito10"; // Cambia por tu contraseña de la base de datos
$database = "arte-app"; // Cambia por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>
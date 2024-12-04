<?php

include 'conexion.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Corrección del paréntesis de cierre en la consulta SQL
$query = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) 
          VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena')";

// Usar la variable de conexión correcta: $conn
$resultado = mysqli_query($conn, $query);

if ($resultado) {
    // Redirigir al formulario de inicio de sesión
    header("Location: login.html"); // Cambia 'login.html' al nombre de tu archivo de formulario de inicio de sesión
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
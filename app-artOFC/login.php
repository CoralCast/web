<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];


if (empty($usuario) || empty($contrasena)) {
    echo "Por favor, complete todos los campos.";
    exit();
}


$query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) > 0) {
    
    $_SESSION['usuario'] = $usuario;
    echo "Inicio de sesión exitoso. Bienvenido $usuario.";

    header("Location: index.php");
} else {
    echo "Usuario o contraseña incorrectos.";
}

?>

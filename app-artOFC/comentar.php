<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    echo "Error: debes iniciar sesión para comentar.";
    exit();
}

$usuario = $_SESSION['usuario'];
$post_id = $_POST['post_id'];
$comentario = $_POST['comentario'];

$query = "INSERT INTO comentarios (post_id, usuario, comentario) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $post_id, $usuario, $comentario);
if ($stmt->execute()) {
    echo "Comentario añadido.";
} else {
    echo "Error al añadir el comentario.";
}
$stmt->close();
$conn->close();
header("Location: posts.php");
exit();
?>

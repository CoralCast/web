<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    echo "Error: Debes iniciar sesión para dar like.";
    exit();
}

$usuario = $_SESSION['usuario'];
$post_id = $_POST['post_id'];

$query_check = "SELECT * FROM likes WHERE post_id = ? AND usuario = ?";
$stmt = $conn->prepare($query_check);
$stmt->bind_param("is", $post_id, $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Ya diste like a esta publicación.";
} else {
    $query = "INSERT INTO likes (post_id, usuario) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $post_id, $usuario);
    if ($stmt->execute()) {
        echo "Like registrado.";
    } else {
        echo "Error al dar like.";
    }
}
$stmt->close();
$conn->close();
?>

<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    echo "Error: no has iniciado sesión.";
    exit();
}

$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $imagen = $_FILES['file']['name'];
    $ruta = 'uploads/' . basename($imagen); // Ruta relativa

    // Verificar si hubo un error en la subida
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo "Error al subir archivo: " . $_FILES['file']['error'];
        exit();
    }

    // Mover el archivo subido a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta)) {
        // Guardar la ruta relativa en la base de datos
        $query = "INSERT INTO posts (usuario, imagen) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $usuario, $ruta);
        if ($stmt->execute()) {
            echo "Publicación subida con éxito.";
        } else {
            echo "Error al subir la publicación a la base de datos.";
        }
        $stmt->close();
    } else {
        echo "Error al mover el archivo.";
    }
} else {
    echo "No se seleccionó ningún archivo o el método de envío no es POST.";
}
$conn->close();
?>

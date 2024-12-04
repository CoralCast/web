<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo "Error: No has iniciado sesión.";
    exit();
}

// Obtener el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];

// Obtener los datos enviados desde el formulario
$carrito = json_decode($_POST['carrito'], true); // Decodificar el JSON del carrito
$monto_total = $_POST['monto_total'];

// Validar los datos
if (empty($carrito) || $monto_total <= 0) {
    echo "Error: datos de la compra no válidos.";
    exit();
}

// Insertar la venta en la base de datos
$query = "INSERT INTO ventas (usuario, monto_total) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sd", $usuario, $monto_total);

if ($stmt->execute()) {
    $venta_id = $stmt->insert_id;

  
    foreach ($carrito as $producto) {
        $titulo = $producto['titulo'];
        $cantidad = $producto['cantidad'];
        $precio = $producto['precio'];
        $subtotal = $cantidad * $precio;

        $query_detalle = "INSERT INTO detalles_venta (venta_id, producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt_detalle = $conn->prepare($query_detalle);
        $stmt_detalle->bind_param("isidd", $venta_id, $titulo, $cantidad, $precio, $subtotal);
        $stmt_detalle->execute();
        $stmt_detalle->close();
    }

    echo "Compra registrada exitosamente. Gracias por su compra.";
} else {
    echo "Error al registrar la compra.";
}
$stmt->close();
$conn->close();
?>

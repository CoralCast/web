<?php
include 'conexion.php';

// Consulta para agrupar ventas por usuario
$query = "SELECT usuario, SUM(monto_total) AS total_ventas FROM ventas GROUP BY usuario";
$result = mysqli_query($conn, $query);

// Crear un arreglo para los datos
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

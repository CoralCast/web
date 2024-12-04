<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Consulta para agrupar ventas por producto
$query_productos = "SELECT producto, SUM(cantidad) AS total_cantidad, SUM(subtotal) AS total_ventas FROM detalles_venta GROUP BY producto";
$result_productos = mysqli_query($conn, $query_productos);

// Crear un arreglo para pasar datos al frontend
$data_productos = [];
while ($row = mysqli_fetch_assoc($result_productos)) {
    $data_productos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráficas - Vivid Art</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <h1>Gráficas de Ventas</h1>

    <!-- Gráfica de cantidades vendidas por producto -->
    <h2>Cantidad Vendida por Producto</h2>
    <canvas id="cantidadChart" width="400" height="200"></canvas>

    <!-- Gráfica de ventas totales por producto -->
    <h2>Ventas Totales por Producto</h2>
    <canvas id="ventasChart" width="400" height="200"></canvas>

    <script>
      // Datos obtenidos desde el backend
      const productosData = <?php echo json_encode($data_productos); ?>;

      // Extraer productos y datos para las gráficas
      const productos = productosData.map(item => item.producto);
      const cantidades = productosData.map(item => item.total_cantidad);
      const ventas = productosData.map(item => item.total_ventas);

      // Gráfica de Cantidades Vendidas
      const ctxCantidad = document.getElementById('cantidadChart').getContext('2d');
      new Chart(ctxCantidad, {
        type: 'bar',
        data: {
          labels: productos, // Productos en el eje X
          datasets: [{
            label: 'Cantidad Vendida',
            data: cantidades, // Cantidades en el eje Y
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Cantidad Vendida por Producto' }
          }
        }
      });

      // Gráfica de Ventas Totales
      const ctxVentas = document.getElementById('ventasChart').getContext('2d');
      new Chart(ctxVentas, {
        type: 'bar',
        data: {
          labels: productos, // Productos en el eje X
          datasets: [{
            label: 'Ventas Totales ($)',
            data: ventas, // Ventas totales en el eje Y
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Ventas Totales por Producto' }
          }
        }
      });
    </script>
  </div>
</body>
</html>

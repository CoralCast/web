<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: login.html");
    exit();
}

// Obtener el nombre del usuario de la sesión
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vivid Art</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="container">
    <header class="header">
      <nav>
        <ul class="menu">
          <li><a href="inicio.php">Inicio</a></li>
          <li><a href="posts.php">Posts</a></li>
          <li><a href="ventas.html">Ventas</a></li>
          <li><a href="perfil.php">Perfil</a></li>
        </ul>
      
      </nav>
    </header>
    
    <div class="bienvenida">
      <div class="texto-bienvenida">
      <h1>BIENVENIDO, <?php echo htmlspecialchars($usuario); ?>!</h1>
        <p>En esta plataforma encontrarás todo tipo de arte</p>
        <div class="iconos">
          <a href="#instagram"><i class="fab fa-instagram"></i></a>
          <a href="#facebook"><i class="fab fa-facebook"></i></a>
          <a href="#twitter"><i class="fab fa-twitter"></i></a>
          <a href="#tiktok"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="testimonios">
    <div class="card">
      <img src="https://i.pinimg.com/564x/1f/b6/ed/1fb6ed5c6fa4d5cf3347fd1cf746700c.jpg" alt="Pablo Picasso" class="card-img" />
      <p>“El propósito del arte es lavar el polvo de la vida cotidiana de nuestras
         almas.”</p>
      <span>- Pablo Picasso</span>
    </div>
    <div class="card">
      <img src="https://i.pinimg.com/564x/08/c6/18/08c618b2ac24ebc6b4b83aea923aaa61.jpg" alt="Paul Cézanne" class="card-img" />
      <p>“No se trata de pintar la vida, 
        se trata de dar vida a la pintura.”</p>
      <span>- Paul Cézanne</span>
    </div>
    <div class="card">
      <img src="https://i.pinimg.com/564x/39/bd/96/39bd9612e2efd6a2baee348c736d61cb.jpg" alt="Edgar Degas" class="card-img" />
      <p>“El arte no es lo que ves, sino lo que haces ver a los demás.”</p>
      <span>- Edgar Degas</span>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

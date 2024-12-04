<?php
session_start();
include 'conexion.php'; // Asegúrate de que tienes este archivo para la conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtener el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];

// Si el formulario fue enviado, actualizar el nombre de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_usuario = $_POST['username'];

    // Actualizar el nombre de usuario en la base de datos
    $query = "UPDATE usuarios SET usuario = '$nuevo_usuario' WHERE usuario = '$usuario'";
    if (mysqli_query($conn, $query)) {
        // Actualizar el nombre de usuario en la sesión
        $_SESSION['usuario'] = $nuevo_usuario;
        $usuario = $nuevo_usuario;
        $mensaje = "Nombre de usuario actualizado exitosamente.";
    } else {
        $mensaje = "Error al actualizar el nombre de usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil - Vivid Art</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="perfil.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="container">
    <header class="header">
      <nav>
        <ul class="menu">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="posts.php">Posts</a></li>
          <li><a href="ventas.html">Ventas</a></li>
          <li><a href="perfil.php">Perfil</a></li>
        </ul>
      </nav>
    </header>
    
    <div class="perfil-envoltura">
      <h1 class="titulo-perfil">Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h1>
      
      <div class="perfil-foto">
        <img src="https://i.pinimg.com/564x/9e/46/5a/9e465afc0eceda373e48e2d7980050a8.jpg" alt="Foto de perfil">
      </div>

      <div class="perfil-info">
        <!-- Formulario para actualizar el nombre de usuario -->
        <form class="login-form" action="perfil.php" method="POST">
          <label for="username">Nombre de Usuario:</label>
          <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($usuario); ?>">
          <button class="botones" type="submit">Guardar</button>
        </form>
        <?php if (isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
      </div>

      <div class="botones">
        <button>CONFIGURACIÓN</button>
        <button>CONTACTO</button>
        <button>ACERCA DE</button>
        <a href="graficas.php"><button>GRÁFICAS</button></a>
      </div>
    </div>
  </div>
</body>
</html>

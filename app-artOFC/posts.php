<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vivid Art</title>
  <link rel="stylesheet" href="posts.css">
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
    <main class="main-content">
      <h1 class="main-title">POSTS</h1>
      <div class="posts-container">
        <?php
        include 'conexion.php';
        session_start();

        // Obtener todas las publicaciones
        $query = "SELECT * FROM posts ORDER BY fecha DESC";
        $result = $conn->query($query);

        while ($post = $result->fetch_assoc()) {
            $post_id = $post['id'];
            $usuario = htmlspecialchars($post['usuario']);
            $imagen = $post['imagen'];
            
            // Contar likes
            $query_likes = "SELECT COUNT(*) AS likes FROM likes WHERE post_id = $post_id";
            $likes_result = $conn->query($query_likes);
            $likes = $likes_result->fetch_assoc()['likes'];
            
            // Obtener comentarios
            $query_comentarios = "SELECT * FROM comentarios WHERE post_id = $post_id";
            $comentarios_result = $conn->query($query_comentarios);
        ?>
        <div class="post">
          <div class="user-info">
            <span class="user-name"><?php echo $usuario; ?></span>
          </div>

          <!-- Mostrar la imagen del post -->
          <div class="post-image">
            <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Imagen del post" style="width: 100%; height: auto;">
          </div>

          <div class="post-actions">
            <button onclick="darLike(<?php echo $post_id; ?>)">Me gusta</button> 
            <span id="likes-<?php echo $post_id; ?>"><?php echo $likes; ?></span> Me gusta(s)
          </div>

          <div class="comments">
            <h3>Comentarios</h3>
            <?php while ($comentario = $comentarios_result->fetch_assoc()) { ?>
              <div class="comment">
                <strong><?php echo htmlspecialchars($comentario['usuario']); ?>:</strong>
                <p><?php echo htmlspecialchars($comentario['comentario']); ?></p>
              </div>
            <?php } ?>
            
            <form action="comentar.php" method="POST">
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <input type="text" name="comentario" placeholder="Añadir un comentario" required>
              <button type="submit">Comentar</button>
            </form>
          </div>
        </div>
        <?php } ?>
        
        <!-- Formulario para subir una publicación -->
        <form action="upload.php" method="post" enctype="multipart/form-data" class="upload-form">
          <label for="file" class="upload-label">Sube tu dibujo:</label>
          <input type="file" name="file" id="file" class="upload-input" required>
          <button type="submit" class="upload-button">Subir</button>
        </form>
      </div>
    </main>

    <script>
      function darLike(postId) {
          fetch('like.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: `post_id=${postId}`
          })
          .then(response => response.text())
          .then(data => {
              const likesElement = document.getElementById(`likes-${postId}`);
              likesElement.textContent = parseInt(likesElement.textContent) + 1;
          })
          .catch(error => console.error('Error:', error));
      }
    </script>
  </div>
</body>
</html>

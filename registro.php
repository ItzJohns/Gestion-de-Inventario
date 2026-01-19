<?php
require 'conexion.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if (!$nombre || !$email || !$pass) { $error = 'Completa todos los campos.'; }
    else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare('INSERT INTO usuarios (nombre,email,password) VALUES (?,?,?)');
        $stmt->bind_param('sss', $nombre, $email, $hash);
        if ($stmt->execute()) {
            header('Location: login.php'); exit;
        } else { $error = 'Error: ' . $conexion->error; }
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Registro - CRUD App</title><link rel="stylesheet" href="css/estilos.css"></head><body>
<div class="container">
  <div class="card">
    <h2>Registro de usuario</h2>
    <?php if (!empty($error)) echo '<div style="color:red">'.htmlspecialchars($error).'</div>'; ?>
    <form method="POST">
      <input class="input" type="text" name="nombre" placeholder="Nombre completo" required><br><br>
      <input class="input" type="email" name="email" placeholder="Correo" required><br><br>
      <input class="input" type="password" name="password" placeholder="Contraseña" required><br><br>
      <button class="btn" type="submit">Registrarme</button>
    </form>
    <p class="muted">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
  </div>
</div></body></html>

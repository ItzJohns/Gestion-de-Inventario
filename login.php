<?php
session_start();
if (isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - CRUD App</title>
<link rel="stylesheet" href="css/estilos.css">
</head><body>
<div class="container">
  <div class="card">
    <h2>Iniciar sesión</h2>
    <form method="POST" action="validar.php">
      <input class="input" type="email" name="email" placeholder="Correo" required><br><br>
      <input class="input" type="password" name="password" placeholder="Contraseña" required><br><br>
      <button class="btn" type="submit">Ingresar</button>
    </form>
    <p class="muted">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
  </div>
</div>
</body></html>

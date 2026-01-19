<?php
require 'conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio = (float)($_POST['precio'] ?? 0);
    $stock = (int)($_POST['stock'] ?? 0);

    $stmt = $conexion->prepare('INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssdi', $nombre, $descripcion, $precio, $stock);
    if ($stmt->execute()) { header('Location: index.php'); exit; }
    else { $error = $conexion->error; }
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Añadir producto</title><link rel="stylesheet" href="css/estilos.css"></head><body>
<div class="container">
  <div class="card">
    <h2>Añadir producto</h2>
    <?php if (!empty($error)) echo '<div style="color:red">'.htmlspecialchars($error).'</div>'; ?>
    <form method="POST">
      <input class="input" type="text" name="nombre" placeholder="Nombre" required><br><br>
      <textarea class="input" name="descripcion" placeholder="Descripción"></textarea><br><br>
      <div class="form-row">
        <input class="input" type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input class="input" type="number" name="stock" placeholder="Stock" required>
      </div><br>
      <button class="btn" type="submit">Guardar</button>
      <a class="btn-ghost" href="index.php">Cancelar</a>
    </form>
  </div>
</div></body></html>

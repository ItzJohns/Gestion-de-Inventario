<?php
require 'conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio = (float)($_POST['precio'] ?? 0);
    $stock = (int)($_POST['stock'] ?? 0);

    $stmt = $conexion->prepare('UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=? WHERE id=?');
    $stmt->bind_param('ssdii', $nombre, $descripcion, $precio, $stock, $id);
    if ($stmt->execute()) { header('Location: index.php'); exit; }
    else { $error = $conexion->error; }
} else {
    $stmt = $conexion->prepare('SELECT * FROM productos WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $id); $stmt->execute(); $res = $stmt->get_result();
    if ($res->num_rows === 0) { header('Location: index.php'); exit; }
    $row = $res->fetch_assoc();
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Editar producto</title><link rel="stylesheet" href="css/estilos.css"></head><body>
<div class="container">
  <div class="card">
    <h2>Editar producto</h2>
    <?php if (!empty($error)) echo '<div style="color:red">'.htmlspecialchars($error).'</div>'; ?>
    <form method="POST">
      <input class="input" type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required><br><br>
      <textarea class="input" name="descripcion"><?php echo htmlspecialchars($row['descripcion']); ?></textarea><br><br>
      <div class="form-row">
        <input class="input" type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
        <input class="input" type="number" name="stock" value="<?php echo htmlspecialchars($row['stock']); ?>" required>
      </div><br>
      <button class="btn" type="submit">Guardar cambios</button>
      <a class="btn-ghost" href="index.php">Cancelar</a>
    </form>
  </div>
</div></body></html>

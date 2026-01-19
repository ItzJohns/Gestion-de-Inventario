<?php
session_start();
require 'conexion.php';
// require login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>CRUD App - Productos</title>
<link rel="stylesheet" href="css/estilos.css">
</head><body>
<div class="container">
  <div class="topbar">
    <div><h1>Mi tienda - CRUD</h1><div class="muted">Usuario: <?php echo htmlspecialchars($_SESSION['user_name']); ?></div></div>
    <div>
      <a class="small" href="agregar.php">Añadir producto</a> &nbsp;|&nbsp;
      <a class="small" href="logout.php">Cerrar sesión</a>
    </div>
  </div>

  <div class="card">
    <h2>Listado de productos</h2>
    <?php
    $res = $conexion->query('SELECT * FROM productos ORDER BY id DESC');
    if ($res->num_rows === 0) {
        echo "<p class='muted'>No hay productos aún.</p>";
    } else {
        echo '<table><thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th></th></tr></thead><tbody>';
        while($r = $res->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'.(int)$r['id'].'</td>';
            echo '<td>'.htmlspecialchars($r['nombre']).'</td>';
            echo '<td>$'.number_format($r['precio'],2).'</td>';
            echo '<td>'.(int)$r['stock'].'</td>';
            echo '<td><a class="btn-ghost" href="editar.php?id='.(int)$r['id'].'">Editar</a> <a class="btn-ghost" href="eliminar.php?id='.(int)$r['id'].'" onclick="return confirm(\'Eliminar producto?\')">Eliminar</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
    ?>
  </div>
</div>
</body></html>

<?php
require 'conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $conexion->prepare('DELETE FROM productos WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: index.php'); exit;

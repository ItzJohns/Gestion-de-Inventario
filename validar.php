<?php
session_start();
require 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: login.php'); exit; }
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

$stmt = $conexion->prepare('SELECT id,nombre,password FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) { die('Usuario no encontrado. <a href="login.php">Volver</a>'); }
$u = $res->fetch_assoc();
if (password_verify($pass, $u['password'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $u['id'];
    $_SESSION['user_name'] = $u['nombre'];
    header('Location: index.php'); exit;
} else {
    die('Contraseña incorrecta. <a href="login.php">Volver</a>');
}

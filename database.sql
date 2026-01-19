-- database.sql - importar en phpMyAdmin
CREATE DATABASE IF NOT EXISTS crud_app DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE crud_app;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL DEFAULT 0,
  stock INT NOT NULL DEFAULT 0
);

-- usuario de prueba: demo@local / demo123
INSERT INTO usuarios (nombre, email, password) VALUES ('Usuario Demo', 'demo@local', '$2y$12$DemoHashReplaceMe1234567890123456789012');

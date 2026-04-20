CREATE DATABASE IF NOT EXISTS product_admin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE product_admin;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuario demo (password: Admin123*)
INSERT INTO users (name, email, password)
VALUES (
    'Administrador',
    'admin@empresa.com',
    '$2y$12$iRGDkd9yA.7khHV27nJR.egJphOuJRc490FaLkY.5XBL8yp7VL7Ua'
)
ON DUPLICATE KEY UPDATE email = VALUES(email);

INSERT INTO products (name, description, price, stock)
VALUES
('Laptop Empresarial Pro 14', 'Equipo corporativo para productividad y trabajo híbrido.', 1299.99, 18),
('Monitor UltraWide 34', 'Monitor panorámico para analistas, diseño y multitarea.', 749.90, 9),
('Dock USB-C Corporativo', 'Base de conexión para estaciones de trabajo modernas.', 159.50, 42);

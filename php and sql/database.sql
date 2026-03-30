-- FlowerHub Database Schema
-- Import this file into phpMyAdmin in XAMPP

CREATE DATABASE IF NOT EXISTS flowerhub_db;
USE flowerhub_db;

-- Users table for login/signup
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(50),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cart table
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Order items table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Insert sample data
INSERT INTO products (name, description, price, image, category, stock) VALUES
('Rose Flower', 'A classic symbol of love and beauty. Color: Typically red, but also comes in pink, yellow, white, and more. Petals: Soft, velvet-like, and layered in a spiral pattern.', 19.99, 'images/back2.jpeg', 'Flowers', 50),
('Daisy Flower', 'Beautiful daisy flowers with white petals and yellow center.', 15.99, 'images/daisy.jpeg', 'Flowers', 30),
('Hibiscus Flower', 'Vibrant hibiscus flowers in various colors.', 12.99, 'images/hibiscus.jpeg', 'Flowers', 40),
('Sunflower', 'Tall and bright sunflowers.', 25.99, 'images/image1.jpeg', 'Flowers', 20),
('Lily Flower', 'Elegant lily flowers with delicate petals.', 22.99, 'images/image2.jpeg', 'Flowers', 35),
('Tulip', 'Colorful tulip flowers.', 18.99, 'images/image3.jpeg', 'Flowers', 25);
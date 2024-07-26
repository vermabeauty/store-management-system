create database store;

use store;

CREATE TABLE user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('superadmin', 'manager', 'staff') DEFAULT 'staff',
    salary int 
);

CREATE TABLE item_table (
    product_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    prize DECIMAL(10, 2) NOT NULL,
    brought DATE NOT NULL,
    stock INT UNSIGNED NOT NULL
);


insert into user(`username`,`password`,`email`,`role`,`salary`)
 values('admin','1234','admin@gmail.com','superadmin',100000),
 ('manager','1234','manager@gmail.com','manager',50000),
 ('staff','1234','staff@gmail.com','staff',15000),
 ('shrish','1234','shrish@gmail.com','superadmin',100000);
 
 INSERT INTO item_table (product_name, prize, brought, stock) VALUES
('Laptop', 999.99, '2024-01-10', 50),
('Smartphone', 499.99, '2024-02-15', 200),
('Headphones', 79.99, '2024-03-20', 150),
('Monitor', 299.99, '2024-04-05', 75);

CREATE TABLE transaction (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) AS (quantity * price) STORED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

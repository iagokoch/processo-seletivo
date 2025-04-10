<?php
$host = 'localhost';
$dbname = 'cep_database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("USE $dbname");
    
    // Create table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS enderecos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cep VARCHAR(9),
        logradouro VARCHAR(255),
        bairro VARCHAR(255),
        localidade VARCHAR(255),
        uf VARCHAR(2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} 
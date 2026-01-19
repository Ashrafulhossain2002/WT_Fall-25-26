<?php
$host = 'localhost';
$username = 'root';
$password = '';

echo "<h2>Database Setup</h2>";

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Connected to MySQL<br>";
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS blood_users");
    echo "✓ Database 'blood_users' created<br>";
    
    // Use database
    $pdo->exec("USE blood_users");
    echo "✓ Using database 'blood_users'<br>";
    
    // Create table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        mobile VARCHAR(15) NOT NULL,
        blood_group VARCHAR(5) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "✓ Table 'users' created<br>";
    
    // Show databases
    echo "<h3>Available Databases:</h3>";
    $stmt = $pdo->query("SHOW DATABASES");
    while ($row = $stmt->fetch()) {
        echo "- " . $row[0] . "<br>";
    }
    
    echo "<br><strong>Success! Now check phpMyAdmin for 'blood_users' database</strong>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
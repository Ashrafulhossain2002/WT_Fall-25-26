<?php
$host = 'localhost';
$dbname = 'blood_donation_db';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server first
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("USE $dbname");
    
    // Create users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        mobile VARCHAR(15) NOT NULL,
        blood_group VARCHAR(5) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('donor', 'recipient') DEFAULT 'donor',
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create admins table
    $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create blood_requests table
    $pdo->exec("CREATE TABLE IF NOT EXISTS blood_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        blood_group VARCHAR(5) NOT NULL,
        location VARCHAR(100) NOT NULL,
        urgency ENUM('low', 'medium', 'high') DEFAULT 'medium',
        status ENUM('pending', 'fulfilled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create events table
    $pdo->exec("CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        description TEXT,
        location VARCHAR(100) NOT NULL,
        event_date DATE NOT NULL,
        status ENUM('upcoming', 'completed', 'cancelled') DEFAULT 'upcoming',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Insert default admin if not exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE email = ?");
    $stmt->execute(['admin123@gmail.com']);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
        $stmt->execute(['admin123@gmail.com', password_hash('12345678', PASSWORD_DEFAULT)]);
    }
    
    // Insert sample blood requests if table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM blood_requests");
    if ($stmt->fetchColumn() == 0) {
        $requests = [
            ['O+', 'Dhaka', 'high'],
            ['A-', 'Chittagong', 'medium'],
            ['A+', 'Dhaka', 'low'],
            ['B-', 'Rajshahi', 'high'],
            ['O-', 'Dhaka', 'medium'],
            ['AB-', 'Narayanganj', 'low']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO blood_requests (blood_group, location, urgency) VALUES (?, ?, ?)");
        foreach ($requests as $request) {
            $stmt->execute($request);
        }
    }
    
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
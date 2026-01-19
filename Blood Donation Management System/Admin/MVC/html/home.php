<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Home | Blood Donation</title>
<link rel="stylesheet" href="../css/home.css">
</head>
<body>

<header>
<h1>Blood Donation Dashboard</h1>
<p>Welcome, <?= $user['name'] ?></p>
<a href="logout.php" class="logout">Logout</a>
</header>

<div class="cards">
    <div class="card donor">
        <h3>Donors</h3>
        <p>Registered blood donors</p>
    
    </div>
    <div class="card recipient">
        <h3>Recipients</h3>
        <p>Blood receivers</p>
    </div>


    
    <div class="card admin">
    <h3>Admin</h3>
    <p>System Administration</p>
    <a href="admin-login.php" class="btn">Enter</a>
</div>

</div>
<footer>
    <div>
        <p>Copyright & Disclaimer
© 2026 [Blood Management system]. All Rights Reserved. All content, including donor data, inventory records, and application code, is the property of [Name]. The information on this platform is for blood management and donation purposes only. We do not sell, share, or trade personal donor information.</p>
    </div>
</footer>

</body>
</html>

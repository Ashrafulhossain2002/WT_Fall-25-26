<?php
session_start();

$error = "";

if (isset($_SESSION['admin_logged'])) {
    header("Location: admin-dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === "admin123@gmail.com" && $password === "12345678") {
        $_SESSION['admin_logged'] = true;
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error = "Invalid admin credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="admin-login.css">
</head>
<body>

<div class="login-box">
<h2>Admin Login</h2>

<?php if($error) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
<input type="email" name="email" placeholder="Admin Email">
<input type="password" name="password" placeholder="Password">
<button type="submit">Login</button>
</form>
</div>

</body>
</html>

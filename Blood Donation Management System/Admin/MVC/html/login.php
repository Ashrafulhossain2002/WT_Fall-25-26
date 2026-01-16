<?php
session_start();

$emailErr = $passErr = $loginErr = "";
$email = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email == "") $emailErr = "Email required";
    if ($password == "") $passErr = "Password required";

    if ($emailErr == "" && $passErr == "") {

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if ($email === $user['email'] && password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                header("Location: home.php");
                exit();
            } else {
                $loginErr = "Invalid email or password";
            }
        } else {
            $loginErr = "No user registered yet";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Blood Donation</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
    
<div class="container">
    <div class="login-card">
        <h1>Blood Donation Management system</h1>
        <h2>Login</h2>

        <?php if($loginErr) echo "<p class='error'>$loginErr</p>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" value="<?= @$email ?>">
            <small class="error"><?= $emailErr ?></small>

            <input type="password" name="password" placeholder="Password">
            <small class="error"><?= $passErr ?></small>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>

</body>
</html>

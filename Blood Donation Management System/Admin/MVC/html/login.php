<?php
session_start();
include '../php/config.php';

$emailErr = $passErr = $loginErr = "";
$email = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) $emailErr = "Email required";
    if (empty($password)) $passErr = "Password required";

    if ($emailErr == "" && $passErr == "") {
        $sql = "SELECT * FROM user_accounts WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;
            header("Location: home.php");
            exit();
        } else {
            $loginErr = "Invalid email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Blood Donation</title>
<link rel="stylesheet" href="../css/login.css">
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

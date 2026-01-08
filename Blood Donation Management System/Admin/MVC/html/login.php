<?php
session_start();

$emailErr = $passErr = $loginErr = "";
$email = "";


if (isset($_SESSION['user_email'])) {
    header("Location: user-profile.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = trim($_POST['email']);
    }

    
    if (empty($_POST['password'])) {
        $passErr = "Password is required";
    }

    
    if ($emailErr == "" && $passErr == "") {

        
        if ($email == "admin@gmail.com" && $_POST['password'] == "123456") {

            $_SESSION['user_email'] = $email;

            
            if (isset($_POST['remember'])) {
                setcookie("user_email", $email, time() + (86400 * 7), "/");
            }

            header("Location: user-profile.php");
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

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    
    <link rel="stylesheet" href="login.css">
</head>
<body>





<section class="section login-section">
    <div class="container">

        <div class="login-card">

            
            <div class="login-left">
                <i class="fa-solid fa-droplet"></i>
                <h2>Welcome Back</h2>
                <p>Login to manage your profile and help save lives.</p>
            </div>

            
            <div class="login-right">
                <h3>Login to Your Account</h3>

            
                <?php if ($loginErr != "") { ?>
                    <p style="color:red; text-align:center;"><?php echo $loginErr; ?></p>
                <?php } ?>

                <form method="POST">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control"
                               value="<?php echo htmlspecialchars($email); ?>"
                               placeholder="Enter your email">
                        <small style="color:red;"><?php echo $emailErr; ?></small>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter your password">
                        <small style="color:red;"><?php echo $passErr; ?></small>
                    </div>

                    <div class="login-options">
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn login-btn">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </button>
                </form>

                <p class="register-text">
                    Don’t have an account?
                    <a href="register.php">Register Now</a>
                </p>
            </div>

        </div>

    </div>
</section>

</body>
</html>

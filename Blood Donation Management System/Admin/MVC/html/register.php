<?php
session_start();
include '../php/config.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $bloodGroup = $_POST['bloodGroup'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $terms = isset($_POST['terms']);

    // Validation
    if (empty($name)) $errors['name'] = "Name required";
    if (empty($email)) $errors['email'] = "Email required";
    if (empty($mobile)) $errors['mobile'] = "Mobile required";
    if (empty($bloodGroup)) $errors['bloodGroup'] = "Select blood group";
    if (empty($password)) $errors['password'] = "Password required";
    if ($password !== $confirmPassword) $errors['confirmPassword'] = "Passwords do not match";
    if (!$terms) $errors['terms'] = "You must accept terms";

    if (empty($errors)) {
        // Check if email already exists
        $checkEmail = "SELECT email FROM user_accounts WHERE email='$email'";
        $emailResult = mysqli_query($conn, $checkEmail);
        
        if (mysqli_num_rows($emailResult) > 0) {
            $errors['email'] = "Email already exists";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user_accounts (name, email, mobile, blood_group, password) VALUES ('$name', '$email', '$mobile', '$bloodGroup', '$hashedPassword')";
            
            if (mysqli_query($conn, $sql)) {
                $success = "Registration successful! You can now <a href='login.php'>Login</a>.";
            } else {
                $errors['email'] = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register | Blood Donation</title>
<link rel="stylesheet" href="../css/register.css">
</head>
<body>

<div class="container">
    <div class="register-card">
        <h2>Register as Donor</h2>

        <?php if($success) echo "<p class='success'>$success</p>"; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" value="<?= @$name ?>">
            <small class="error"><?= @$errors['name'] ?></small>

            <input type="email" name="email" placeholder="Email" value="<?= @$email ?>">
            <small class="error"><?= @$errors['email'] ?></small>

            <input type="text" name="mobile" placeholder="Mobile" value="<?= @$mobile ?>">
            <small class="error"><?= @$errors['mobile'] ?></small>

            <select name="bloodGroup">
                <option value="">Select Blood Group</option>
                <?php 
                $groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
                foreach($groups as $g){
                    $selected = ($bloodGroup == $g) ? "selected" : "";
                    echo "<option value='$g' $selected>$g</option>";
                }
                ?>
            </select>
            <small class="error"><?= @$errors['bloodGroup'] ?></small>

            <input type="password" name="password" placeholder="Password">
            <small class="error"><?= @$errors['password'] ?></small>

            <input type="password" name="confirmPassword" placeholder="Confirm Password">
            <small class="error"><?= @$errors['confirmPassword'] ?></small>

            <label><input type="checkbox" name="terms" <?= @$terms ? "checked" : "" ?>> I agree to terms</label>
            <small class="error"><?= @$errors['terms'] ?></small>

            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </div>
</div>

</body>
</html>

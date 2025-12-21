<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Validation</title>
</head>

<body>
<h1>PHP Form Validation</h1>

<?php
$name = $age = $email = $gender = $dob = $degree = $blood = "";
$nameerror = $ageerror = $emailerror = $gendererror = $doberror = $degreeerror = $blooderror = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name
    if (empty($_POST["name"])) {
        $nameerror = "Enter your name";
    } else {
        $name = text_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameerror = "Only letters and spaces allowed";
        }
    }

    // Age
    if (empty($_POST["age"])) {
        $ageerror = "Enter your age";
    } else {
        $age = text_input($_POST["age"]);
        if (!is_numeric($age) || $age <= 0) {
            $ageerror = "Enter a valid age";
        }
    }

    // Email
    if (empty($_POST["email"])) {
        $emailerror = "Enter your email";
    } else {
        $email = text_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerror = "Invalid email format";
        }
    }

    // Gender
    if (empty($_POST["gender"])) {
        $gendererror = "Select gender";
    } else {
        $gender = $_POST["gender"];
    }

    // Date of Birth
    if (empty($_POST["dd"]) || empty($_POST["mm"]) || empty($_POST["yy"])) {
        $dateErr = "Date of birth required";
    } else {
        $dd = $_POST["dd"];
        $mm = $_POST["mm"];
        $yy = $_POST["yy"];
 
        if ($dd < 1 || $dd > 31 || $mm < 1 || $mm > 12 || $yy < 1953 || $yy > 1998) {
$nameerror = $ageerror = $emailerror = $gendererror = $doberror = $degreeerror = $blooderror = "";
            $doberror = "Invalid date range";
        }
    }
 

    // Degree
    if (empty($_POST["degree"])) {
        $degreeerror = "Enter your degree";
    } else {
        $degree = text_input($_POST["degree"]);
    }

    // Blood Group
    if (empty($_POST["blood"])) {
        $blooderror = "Select blood group";
    } else {
        $blood = $_POST["blood"];
    }
}

function text_input($data)
{
    return trim($data);
}
?>

<form method="post">

    Name:
    <input type="text" name="name" value="<?php echo $name; ?>">
    <?php echo $nameerror; ?>
    <br><br>

    Age:
    <input type="text" name="age" value="<?php echo $age; ?>">
    <?php echo $ageerror; ?>
    <br><br>

    Email:
    <input type="text" name="email" value="<?php echo $email; ?>">
    <?php echo $emailerror; ?>
    <br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?>> Female
    <?php echo $gendererror; ?>
    <br><br>

    
    Date of Birth:
    <input type="text" name="dd" size="2" placeholder="DD"> /
    <input type="text" name="mm" size="2" placeholder="MM"> /
    <input type="text" name="yy" size="4" placeholder="YYYY">
    <?php echo $doberror; ?>
    <br><br>
    Degree:
    <input type="checkbox" name="degree[]" value="SSC">SSC
    <input type="checkbox" name="degree[]" value="HSC">HSC
    <input type="checkbox" name="degree[]" value="BSc">BSc
    <input type="checkbox" name="degree[]" value="MSc">MSc
    <?php echo $degreeerror; ?>
    <br><br>

    Blood Group:
    <select name="blood">
        <option value="">Select</option>
        <option value="A+" <?php if($blood=="A+") echo "selected"; ?>>A+</option>
        <option value="A-" <?php if($blood=="A-") echo "selected"; ?>>A-</option>
        <option value="B+" <?php if($blood=="B+") echo "selected"; ?>>B+</option>
        <option value="B-" <?php if($blood=="B-") echo "selected"; ?>>B-</option>
        <option value="O+" <?php if($blood=="O+") echo "selected"; ?>>O+</option>
        <option value="O-" <?php if($blood=="O-") echo "selected"; ?>>O-</option>
        <option value="AB+" <?php if($blood=="AB+") echo "selected"; ?>>AB+</option>
        <option value="AB-" <?php if($blood=="AB-") echo "selected"; ?>>AB-</option>
    </select>
    <?php echo $blooderror; ?>
    <br><br>

    <input type="submit" value="Submit">

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    empty($nameerror) && empty($ageerror) && empty($emailerror) &&
    empty($gendererror) && empty($doberror) &&
    empty($degreeerror) && empty($blooderror)) {

    echo "<h3>Submitted Data:</h3>";
    echo "Name: $name <br>";
    echo "Age: $age <br>";
    echo "Email: $email <br>";
    echo "Gender: $gender <br>";
    echo "Date of Birth: $dob <br>";
    echo "Degree: $degree <br>";
    echo "Blood Group: $blood <br>";
}
?>

</body>
</html>

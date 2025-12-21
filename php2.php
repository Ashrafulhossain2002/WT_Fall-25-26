<html>
<head>
    <title>
        PHP Code
    </title>
</head>

<body>
    <H1>This is PHP Class </H1>

<?php
$name="";
$nameerror="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameerror="Enter your Name";
    } else {
        $name=text_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameerror="Please enter the valid format";
        }
    }
}

function text_input($data)
{
    $data=trim($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST" && empty($nameerror))
{
    echo "The Name is : ".$name;
}
?>

<form method="post" action="">
Name: <input type="text" name="name" value="<?php echo $name; ?>">
<?php echo $nameerror; ?>

<br><br>


$age="";
$ageerror="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["age"])) {
        $nameerror="Enter your age";
    } else {
        $name=text_input($_POST["age"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$age)) {
            $ageerror="Please enter the valid format";
        }
    }
}

function text_input($data)
{
    $data=trim($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST" && empty($ageerror))
{
    echo "The Name is : ".$age;
}
?>

<form method="post" action="">
Name: <input type="number" age="age" value="<?php echo $age; ?>">
<?php echo $ageerror; ?>

<br><br>
Age: <input type="text">
<input type="submit" name="submit" value="Submit">



Age: <input type="text">
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>

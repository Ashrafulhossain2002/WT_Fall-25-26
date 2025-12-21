<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tech Festival Demo</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            padding: 20px;
        }
        .container {
            width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 6px 0 15px 0;
            border: 1px solid gray;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        #successBox {
            margin-top: 20px;
            padding: 15px;
            background: #d4edda;
            color: #155724;
            border-left: 5px solid green;
            display: none;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Participant Registration</h2>

    <form id="regForm">
        <label>Full Name:</label>
        <input type="text" id="name">

        <label>Email:</label>
        <input type="text" id="email">

        <label>Phone Number:</label>
        <input type="text" id="phone">

        <label>Password:</label>
        <input type="password" id="pass">

        <label>Confirm Password:</label>
        <input type="password" id="cpass">

        <button type="button" onclick="register()">Register</button>
    </form>

    <div id="successBox"></div>
</div>

<script>
    function register() {
        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let phone = document.getElementById("phone").value.trim();
        let pass = document.getElementById("pass").value;
        let cpass = document.getElementById("cpass").value;

        // Empty field validation
        if (name === "" || email === "" || phone === "" || pass === "" || cpass === "") {
            alert("All fields are required!");
            return;
        }

        // Email validation
        if (!email.includes("@")) {
            alert("Invalid email! Must contain '@'");
            return;
        }

        // Phone number validation (digits only)
        if (!/^[0-9]+$/.test(phone)) {
            alert("Phone number must contain digits only!");
            return;
        }

        // Password match validation
        if (pass !== cpass) {
            alert("Passwords do not match!");
            return;
        }

        // Show success message
        document.getElementById("successBox").style.display = "block";
        document.getElementById("successBox").innerHTML =
            "<h3>Registration Successful!</h3>" +
            "<p><strong>Name:</strong> " + name + "</p>" +
            "<p><strong>Email:</strong> " + email + "</p>" +
            "<p><strong>Phone:</strong> " + phone + "</p>";
    }
</script>

</body>
</html>

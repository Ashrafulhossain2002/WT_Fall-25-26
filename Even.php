<!DOCTYPE html>
<html>
<head>
  <title>Event Registration & Activity Manager</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f0f8ff;
    }
 
    h2, h3 {
      text-align: center;
      color: #003366;
    }
    form, .activity-box {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      width: 350px;
      margin: 20px auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
 
    
 
    input, select, button {
      width: 100%;
      padding: 8px;
      margin-top: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
 
    button {
      background-color: #003366;
      color: white;
      cursor: pointer;
    }
 
    button:hover {
      background-color: #0055aa;
    }
 
    #output, #activityList {
      text-align: center;
      margin-top: 15px;
      color: #003366;
    }
 
    .activity-item {
      background: #e8f1ff;
      padding: 8px;
      margin-top: 8px;
      border-radius: 5px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
 
    .remove-btn {
      background-color: red;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
 
  <h2>Participant Registration</h2>
 
  <!-- Registration Form -->
  <form onsubmit="return registerUser()">
 
    <label>Participant Full Name:</label>
    <input type="text" id="fullname" />
 
    <label>Email:</label>
    <input type="text" id="email" />
 
    <label>Phone Number:</label>
    <input type="text" id="phone" />
 
    <label>Password:</label>
    <input type="password" id="pass" />
 
    <label>Confirm Password:</label>
    <input type="password" id="cpass" />
 
    <button type="submit">Register</button>
  </form>
 
  <!-- Registration Output -->
  <div id="output"></div>
 
  <!-- Activity Section -->
  <h3>Add Activities</h3>
  <div class="activity-box">
    <label>Activity Name:</label>
    <input type="text" id="activityInput">
 
    <button onclick="addActivity()">Add Activity</button>
 
    <div id="activityList"></div>
  </div>
 
  <script>
    // Registration Handler
    function registerUser() {
      var name = document.getElementById("fullname").value.trim();
      var email = document.getElementById("email").value.trim();
      var phone = document.getElementById("phone").value.trim();
      var pass = document.getElementById("pass").value;
      var cpass = document.getElementById("cpass").value;
 
      var output = document.getElementById("output");
      output.innerHTML = "";
 
      // Validation
      if (name === "" || email === "" || phone === "" || pass === "" || cpass === "") {
        alert("All fields must be filled!");
        return false;
      }
 
      if (!email.includes("@")) {
        alert("Invalid email! Must contain '@'");
        return false;
      }
 
      if (isNaN(phone)) {
        alert("Phone number must contain digits only!");
        return false;
      }
 
      if (pass !== cpass) {
        alert("Passwords do not match!");
        return false;
      }
 
      // Success Output
      output.innerHTML = `
        <h3>Registration Successful!</h3>
        <strong>Name:</strong> ${name}<br>
        <strong>Email:</strong> ${email}<br>
        <strong>Phone:</strong> ${phone}<br>
      `;
 
      return false;
    }
 
    // Activity Add Handler
    function addActivity() {
      var activityName = document.getElementById("activityInput").value.trim();
      var list = document.getElementById("activityList");
 
      if (activityName === "") {
        alert("Please enter an activity name!");
        return;
      }
 
      // Create Activity Item
      var item = document.createElement("div");
      item.className = "activity-item";
 
      item.innerHTML = `
        ${activityName}
        <button class="remove-btn" onclick="this.parentElement.remove()">Remove</button>
      `;
 
      list.appendChild(item);
      document.getElementById("activityInput").value = "";
    }
  </script>
 
</body>
</html>
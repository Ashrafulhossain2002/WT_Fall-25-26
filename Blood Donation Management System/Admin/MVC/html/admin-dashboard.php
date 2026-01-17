<?php
session_start();
if (!isset($_SESSION['admin_logged'])) {
    header("Location: admin-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="admin-dashboard.css">
</head>
<body>

<h1>Admin Panel</h1>

<div class="menu">
<a href="manage-users.php">Manage Users</a>
<a href="approve-donors.php">Approve Donors</a>
<a href="blood-requests.php">Blood Requests</a>
<a href="events.php">Donation Events</a>
<a href="reports.php">Reports</a>
<a href="admin-logout.php" class="logout">Logout</a>
</div>

<footer>
    <div>
        <p>Copyright & Disclaimer
© 2026 [Blood Management system]. All Rights Reserved. All content, including donor data, inventory records, and application code, is the property of [Name]. The information on this platform is for blood management and donation purposes only. We do not sell, share, or trade personal donor information.</p>
    </div>
</footer>

</body>
</html>

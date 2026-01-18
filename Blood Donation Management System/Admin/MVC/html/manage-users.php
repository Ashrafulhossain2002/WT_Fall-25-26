<?php
session_start();
if (!isset($_SESSION['admin_logged'])) {
    header("Location: admin-login.php");
    exit();
}

$users = [
    ['name'=>'Ali','role'=>'Donor'],
    ['name'=>'Sara','role'=>'Recipient'],
    ['name'=>'John','role'=>'Staff']
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<link rel="stylesheet" href="manage-users.css">
</head>
<body>

<h2>All Users</h2>

<table>
<tr><th>Name</th><th>Role</th></tr>
<?php foreach($users as $u){ ?>
<tr>
<td><?= $u['name'] ?></td>
<td><?= $u['role'] ?></td>
</tr>
<?php } ?>
</table>

<a href="admin-dashboard.php">Back</a>
<footer>
    <div>
        <p>Copyright & Disclaimer
© 2026 [Blood Management system]. All Rights Reserved. All content, including donor data, inventory records, and application code, is the property of [Name]. The information on this platform is for blood management and donation purposes only. We do not sell, share, or trade personal donor information.</p>
    </div>
</footer>

</body>
</html>

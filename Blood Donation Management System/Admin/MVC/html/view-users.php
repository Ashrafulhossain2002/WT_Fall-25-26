<?php
include '../php/config.php';

$result = mysqli_query($conn, "SELECT id, name, email, mobile, blood_group, created_at FROM user_accounts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Users</title>
<style>
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ddd;padding:8px;text-align:left;}
th{background:#f2f2f2;}
</style>
</head>
<body>

<h2>Registered Users</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Blood Group</th>
<th>Registered</th>
</tr>
<?php foreach(mysqli_fetch_all($result, MYSQLI_ASSOC) as $user){ ?>
<tr>
<td><?= $user['id'] ?></td>
<td><?= $user['name'] ?></td>
<td><?= $user['email'] ?></td>
<td><?= $user['mobile'] ?></td>
<td><?= $user['blood_group'] ?></td>
<td><?= $user['created_at'] ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>
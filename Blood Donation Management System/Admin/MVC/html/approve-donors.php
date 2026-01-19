<?php
session_start();
if (!isset($_SESSION['admin_logged'])) exit();

$donors = [
    ['name'=>'Rahim','status'=>'Pending'],
    ['name'=>'Karim','status'=>'Pending'],
    ['name'=>'Maruf','status'=>'Pending'],
    ['name'=>'EFTY','status'=>'Pending'],
    ['name'=>'Emon','status'=>'Pending'],
    ['name'=>'Shuvo','status'=>'Pending']
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Approve Donors</title>
<link rel="stylesheet" href="../css/appove-donor.css">
</head>
<body>

<h2>Donor Approval</h2>

<?php foreach($donors as $d){ ?>
<div class="card">
<p><?= $d['name'] ?></p>
<button>Approve</button>
<button class="reject">Reject</button>
</div>
<?php } ?>

<a href="admin-dashboard.php">Back</a>

<footer>
    <div>
        <p>Copyright & Disclaimer
© 2026 [Blood Management system]. All Rights Reserved. All content, including donor data, inventory records, and application code, is the property of [Name]. The information on this platform is for blood management and donation purposes only. We do not sell, share, or trade personal donor information.</p>
    </div>

</body>
</html>

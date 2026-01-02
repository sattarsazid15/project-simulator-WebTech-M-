<?php
session_start();

if(!isset($_SESSION['customer'])){
    header("Location: customer_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Menu</title>
</head>
<body>

<h2>Welcome Customer</h2>
<p>You are logged in as <?= $_SESSION['customer']['username']; ?></p>

<a href="customer_edit_profile.php">Edit Profile</a><br>

<a href="customer_login.php">Logout</a>

</body>
</html>

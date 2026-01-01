<?php
session_start();

if(!isset($_SESSION['customer_logged_in'])){
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
<p>You are logged in as <?php echo $_SESSION['customer_name']; ?></p>

<a href="customer_login.php">Logout</a>

</body>
</html>

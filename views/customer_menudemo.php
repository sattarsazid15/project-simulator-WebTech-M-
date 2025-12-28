<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
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

<p>Hello, <?php echo $_SESSION['customer']['name']; ?> 👋</p>

<a href="../controllers/logout.php">Logout</a>

</body>
</html>
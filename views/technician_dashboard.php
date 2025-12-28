<?php
session_start();
if (!isset($_SESSION['technician'])) {
    header("Location: technician_login.php");
}
?>

<h2>Welcome Technician</h2>
<p>You are approved and logged in.</p>

<a href="../controllers/logout.php">Logout</a>
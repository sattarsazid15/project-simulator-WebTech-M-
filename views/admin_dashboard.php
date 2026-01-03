<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: admin_login.php");
}
?>

<h2>Admin Dashboard</h2>

<br>
<a href="../views/technician_request.php">Technician Request</a>
<br>
<a href="add_product.php" class="btn">Add New Product</a>
<br>
<a href="../controllers/logout.php">Logout</a>

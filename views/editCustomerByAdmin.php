<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) { 
    header("Location: adminLogin.php"); 
    exit; 
}

if(!isset($_GET['id'])) {
    header("Location: adminCustomers.php");
    exit;
}

$user = getUserById($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>
<div class="form-container">
    <h2>Edit Customer</h2>
    <form method="post" action="../controllers/adminAuth.php">
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= $user['username']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $user['email']; ?>" required>
        </div>
        <button type="submit" name="update_customer_admin">Update Customer</button>
    </form>
    <div class="form-footer"><a href="adminCustomers.php">Cancel</a></div>
</div>
</body>
</html>
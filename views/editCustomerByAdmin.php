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

<div class="form-container" id="edit-customer-container">
    <h2>Edit Customer</h2>
    
    <form method="post" action="../controllers/adminAuth.php" id="edit-customer-form">
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $user['username']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $user['email']; ?>" required>
        </div>
        
        <button type="submit" name="update_customer_admin" id="update-btn">Update Customer</button>
    </form>
    
    <div class="form-footer" id="form-footer">
        <a href="adminCustomers.php" id="cancel-link">Cancel</a>
    </div>
</div>
</body>
</html>
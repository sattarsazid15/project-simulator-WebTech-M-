<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) { 
    header("Location: adminLogin.php"); 
    exit; 
}

if(!isset($_GET['id'])) {
    header("Location: adminTechnicians.php");
    exit;
}

$tech = getTechnicianById($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Technician</title>
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>
<div class="form-container">
    <h2>Edit Technician</h2>
    <form method="post" action="../controllers/adminAuth.php">
        <input type="hidden" name="id" value="<?= $tech['id']; ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= $tech['username']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $tech['email']; ?>" required>
        </div>
        <div class="form-group">
            <label>Specialization</label>
            <input type="text" name="specialization" value="<?= $tech['specialization']; ?>" required>
        </div>
        <button type="submit" name="update_technician_admin">Update Technician</button>
    </form>
    <div class="form-footer"><a href="adminTechnicians.php">Cancel</a></div>
</div>
</body>
</html>
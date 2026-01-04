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

<div class="form-container" id="edit-technician-container">
    <h2>Edit Technician</h2>

    <form method="post" action="../controllers/adminAuth.php" id="edit-technician-form">
        <input type="hidden" name="id" value="<?= $tech['id']; ?>">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $tech['username']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $tech['email']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" id="specialization" value="<?= $tech['specialization']; ?>" required>
        </div>
        
        <button type="submit" name="update_technician_admin" id="update-btn">Update Technician</button>
    </form>
    
    <div class="form-footer" id="form-footer">
        <a href="adminTechnicians.php" id="cancel-link">Cancel</a>
    </div>
</div>

</body>
</html>
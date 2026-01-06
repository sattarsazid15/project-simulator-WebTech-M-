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

        <div class="form-group">
            <label for="experience">Experience (Years)</label>
            <input type="number" name="experience" id="experience" value="<?= $tech['experience']; ?>">
        </div>

        <div class="form-group">
            <label for="shop">Shop Details</label>
            <input type="text" name="shop_details" id="shop" value="<?= $tech['shop_details']; ?>">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="<?= $tech['dob']; ?>">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="Male" <?= ($tech['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?= ($tech['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?= ($tech['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        
        <button type="submit" name="update_technician_admin" id="update-btn">Update Technician</button>
    </form>
    
    <div class="form-footer" id="form-footer">
        <a href="adminTechnicians.php" id="cancel-link">Cancel</a>
    </div>
</div>

</body>
</html>
<?php
session_start();

if(!isset($_SESSION['technician_logged_in'])){
    header("Location: technicianLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Technician Profile</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Edit Profile</h2>

 
    <form method="post" action="../controllers/technicianProfileAuth.php"
          onsubmit="return validateTechProfile();">

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email"
                   value="<?= $_SESSION['technician']['email'] ?>">
        </div>

        <button type="submit" name="update_profile">Update Email</button>
    </form>

    <hr style="margin:20px 0;">

    
    <form method="post" action="../controllers/technicianProfileAuth.php"
          onsubmit="return validateTechPassword();">

        <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="old_password">
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password">
        </div>

        <button type="submit" name="change_password">Change Password</button>
    </form>
    <div class="form-footer">
        <a href="technicianDashboard.php">Back To menu </a>
    </div>
</div>

</body>
</html>

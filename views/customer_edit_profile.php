<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customer_login.php");
    exit;
}

$currentUser = getUserByEmail($_SESSION['customer']['email']);
?>

<?php
if(isset($_GET['success'])){
    if($_GET['success'] == 'profile'){
        echo "<script>alert('Profile updated successfully');</script>";
    }
    if($_GET['success'] == 'password'){
        echo "<script>alert('Password changed successfully');</script>";
    }
}

if(isset($_GET['error'])){
    if($_GET['error'] == 'old'){
        echo "<script>alert('Old password is incorrect');</script>";
    }
    if($_GET['error'] == 'match'){
        echo "<script>alert('New password and confirm password do not match');</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Edit Profile</h2>

    <form method="post" action="../controllers/customer_profile_auth.php"
          onsubmit="return validateProfile();">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username"
                   value="<?= $currentUser['username'] ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email"
                   value="<?= $currentUser['email'] ?>">
        </div>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>

    <hr style="margin:20px 0;">

    <form method="post" action="../controllers/customer_profile_auth.php"
          onsubmit="return validatePassword();">

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
        <a href="customer_menudemo.php">Back To menu </a>
    </div>
</div>

</body>
</html>

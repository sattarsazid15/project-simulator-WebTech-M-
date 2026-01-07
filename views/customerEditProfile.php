<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit;
}

//$currentUser = getUserByEmail($_SESSION['customer']['email']);
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>

<script>
window.onload = function () {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/customerProfileJson.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let user = JSON.parse(this.responseText);

            if(user.error){
                alert(user.error);
                return;
            }

            document.getElementById("username").value = user.username;
            document.getElementById("email").value = user.email;
        }
    }
}
</script>

<body>

<div class="form-container" id="edit-profile-container">
    <h2>Edit Profile</h2>

    <form method="post" action="../controllers/customerProfileAuth.php" onsubmit="return validateProfile();" id="profile-form">

        <div class="form-group">
            <label for="username">Username</label>
            <!--input type="text" name="username" id="username" value="<?//= $currentUser['username'] ?>"-->
            <input type="text" name="username" id="username">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <!-- input type="text" name="email" id="email" value="<?//= $currentUser['email'] ?>"-->
            <input type="text" name="email" id="email">
        </div>

        <button type="submit" name="update_profile" id="update-btn">Update Profile</button>
    </form>

    <hr id="profile-divider">

    <form method="post" action="../controllers/customerProfileAuth.php" onsubmit="return validatePassword();" id="password-form">

        <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" id="old_password">
        </div>

        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password">
        </div>

        <button type="submit" name="change_password" id="change-pass-btn">Change Password</button>
    </form>

    <div class="form-footer">
        <a href="customerDashboard.php">Back To Menu </a>
    </div>
</div>

</body>
</html>

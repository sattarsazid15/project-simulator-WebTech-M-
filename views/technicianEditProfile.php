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
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="tech-edit-container">
    <h2>Edit Profile</h2>

    <form method="post" action="../controllers/technicianProfileAuth.php" onsubmit="return validateTechProfile();" id="tech-profile-form">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $_SESSION['technician']['username'] ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $_SESSION['technician']['email'] ?>">
        </div>

        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" id="specialization" value="<?= $_SESSION['technician']['specialization'] ?>">
        </div>

        <div class="form-group">
            <label for="experience">Experience (Years)</label>
            <input type="number" name="experience" id="experience" value="<?= $_SESSION['technician']['experience'] ?>">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="<?= $_SESSION['technician']['dob'] ?>">
        </div>

        <div class="form-group">
            <label for="shop">Shop Name</label>
            <input type="text" name="shop" id="shop" value="<?= $_SESSION['technician']['shop'] ?>">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="Male" <?= ($_SESSION['technician']['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= ($_SESSION['technician']['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= ($_SESSION['technician']['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <button type="submit" name="update_profile" id="update-profile-btn">Update Profile</button>
    </form>

    <hr id="profile-divider">
    
    <form method="post" action="../controllers/technicianProfileAuth.php" onsubmit="return validateTechPassword();" id="tech-password-form">

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
        <a href="technicianDashboard.php">Back To Menu </a>
    </div>
</div>

</body>
</html>
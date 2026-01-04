<?php
session_start();
if (!isset($_SESSION['reset_email'])) {
    header("Location: customerLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="reset-password-container">
    <h2>Reset Password</h2>

    <form method="post" action="../controllers/resetPasswordAuth.php" onsubmit="return validateResetPassword();" id="reset-password-form">

        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="password" id="new_password">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password">
        </div>

        <button type="submit" id="update-btn">Update Password</button>
    </form>
</div>

</body>
</html>
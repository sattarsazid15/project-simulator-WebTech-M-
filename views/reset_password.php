<?php
session_start();
if (!isset($_SESSION['reset_email'])) {
    header("Location: customer_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Reset Password</h2>

    <form method="post" action="../controllers/reset_password_auth.php" onsubmit="return validateResetPassword();">

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" id="new_password">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" id="confirm_password">
        </div>

        <button type="submit">Update Password</button>
    </form>
</div>

</body>
</html>

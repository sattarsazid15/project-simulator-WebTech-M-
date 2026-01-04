<?php 
session_start(); 
if(isset($_SESSION['customer']) || isset($_COOKIE['status'])){
    header("Location: customerDashboard.php");
    exit;
}
if(isset($_SESSION['technician']) || isset($_SESSION['admin'])){
    session_unset();
    session_destroy();
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="customer-login-container">
    <h2>Customer Login</h2>

    <form method="post" action="../controllers/customerAuth.php" onsubmit="return validateLogin();" id="customer-login-form">

        <input type="hidden" name="action" value="login">

        <div class="form-group">
            <label for="login_email">Email</label>
            <input type="text" name="email" id="login_email">
        </div>

        <div class="form-group">
            <label for="login_password">Password</label>
            <input type="password" name="password" id="login_password">
        </div>

        <button type="submit" id="login-btn">Login</button>
    </form>

    <div class="form-footer">
        New user? <a href="customerSignup.php">Sign Up</a>
        or <a href="forgotPassword.php">Forgot Password?</a>
    </div>
</div>

</body>
</html>
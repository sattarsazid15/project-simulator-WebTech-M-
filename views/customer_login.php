<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Customer Login</h2>

    <form method="post" action="../controllers/customer_auth.php" onsubmit="return validateLogin();">

        <input type="hidden" name="action" value="login">

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="login_email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="login_password">
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="form-footer">
        New user? <a href="customer_signup.php">Sign Up</a>
        or, <a href="forgot_password.php">Forgot Password?</a>
    </div>
</div>

</body>
</html>

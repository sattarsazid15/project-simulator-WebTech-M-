<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Forgot Password</h2>

    <form method="post" action="../controllers/forgot_password_auth.php" onsubmit="return validateForgotPassword();">

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="forgot_email">
        </div>

        <button type="submit">Continue</button>
    </form>

    <div class="form-footer">
        <a href="customer_login.php">Back to Login</a>
    </div>
</div>

</body>
</html>

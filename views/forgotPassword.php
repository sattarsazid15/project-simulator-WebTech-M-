<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="forgot-password-container">
    <h2>Forgot Password</h2>

    <form method="post" action="../controllers/forgotPasswordAuth.php" onsubmit="return validateForgotPassword();" id="forgot-password-form">

        <div class="form-group">
            <label for="forgot_email">Email</label>
            <input type="text" name="email" id="forgot_email">
        </div>

        <button type="submit" id="continue-btn">Continue</button>
    </form>

    <div class="form-footer">
        <a href="customerLogin.php">Back to Login</a>
    </div>
</div>
</body>
</html>
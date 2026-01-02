<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Customer Sign Up</h2>

    <form method="post" action="../controllers/customer_auth.php" onsubmit="return validateSignup();">

        <input type="hidden" name="action" value="signup">

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="username" id="username">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit">Sign Up</button>
    </form>

    <div class="form-footer">
        Already have an account?
        <a href="customer_login.php">Login</a>
    </div>
</div>

</body>
</html>

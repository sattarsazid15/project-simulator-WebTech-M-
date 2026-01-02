<!DOCTYPE html>
<html>
<head>
    <title>Technician Login</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2 class="form-title">Technician Login</h2>

    <form method="post" action="../controllers/technician_login.php" onsubmit="return validateTechLogin();">

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="tech_email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="tech_password">
        </div>

        <button type="submit">Login</button>

        <div class="form-footer">
            New technician? <a href="technician_signup.php">Sign Up</a>
        </div>
    </form>
</div>

</body>
</html>

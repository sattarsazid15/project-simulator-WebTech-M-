<?php
session_start();

if(isset($_SESSION['technician']) || isset($_COOKIE['tech_status'])){
    header("Location: technicianDashboard.php");
    exit;
}

if(isset($_SESSION['admin']) || isset($_COOKIE['admin_status'])){
    header("Location: adminDashboard.php");
    exit;
}

if(isset($_SESSION['customer']) || isset($_COOKIE['status'])){
    header("Location: customerDashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Technician Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="tech-login-container">
    <h2>Technician Login</h2>

    <form method="post" action="../controllers/technicianLogin.php" onsubmit="return validateTechLogin();" id="tech-login-form">

        <div class="form-group">
            <label for="tech_email">Email</label>
            <input type="text" name="email" id="tech_email">
        </div>

        <div class="form-group">
            <label for="tech_password">Password</label>
            <input type="password" name="password" id="tech_password">
        </div>

        <button type="submit" id="login-btn">Login</button>

        <div class="form-footer">
            New technician? <a href="technicianSignup.php">Sign Up</a><br><br>
            <a href="../index.php">Back to Role Selection</a>
        </div>
    </form>
</div>

</body>
</html>
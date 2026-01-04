<?php
session_start();
if(isset($_SESSION['admin']) || isset($_COOKIE['admin_status'])){
    header("Location: adminDashboard.php");
    exit;
}
if(isset($_SESSION['technician']) || isset($_SESSION['customer'])){
    session_unset();
    session_destroy();
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="admin-login-container">
    <h2>Admin Login</h2>

    <form method="post" action="../controllers/adminAuth.php" onsubmit="return validateAdminLogin();" id="admin-login-form">

        <div class="form-group">
            <label for="admin_username">Username</label>
            <input type="text" name="username" id="admin_username">
        </div>

        <div class="form-group">
            <label for="admin_password">Password</label>
            <input type="password" name="password" id="admin_password">
        </div>

        <button type="submit" id="admin-login-btn">Login</button>
    </form>
</div>

</body>
</html>
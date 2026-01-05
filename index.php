<?php
session_start();

if(isset($_SESSION['admin']) || isset($_COOKIE['admin_status'])){
    header("Location: views/adminDashboard.php");
    exit;
}

if(isset($_SESSION['technician']) || isset($_COOKIE['tech_status'])){
    header("Location: views/technicianDashboard.php");
    exit;
}

if(isset($_SESSION['customer']) || isset($_COOKIE['status'])){
    header("Location: views/customerDashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Role</title>
    <link rel="stylesheet" href="assets/css/home2.css">
</head>
<body>

<div class="home-wrapper">
    <h1>Welcome To Online Mobile Shop & Servicing Center</h1>
    <h2>SELECT YOUR ROLES</h2>

    <div class="roles-bg"></div>
    <div class="role-buttons">
        <a href="views/adminLogin.php" class="role-btn">Admin</a>
        <a href="views/technicianLogin.php" class="role-btn">Technician</a>
        <a href="views/customerLogin.php" class="role-btn">Customer</a>
        <a href="views/guestDashBoard.php" class="role-btn">Guest</a>
    </div>
</div>

</body>
</html>
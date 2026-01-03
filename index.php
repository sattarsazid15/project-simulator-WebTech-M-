<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Role</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<div class="home-wrapper">

    <h1>Welcome To Online Mobile Shop & Servicing Center<h1>
    <h2>SELECT YOUR ROLES</h2>

    <div class="roles-bg"></div>
    <div class="role-buttons">
        <a href="views/adminLogin.php" class="role-btn">Admin</a>
        <a href="views/technicianLogin.php" class="role-btn">Technician</a>
        <a href="views/customerLogin.php" class="role-btn">Customer</a>
    </div>

</div>

</body>
</html>
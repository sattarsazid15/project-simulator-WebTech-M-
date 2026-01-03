<?php
session_start();

require_once('../models/userModel.php');
require_once('../models/technicianModel.php');
require_once('../models/productModel.php');
require_once('../models/orderModel.php');

if (!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) {
    header("Location: adminLogin.php");
    exit;
}

$customerCount = getTotalCustomers(); 
$technicianCount = getApprovedTechnCount();
$productCount = getTotalProducts();
$earnings = getTotalEarnings();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/adminDashboard.css">
</head>
<body>

<div class="header">
    <h2>Welcome Admin</h2>
    <h1>Online Mobile Shop and Servicing Center</h1>
</div>

<div class="main-container">

    <div class="content-area">
        <div class="stats-grid">
            <div class="stat-card card-customers">
                <h3>Total Customer Count</h3>
                <h2><?= $customerCount ?></h2>
            </div>
            <div class="stat-card card-technicians">
                <h3>Total Technician Count</h3>
                <h2><?= $technicianCount ?></h2>
            </div>
            <div class="stat-card card-products">
                <h3>Total Product Count</h3>
                <h2><?= $productCount ?></h2>
            </div>
            <div class="stat-card card-earnings">
                <h3>Total Earnings</h3>
                <h2>TK <?= $earnings ?></h2>
            </div>
        </div>
    </div>

    <div class="side-panel">
        <a href="technicianRequest.php" class="side-btn">Technician Request 🛠️</a>
        <a href="products.php" class="side-btn">Manage Products 📦</a>
        <a href="adminOrders.php" class="side-btn">Manage Orders 🚚</a>
        <a href="adminCustomers.php" class="side-btn">Manage Customers 👥</a>
        <a href="adminTechnicians.php" class="side-btn">Manage Technicians 👨‍🔧</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
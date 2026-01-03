<?php
session_start();

require_once('../models/userModel.php');
require_once('../models/technicianModel.php');
require_once('../models/productModel.php');

if (!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) {
    header("Location: adminLogin.php");
    exit;
}

$customerCount = getTotalCustomers(); 
$technicianCount = getApprovedTechnCount();
$productCount = getTotalProducts();
$earnings = "00";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/customerMenu.css">
</head>
<body>

<div class="header">
    <h2>Welcome Admin </h2>
    <h1>Online Mobile Shop and Servicing Center</h1>
</div>

<div class="main-container">

    <div class="content-area">

        <div class="products-box">

            <div style="display:flex; gap:40px; flex-wrap:wrap; justify-content:center;">

                <div style="background:#7a3200; color:#fff; padding:30px; width:260px; text-align:center; border-radius:10px;">
                    <h3>Total Customer Count</h3>
                    <h2><?= $customerCount ?></h2>
                </div>

                <div style="background:#4f93d2; color:#fff; padding:30px; width:260px; text-align:center; border-radius:10px;">
                    <h3>Total Technician Count</h3>
                    <h2><?= $technicianCount ?></h2>
                </div>

                <div style="background:#d974d1; color:#fff; padding:30px; width:260px; text-align:center; border-radius:10px;">
                    <h3>Total Product Count</h3>
                    <h2><?= $productCount ?></h2>
                </div>

                <div style="background:#0f4d1a; color:#fff; padding:30px; width:260px; text-align:center; border-radius:10px;">
                    <h3>Total Earnings</h3>
                    <h2>TK <?= $earnings ?></h2>
                </div>

            </div>

        </div>

    </div>

    <div class="side-panel">
        <a href="technicianRequest.php" class="side-btn">Technician Request</a>
        <a href="addProduct.php" class="side-btn">Add New Product</a>
        <a href="products.php" class="side-btn">View Products</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout</a>
    </div>

</div>

</body>
</html>

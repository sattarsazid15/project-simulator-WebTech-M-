<?php
session_start();
require_once('../models/orderModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit;
}

$result = getAllOrders();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../assets/css/adminOrders.css">
    <script src="../assets/js/ajax.js"></script>
</head>
<body>

<div id="header">
    <h2>Admin Panel</h2>
    <h1>Order Management</h1>
</div>

<div id="main-container">

    <div id="content-area">
        <div id="table-box">
            <h3>Customer Orders List</h3>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Total (Tk)</th>
                        <th>Update Status</th>
                        <th>Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>#<?= $row['id']; ?></td>
                            <td>
                                <b><?= $row['customer_name']; ?></b><br>
                                <span class="customer-address"><?= $row['address']; ?></span>
                            </td>
                            <td><?= $row['contact']; ?></td>
                            <td><?= $row['total_amount']; ?></td>
                            <td>
                                <select id="status-select-<?= $row['id']; ?>">
                                    <option value="Pending" <?= ($row['status']=='Pending')?'selected':''; ?>>Pending</option>
                                    <option value="Processing" <?= ($row['status']=='Processing')?'selected':''; ?>>Processing</option>
                                    <option value="Delivered" <?= ($row['status']=='Delivered')?'selected':''; ?>>Delivered</option>
                                    <option value="Cancelled" <?= ($row['status']=='Cancelled')?'selected':''; ?>>Cancelled</option>
                                </select>
                                
                                <button type="button" class="btn-update" onclick="updateOrderStatus(<?= $row['id']; ?>)">Update</button>
                            </td>
                            
                            <td id="status-text-<?= $row['id']; ?>" class="status-<?= $row['status']; ?>">
                                <?= $row['status']; ?>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6" class="text-center">No orders found.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="side-panel">
        <a href="adminDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="technicianRequest.php" class="side-btn">Technician Request 🛠️</a>
        <a href="productManagement.php" class="side-btn">Manage Products 📦</a>
        <a href="adminOrders.php" class="side-btn" id="active-btn">Manage Orders 🚚</a>
        <a href="adminCustomers.php" class="side-btn">Manage Customers 👥</a>
        <a href="adminTechnicians.php" class="side-btn">Manage Technicians 👨‍🔧</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>
</body>
</html>
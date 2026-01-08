<?php
session_start();
require_once('../models/orderModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}

$my_orders = getOrdersByCustomer($_SESSION['customer']['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Order Status</title>
    <link rel="stylesheet" href="../assets/css/repairStatus.css">
</head>
<body>

<div id="header">
    <h2>Welcome <?= $_SESSION['customer']['username']; ?></h2>
    <h1>Order Status Tracking</h1>
</div>

<div id="main-container">

    <div id="content-area">
        <div id="status-box">
            <h2 id="status-header">My Orders</h2>

            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($my_orders) > 0) { 
                        while($row = mysqli_fetch_assoc($my_orders)) { ?>
                        <tr>
                            <td>#<?= $row['id']; ?></td>
                            <td><?= date('d M Y, h:i A', strtotime($row['order_date'])); ?></td>
                            <td>Tk <?= $row['total_amount']; ?></td>
                            <td><?= $row['payment_method']; ?></td>
                            
                            <td class="status-<?= $row['status']; ?>">
                                <?= $row['status']; ?>

                                <?php if($row['status'] == 'Delivered' && !hasFeedback($row['id'])) { ?>
                                    <br>
                                <a href="orderFeedback.php?order_id=<?= $row['id']; ?>" class="review-btn">
                                    Give Review
                                </a>
                                <?php } ?>
                            </td>

                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="5" class="no-data">You haven't placed any orders yet.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="side-panel">
        <a href="customerDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="customerEditProfile.php" class="side-btn">Edit Profile 👤</a>
        <a href="orderStatus.php" class="side-btn" id="active-btn">Order Status 📦</a>
        <a href="repairRequest.php" class="side-btn">Request Repair 🛠️</a>
        <a href="repairStatus.php" class="side-btn">Repair Status ⚙️</a>
        <a href="checkout.php" class="side-btn">Checkout 💳</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
<?php
session_start();
require_once('../models/orderModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit;
}

$feedbacks = getAllFeedbacks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Feedback</title>
    <link rel="stylesheet" href="../assets/css/productManagement.css">
</head>
<body>

<div id="header">
    <h2>Admin Panel</h2>
    <h1>Customer Feedback</h1>
</div>

<div id="main-container">
    <div id="content-area">

        <div id="table-box">

            <div id="table-header">
                <h3>Order Feedback List</h3>
                <a href="adminDashboard.php" class="btn" id="back-btn">&larr; Back</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Submitted By</th>
                        <th>Feedback</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(mysqli_num_rows($feedbacks) > 0) { ?>
                        <?php while($row = mysqli_fetch_assoc($feedbacks)) { ?>
                            <tr>
                                <td>#<?= $row['order_id']; ?></td>
                                <td><?= htmlspecialchars($row['username']); ?></td>
                                <td><?= htmlspecialchars($row['feedback']); ?></td>
                                <td><?= date('d M Y', strtotime($row['created_at'])); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No feedback submitted yet.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
</html>

<?php
session_start();
require_once('../models/repairModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}

$my_repairs = getRequestsByCustomer($_SESSION['customer']['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Repair Status</title>
    <link rel="stylesheet" href="../assets/css/repairStatus.css">
</head>
<body>

<div id="header">
    <h2>Welcome <?= $_SESSION['customer']['username']; ?></h2>
    <h1>Repair Status Tracking</h1>
</div>

<div id="main-container">

    <div id="content-area">
        <div id="status-box">
            <h2 id="status-header">My Repair Requests</h2>

            <table>
                <thead>
                    <tr>
                        <th>Device Name</th>
                        <th>Issue Description</th>
                        <th>Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($my_repairs) > 0) { 
                        while($row = mysqli_fetch_assoc($my_repairs)) { ?>
                        <tr>
                            <td><?= $row['device_name']; ?></td>
                            <td><?= $row['issue_description']; ?></td>
                            <td class="status-<?= $row['status']; ?>">
                                <?= $row['status']; ?>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="3" class="no-data">You haven't requested any repairs yet.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="side-panel">
        <a href="customerDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="customerEditProfile.php" class="side-btn">Edit Profile 👤</a>
        <a href="repairRequest.php" class="side-btn">Request Repair 🛠️</a>
        <a href="repairStatus.php" class="side-btn" id="active-btn">Repair Status ⚙️</a>
        <a href="checkout.php" class="side-btn">Checkout 💳</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
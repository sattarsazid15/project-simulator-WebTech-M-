<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Technician Request</title>
    <link rel="stylesheet" href="../assets/css/technicianRequest.css">
</head>
<body>

<div id="header">
    <h2>Admin Panel</h2>
    <h1>Manage Technician Requests</h1>
</div>

<div id="main-container">

    <div id="content-area">
        <div id="request-box">
            <h3>Pending Technicians</h3>

            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Specialization</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getPendingTechnicians();
                    if(mysqli_num_rows($result) > 0){
                        while($tech = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?= $tech['email']; ?></td>
                            <td><?= $tech['username']; ?></td>
                            <td><?= $tech['specialization']; ?></td>
                            <td>
                                <a href="../controllers/adminAuth.php?approve=<?= $tech['id']; ?>" class="action-btn btn-approve" onclick="return confirm('Approve this technician?');">Approve</a>
                                <a href="../controllers/adminAuth.php?decline=<?= $tech['id']; ?>" class="action-btn btn-decline" onclick="return confirm('Decline this technician?');">Decline</a>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='4' class='no-data'>No pending technician requests.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="side-panel">
        <a href="adminDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="technicianRequest.php" class="side-btn" id="active-btn">Technician Request 🛠️</a>
        <a href="products.php" class="side-btn">Manage Products 📦</a>
        <a href="adminOrders.php" class="side-btn">Manage Orders 🚚</a>
        <a href="adminCustomers.php" class="side-btn">Manage Customers 👥</a>
        <a href="adminTechnicians.php" class="side-btn">Manage Technicians 👨‍🔧</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
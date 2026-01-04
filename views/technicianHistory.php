<?php
session_start();
require_once('../models/repairModel.php');

if (!isset($_SESSION['technician']) && !isset($_COOKIE['tech_status'])) {
    header("Location: technicianLogin.php");
    exit();
}

$history = getCompletedRequestsByTechnician($_SESSION['technician']['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job History</title>
    <link rel="stylesheet" href="../assets/css/technicianDashboard.css">
</head>
<body>

<div id="header">
    <h2>Technician Panel</h2>
    <h1>My Job History</h1>
</div>

<div id="main-container">

    <div id="content-area">
        <div class="table-box">
            <h3>Completed Repairs</h3>
            <table>
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>Issue</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($history) > 0) {
                        while($row = mysqli_fetch_assoc($history)) { ?>
                        <tr>
                            <td><?= $row['device_name']; ?></td>
                            <td><?= $row['issue_description']; ?></td>
                            <td><?= $row['request_date']; ?></td>
                            <td><strong class="status-completed">Completed</strong></td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="4" class="text-center">No completed jobs found.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>

    <div id="side-panel">
        <a href="technicianDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="technicianEditProfile.php" class="side-btn">Edit Profile 👤</a>
        <a href="technicianHistory.php" class="side-btn" id="active-btn">My History 📜</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
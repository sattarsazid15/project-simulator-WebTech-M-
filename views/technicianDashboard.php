<?php
session_start();
require_once('../models/repairModel.php');

if (!isset($_SESSION['technician']) && !isset($_COOKIE['tech_status'])) {
    header("Location: technicianLogin.php");
    exit();
}

$pending_requests = getPendingRequests();
$my_requests = getRequestsByTechnician($_SESSION['technician']['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="../assets/css/technicianDashboard.css">
</head>
<body>

<div id="header">
    <h2>Welcome, <?= $_SESSION['technician']['username']; ?></h2>
    <h1>Technician Panel</h1>
</div>

<div id="main-container">

    <div id="content-area">
        
        <div class="table-box">
            <h3>Available Repair Requests (Pending)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Customer</th> <th>Device</th>
                        <th>Issue</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($pending_requests) > 0) { 
                        while($row = mysqli_fetch_assoc($pending_requests)) { ?>
                        <tr>
                            <td>
                                <strong><?= $row['username']; ?></strong><br>
                                <small class="customer-email"><?= $row['email']; ?></small>
                            </td>
                            <td><?= $row['device_name']; ?></td>
                            <td><?= $row['issue_description']; ?></td>
                            <td><?= $row['request_date']; ?></td>
                            <td class="action-buttons">
                                <form method="POST" action="../controllers/repairStatusController.php">
                                    <input type="hidden" name="claim_id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn-claim">Claim</button>
                                </form>

                                <form method="POST" action="../controllers/repairStatusController.php">
                                    <input type="hidden" name="reject_id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn-reject" onclick="return confirm('Reject this request? It will be removed from the list.');">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="5" class="text-center">No pending requests available.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <h3>My Active Jobs</h3>
            <table>
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($my_requests) > 0) {
                        while($row = mysqli_fetch_assoc($my_requests)) { ?>
                        <tr>
                            <td><?= $row['device_name']; ?></td>
                            <td><?= $row['issue_description']; ?></td>
                            <td><strong><?= $row['status']; ?></strong></td>
                            <td>
                                <form method="POST" action="../controllers/repairStatusController.php">
                                    <input type="hidden" name="complete_id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn-complete">Mark Completed</button>
                                </form>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="4" class="text-center">You have no active jobs.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <div id="side-panel">
        <a href="technicianEditProfile.php" class="side-btn">Edit Profile 👤</a>
        <a href="technicianHistory.php" class="side-btn">My History 📜</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
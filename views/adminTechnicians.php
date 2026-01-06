<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) { 
    header("Location: adminLogin.php");
    exit; 
}

$result = getAllApprovedTechnicians();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Technicians</title>
    <link rel="stylesheet" href="../assets/css/productManagement.css">
</head>
<body>

<div id="header">
    <h2>Admin Panel</h2>
    <h1>Manage Technicians</h1>
</div>

<div id="main-container">
    <div id="content-area">
        <div id="table-box">
            
            <div id="table-header">
                <h3>Technician List</h3>
                <a href="adminDashboard.php" class="btn" id="back-btn">&larr; Back</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Experience</th>
                        <th>Shop Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['specialization']; ?></td>
                        <td><?= $row['experience']; ?> years</td>
                        <td><?= $row['shop_details']; ?></td>
                        <td><?= $row['dob']; ?></td>
                        <td><?= $row['gender']; ?></td>
                        <td>
                            <a href="editTechnicianByAdmin.php?id=<?= $row['id']; ?>" class="action-link btn-edit">Edit</a>
                            <a href="../controllers/adminAuth.php?delete_technician=<?= $row['id']; ?>" class="action-link btn-delete" onclick="return confirm('Delete this technician?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
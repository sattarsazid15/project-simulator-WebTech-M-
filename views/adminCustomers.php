<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) { 
    header("Location: adminLogin.php");
    exit; 
}

$result = getAllCustomers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <link rel="stylesheet" href="../assets/css/productManagement.css"> 
</head>
<body>

<div id="header">
    <h2>Admin Panel</h2>
    <h1>Manage Customers</h1>
</div>

<div id="main-container">
    <div id="content-area">
        
        <div id="table-box">
            
            <div id="table-header">
                <h3>Registered Customers</h3>
                <a href="adminDashboard.php" class="btn" id="back-btn">&larr; Back</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="editCustomerByAdmin.php?id=<?= $row['id']; ?>" class="action-link btn-edit">Edit</a>
                            <a href="../controllers/adminAuth.php?delete_customer=<?= $row['id']; ?>" class="action-link btn-delete" onclick="return confirm('Delete this customer?');">Delete</a>
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
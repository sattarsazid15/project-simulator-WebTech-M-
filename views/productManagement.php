<?php
session_start();
require_once('../models/productModel.php');

if (!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])) {
    header("Location: adminLogin.php");
    exit;
}

$result = getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="../assets/css/productManagement.css">
    <script src="../assets/js/ajax.js"></script> </head>
<body>

<div id="header">
    <h2>Admin Panel</h2>
    <h1>Product Management</h1>
</div>

<div id="main-container">
    <div id="content-area">
        <div id="table-box">
            
            <div id="table-header">
                <h3>All Products List</h3>
                <div>
                    <a href="adminDashboard.php" class="btn" id="back-btn">&larr; Back to Dashboard</a>
                    <a href="addProduct.php" class="btn btn-add">+ Add New Product</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr id="row-<?= $row['id']; ?>">
                        <td>
                            <img src="../assets/uploads/<?= $row['image']; ?>" alt="Product">
                        </td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['type']; ?></td>
                        <td>Tk <?= $row['price']; ?></td>
                        <td>
                            <a href="editProduct.php?id=<?= $row['id']; ?>" class="action-link btn-edit">Edit</a>
                            
                            <button class="action-link btn-delete" 
                                    onclick="deleteProduct(<?= $row['id']; ?>)" 
                                    style="border:none; cursor:pointer;">Delete</button>
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
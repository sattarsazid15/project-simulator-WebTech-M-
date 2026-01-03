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
    <link rel="stylesheet" href="../assets/css/products.css">
</head>
<body>

<div class="header">
    <h2>Admin Panel</h2>
    <h1>Product Management</h1>
</div>

<div class="main-container">
    
    <div class="content-area">
        <div class="table-box">
            
            <div class="table-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3>All Products List</h3>
            <div>
                <a href="adminDashboard.php" class="btn" style="background-color: #6c757d; margin-right: 10px;">&larr; Back to Dashboard</a>
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
                    <tr>
                        <td>
                            <img src="../assets/uploads/<?= $row['image']; ?>" width="60" height="60" style="object-fit: cover; border-radius: 4px;">
                        </td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['type']; ?></td>
                        <td>Tk <?= $row['price']; ?></td>
                        <td>
                            <a href="editProduct.php?id=<?= $row['id']; ?>" class="action-link btn-edit">Edit</a>
                            
                            <a href="../controllers/productController.php?delete=<?= $row['id']; ?>" 
                               class="action-link btn-delete" 
                               onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
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
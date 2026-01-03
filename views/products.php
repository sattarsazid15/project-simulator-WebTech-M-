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
    <link rel="stylesheet" href="../assets/css/technicianDashboard.css">
    <link rel="stylesheet" href="../assets/css/style1.css">
</head>
<body>

<div class="header">
    <h2>Admin Panel</h2>
    <h1>Product Management</h1>
</div>

<div class="main-container">
    
    <div class="content-area" style="width: 100%;">
        <div class="table-box">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
        <h3>All Products List</h3>
        <a href="addProduct.php" class="btn" style="background-color: #28a745;">+ Add New Product</a>
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
                    <a href="editProduct.php?id=<?= $row['id']; ?>" class="btn-claim" style="background-color: #007bff; text-decoration:none;">Edit</a>
                            
                    <a href="../controllers/productController.php?delete=<?= $row['id']; ?>" 
                    class="btn-claim" 
                    style="background-color: #dc3545; text-decoration:none;"
                    onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
         <center>
            <a href="adminDashboard.php" class="btn">Back to Dashboard</a>
        </center>
    </div>
</div>

</body>
</html>
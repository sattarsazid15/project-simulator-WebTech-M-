<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Menu</title>
</head>
<body>

    <h2>Product Management</h2>

    <a href="add_mobile.php">Add Mobile</a><br><br>
    <a href="add_computer.php">Add Computer</a><br><br>
    <a href="add_gadget.php">Add Gadget</a><br><br>
    
    <h3>Manage Products</h3>
    <a href="delete_product.php">Remove Product</a><br><br>
    <a href="delete_product.php">Edit Product</a><br><br>

    <h4>Category Filter</h4>
    <a href="category_filter.php?type=mobile">Mobile Products</a><br>
    <a href="category_filter.php?type=computer">Computer Products</a><br>
    <a href="category_filter.php?type=gadget">Gadget Products</a><br><br>
    
    <h5>Customer View</h5>
    <a href="customer_products.php">View Products as Customer</a>
    
    <br><br>
    <a href="../controllers/logout.php">Logout</a>

</body>
</html>
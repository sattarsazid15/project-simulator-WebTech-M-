<?php
session_start();

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>

<div class="form-container" id="add-product-container">
    <h2>Add New Product</h2>

    <form method="post" action="../controllers/productController.php" enctype="multipart/form-data" id="add-product-form">
        
        <div class="form-group">
            <label for="product-type">Product Category</label>
            <select name="type" id="product-type" required>
                <option value="">-- Select Type --</option>
                <option value="mobile">Mobile</option>
                <option value="computer">Computer</option>
                <option value="gadget">Gadget</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product-name">Product Name / Model</label>
            <input type="text" name="name" id="product-name" placeholder="e.g. iPhone 15 Pro or HP Pavilion" required>
        </div>

        <div class="form-group">
            <label for="product-price">Price (Tk)</label>
            <input type="number" name="price" id="product-price" placeholder="e.g. 50000" required>
        </div>

        <div class="form-group">
            <label for="product-desc">Description & Specs</label>
            <textarea name="description" id="product-desc" rows="5" placeholder="Enter RAM, Processor, Battery, and other details here..."></textarea>
        </div>

        <div class="form-group">
            <label for="product-image">Product Image (Mandatory)</label>
            <input type="file" name="image" id="product-image" required>
        </div>

        <button type="submit" name="add_product" id="add-btn">Add Product</button>
    </form>

    <div class="form-footer">
        <a href="adminDashboard.php" id="back-link">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
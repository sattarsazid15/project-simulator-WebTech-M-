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
    <link rel="stylesheet" href="../assets/css/style1.css">
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>

<div class="form-container">
    <h2>Add New Product</h2>

    <form method="post" action="../controllers/productController.php" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Product Category</label>
            <select name="type" required>
                <option value="">-- Select Type --</option>
                <option value="mobile">Mobile</option>
                <option value="computer">Computer</option>
                <option value="gadget">Gadget</option>
            </select>
        </div>

        <div class="form-group">
            <label>Product Name / Model</label>
            <input type="text" name="name" placeholder="e.g. iPhone 15 Pro or HP Pavilion" required>
        </div>

        <div class="form-group">
            <label>Price (Tk)</label>
            <input type="number" name="price" placeholder="e.g. 50000" required>
        </div>

        <div class="form-group">
            <label>Description & Specs</label>
            <textarea name="description" rows="5" placeholder="Enter RAM, Processor, Battery, and other details here..."></textarea>
        </div>

        <div class="form-group">
            <label>Product Image (Mandatory)</label>
            <input type="file" name="image" required>
        </div>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <div class="form-footer">
        <a href="adminDashboard.php">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
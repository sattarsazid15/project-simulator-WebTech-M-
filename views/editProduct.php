<?php
session_start();

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit();
}
if(!isset($_GET['id'])){
    header("Location: productManagement.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/productForm.css">
    <script src="../assets/js/ajax.js"></script>
</head>
<body onload="fetchProductDetails()">

<div class="form-container" id="edit-product-container">
    <h2>Edit Product</h2>

    <form method="post" action="../controllers/productController.php" enctype="multipart/form-data" id="edit-product-form">
        
        <input type="hidden" name="id" value="<?= $_GET['id']; ?>">

        <div class="form-group">
            <label for="product-type">Product Category</label>
            <select name="type" id="product-type" required>
                <option value="mobile">Mobile</option>
                <option value="computer">Computer</option>
                <option value="gadget">Gadget</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product-name">Product Name / Model</label>
            <input type="text" name="name" id="product-name" required>
        </div>

        <div class="form-group">
            <label for="product-price">Price (Tk)</label>
            <input type="number" name="price" id="product-price" required>
        </div>

        <div class="form-group">
            <label for="product-desc">Description & Specs</label>
            <textarea name="description" id="product-desc" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label>Current Image</label><br>
            <img src="" id="current-image" alt="Current Product Image" style="width: 100px; display: block;">
            
            <label for="product-image-input">Change Image (Optional)</label>
            <input type="file" name="image" id="product-image-input">
        </div>

        <button type="submit" name="update_product" id="update-btn">Update Product</button>
    </form>

    <div class="form-footer" id="form-footer">
        <a href="productManagement.php" id="back-link">Back to Product List</a>
    </div>
</div>

</body>
</html>
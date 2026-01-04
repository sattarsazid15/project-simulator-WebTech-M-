<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit();
}
if(!isset($_GET['id'])){
    header("Location: productManagement.php");
    exit();
}
$id = $_GET['id'];
$product = getProductById($id);

if(!$product){
    echo "Product not found.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>

<div class="form-container" id="edit-product-container">
    <h2>Edit Product</h2>

    <form method="post" action="../controllers/productController.php" enctype="multipart/form-data" id="edit-product-form">
        
        <input type="hidden" name="id" value="<?= $product['id']; ?>">

        <div class="form-group">
            <label for="product-type">Product Category</label>
            <select name="type" id="product-type" required>
                <option value="mobile" <?= ($product['type'] == 'mobile' || $product['type'] == 'Mobile') ? 'selected' : ''; ?>>Mobile</option>
                <option value="computer" <?= ($product['type'] == 'computer' || $product['type'] == 'Computer') ? 'selected' : ''; ?>>Computer</option>
                <option value="gadget" <?= ($product['type'] == 'gadget' || $product['type'] == 'Gadget') ? 'selected' : ''; ?>>Gadget</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product-name">Product Name / Model</label>
            <input type="text" name="name" id="product-name" value="<?= $product['name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="product-price">Price (Tk)</label>
            <input type="number" name="price" id="product-price" value="<?= $product['price']; ?>" required>
        </div>

        <div class="form-group">
            <label for="product-desc">Description & Specs</label>
            <textarea name="description" id="product-desc" rows="5"><?= isset($product['description']) ? $product['description'] : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label>Current Image</label><br>
            <img src="../assets/uploads/<?= $product['image']; ?>" id="current-image" alt="Current Product Image">
            
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
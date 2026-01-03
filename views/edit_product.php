<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: admin_login.php");
    exit();
}
if(!isset($_GET['id'])){
    header("Location: products.php");
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
    <link rel="stylesheet" href="../assets/css/style1.css">
    <link rel="stylesheet" href="../assets/css/product_form.css">
</head>
<body>

<div class="form-container">
    <h2>Edit Product</h2>
<form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?= $product['id']; ?>">

        <div class="form-group">
            <label>Product Category</label>
        <select name="type" required>
            <option value="mobile" <?= ($product['type'] == 'mobile' || $product['type'] == 'Mobile') ? 'selected' : ''; ?>>Mobile</option>
            <option value="computer" <?= ($product['type'] == 'computer' || $product['type'] == 'Computer') ? 'selected' : ''; ?>>Computer</option>
            <option value="gadget" <?= ($product['type'] == 'gadget' || $product['type'] == 'Gadget') ? 'selected' : ''; ?>>Gadget</option>
        </select>
        </div>

        <div class="form-group">
            <label>Product Name / Model</label>
            <input type="text" name="name" value="<?= $product['name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Price (Tk)</label>
            <input type="number" name="price" value="<?= $product['price']; ?>" required>
        </div>

        <div class="form-group">
            <label>Description & Specs</label>
            <textarea name="description" rows="5"><?= isset($product['description']) ? $product['description'] : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label>Current Image</label><br>
            <img src="../assets/uploads/<?= $product['image']; ?>" width="100" style="margin-bottom: 10px; border-radius: 5px; border: 1px solid #ddd;">
            
            <label>Change Image (Optional)</label>
            <input type="file" name="image">
        </div>

        <button type="submit" name="update_product">Update Product</button>
    </form>

    <div class="form-footer">
        <a href="products.php">Back to Product List</a>
    </div>
</div>

</body>
</html>
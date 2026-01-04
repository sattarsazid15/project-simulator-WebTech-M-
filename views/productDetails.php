<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}

if(!isset($_GET['id'])) {
    header("Location: customerDashboard.php");
    exit();
}

$product = getProductById($_GET['id']);

if(!$product){
    echo "Product not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $product['name']; ?> - Details</title>
    <link rel="stylesheet" href="../assets/css/productDetails.css">
</head>
<body>

<div id="header">
    <h2>Welcome <?= $_SESSION['customer']['username']; ?></h2>
    <h1>Online Mobile Shop</h1>
</div>

<div id="details-container">
    
    <div id="product-image-box">
        <img src="../assets/uploads/<?= $product['image']; ?>" alt="Product Image">
    </div>

    <div id="product-info-box">
        <h2><?= $product['name']; ?></h2>
        
        <div class="product-price">Tk <?= $product['price']; ?></div>
        
        <div class="product-desc">
            <strong>Description:</strong><br>
            <?= nl2br($product['description']); ?>
        </div>

        <form method="POST" action="../controllers/cartController.php" id="add-to-cart-form">
            <input type="hidden" name="action" value="add"> 
            <input type="hidden" name="id" value="<?= $product['id']; ?>">
            
            <label for="qty"><strong>Qty:</strong></label>
            <input type="number" name="qty" id="qty" value="1" min="1" max="5" class="qty-input">
            
            <button type="submit" id="add-cart-btn">Add to Cart</button>
        </form>

        <a href="customerDashboard.php" class="btn-back">&larr; Back to Products</a>
    </div>

</div>

</body>
</html>
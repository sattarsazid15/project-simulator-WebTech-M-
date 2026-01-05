<?php
require_once('../models/productModel.php');


if(!isset($_GET['id'])) {
    header("Location: guestDashboard.php");
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
    <h2>Welcome</h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
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

        <form method="POST" action="" id="add-to-cart-form">
            <input type="hidden" name="action" value="add"> 
            <input type="hidden" name="id" value="<?= $product['id']; ?>">
            
            <button type="submit" id="add-cart-btn" onclick="loginAlert()">Add to Cart</button>
        </form>

        <a href="guestDashBoard.php" class="btn-back">&larr; Back to Products</a>
    </div>

</div>

<script>
    function loginAlert(){
    alert("Please login first to add items to cart!");
}
</script>

</body>
</html>
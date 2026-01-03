<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_GET['id'])) header("Location: customer_products.php");
$product = getProductById($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head><title><?php echo $product['name']; ?></title></head>
<body>
<center>
    <h2><?php echo $product['name']; ?></h2>
    <img src="../assets/uploads/<?php echo $product['image']; ?>" width="200"><br>
    
    <h3>Price: <?php echo $product['price']; ?> Tk</h3>
    <p><b>Type:</b> <?php echo $product['type']; ?></p>
    <p><b>Description:</b><br><?php echo $product['description']; ?></p>

    <br>
    <form method="POST" action="../controllers/cartController.php">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
        <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
        
        Quantity: <input type="number" name="qty" value="1" min="1" max="10">
        <br><br>
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>

    <br>
    <a href="customer_products.php">Back to Products</a>
</center>
</body>
</html>
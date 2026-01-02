<?php
session_start();
require_once('../models/productModel.php');

$type = $_GET['type'];
$result = getProductsByType($type);
?>

<!DOCTYPE html>
<html>
<head><title><?php echo ucfirst($type); ?> Products</title></head>
<body>
<center>
    <h2>Category: <?php echo ucfirst($type); ?></h2>
    <a href="product_menu.php">Back to Menu</a>
    <br><br>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div style="border:1px solid gray; padding:10px; margin:10px; width: 200px; display:inline-block;">
            <img src="../assets/uploads/<?php echo $row['image']; ?>" width="100"><br>
            <h3><?php echo $row['name']; ?></h3>
            <p>Price: <?php echo $row['price']; ?> Tk</p>
            <a href="product_details.php?id=<?php echo $row['id']; ?>">View Details</a>
        </div>
    <?php } ?>
</center>
</body>
</html>
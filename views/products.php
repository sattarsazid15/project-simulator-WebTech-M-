<?php
session_start();
require_once('../models/productModel.php');

$result = getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
</head>
<body>
<center>
    <h2>Available Products</h2>
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <br><br>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div style="border:1px solid #ccc; padding:10px; margin:10px; display:inline-block; width:200px;">
            <img src="../assets/uploads/<?php echo $row['image']; ?>" width="100" height="100"><br>
            <b><?php echo $row['name']; ?></b><br>
            Type: <?php echo $row['type']; ?><br>
            Price: $<?php echo $row['price']; ?><br><br>
            <a href="product_details.php?id=<?php echo $row['id']; ?>"><button>View Details / Buy</button></a>
                <button type="button" onclick="alert('Added to Cart!')">Add to Cart</button>
            </form>
        </div>
    <?php } ?>

</center>
</body>
</html>
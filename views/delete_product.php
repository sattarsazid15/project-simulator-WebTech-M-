<?php 
session_start(); 
require_once('../models/productModel.php');
$result = getAllProducts();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>
<center>
    <h2>Manage Products</h2>
    <a href="product_menu.php">Back to Menu</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><img src="../assets/uploads/<?php echo $row['image']; ?>" width="50"></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['price']; ?> Tk</td>
            <td>
                <a href="../controllers/product_controller.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</center>
</body>
</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

<h2>Manage Products</h2>

<table border="1">
<tr>
    <th>Image</th>
    <th>Type</th>
    <th>Action</th>
</tr>

<?php
if (!empty($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $index => $product) {
        echo "<tr>";
        echo "<td><img src='../assets/uploads/".$product['image']."' width='80'></td>";
        echo "<td>".$product['type']."</td>";
        echo "<td>
            <a href='../controllers/product_controller.php?edit=$index'>Edit</a>
            |
            <a href='../controllers/product_controller.php?delete=$index'>Delete</a>
        </td>";
        echo "</tr>";
    }
}
?>
</table>

</body>
</html>

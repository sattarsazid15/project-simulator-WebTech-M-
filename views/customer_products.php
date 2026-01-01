<?php
session_start();
$products = $_SESSION['products'] ?? [];
?>

<!DOCTYPE html>
<html>
<body>

<h2>Available Products</h2>

<?php
foreach ($products as $product) {
    echo "<div style='border:1px solid black; padding:10px; margin:10px'>";
    echo "<img src='../assets/uploads/".$product['image']."' width='120'><br>";
    echo "Type: ".$product['type']."<br>";
    echo "Price: ".$product['data']['price']."<br>";
    echo "Model: ".$product['data']['model']."<br>";
    echo "RAM: ".$product['data']['ram']."<br>";
    echo "</div>";
}
?>

</body>
</html>

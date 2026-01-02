<?php
session_start();
$products = $_SESSION['products'] ?? [];
$category = $_GET['type'] ?? '';
?>

<!DOCTYPE html>
<html>
<body>

<h2>Category: <?php echo $category; ?></h2>

<?php
foreach ($products as $product) {
    if ($product['type'] == $category) {
        echo "<div style='border:1px solid gray; padding:10px; margin:10px'>";
        echo "<img src='../assets/uploads/".$product['image']."' width='100'><br>";
        echo "Price: ".$product['data']['price']."<br>";
        echo "Model: ".$product['data']['model']."<br>";
        echo "</div>";
    }
}
?>

</body>
</html>

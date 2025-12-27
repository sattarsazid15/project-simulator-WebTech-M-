<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['products'][$id]);
    header("Location: ../views/delete_product.php");
    exit;
}

session_start();

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

$imageName = $_FILES['image']['name'];
$imageTmp = $_FILES['image']['tmp_name'];

if ($imageName != "") {
    move_uploaded_file($imageTmp, "../assets/uploads/" . $imageName);
}

$product = [
    'type' => $_POST['type'],
    'image' => $imageName,
    'data' => $_POST
];

$_SESSION['products'][] = $product;

echo "Product added successfully.";
echo "<br><a href='../views/product_menu.php'>Back</a>";

<?php
session_start();


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['products'][$id]);

    setcookie("last_action", "Product deleted", time() + 3000, "/");

    header("Location: ../views/delete_product.php");
    exit;
}


if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}


if (
    !isset($_POST['type']) || $_POST['type'] == "" ||
    !isset($_POST['price']) || $_POST['price'] == ""
) {
    echo "Required fields missing.";
    exit;
}

$imageName = $_FILES['image']['name'];
$imageTmp  = $_FILES['image']['tmp_name'];

if ($imageName != "") {
    move_uploaded_file($imageTmp, "../assets/uploads/" . $imageName);
}


$product = [
    'type'  => $_POST['type'],
    'image' => $imageName,
    'data'  => $_POST
];

$_SESSION['products'][] = $product;


setcookie(
    "last_added_product",
    $_POST['type'],
    time() + 3000,
    "/"
);

echo "Product added successfully.";
echo "<br><a href='../views/product_menu.php'>Back</a>";

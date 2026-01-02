<?php
session_start();
require_once('../models/productModel.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if(deleteProduct($id)){
        header("Location: ../views/delete_product.php");
    } else {
        echo "Failed to delete product.";
    }
    exit;
}

if (isset($_POST['type'])) {
    
    if($_POST['price'] == "" || $_POST['type'] == ""){
        echo "Price and Type are required.";
        exit;
    }

    $imageName = $_FILES['image']['name'];
    $imageTmp  = $_FILES['image']['tmp_name'];

    if ($imageName != "") {
        move_uploaded_file($imageTmp, "../assets/uploads/" . $imageName);
    }

    $name = isset($_POST['model']) ? $_POST['model'] : (isset($_POST['brand']) ? $_POST['brand'] : 'Unknown Product');
    
    $product = [
        'name' => $name,
        'type' => $_POST['type'],
        'price' => $_POST['price'],
        'description' => isset($_POST['description']) ? $_POST['description'] : '',
        'image' => $imageName
    ];

    if(addProduct($product)){
        echo "Product added to Database successfully.";
        echo "<br><a href='../views/product_menu.php'>Back to Menu</a>";
    } else {
        echo "Error adding product to Database.";
    }

} else {
    header("Location: ../views/product_menu.php");
}
?>
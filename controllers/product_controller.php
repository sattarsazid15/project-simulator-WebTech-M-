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

    if (!isset($_FILES['image']['name']) || $_FILES['image']['name'] == "") {
        echo "Error: Product Image is Mandatory.";
        exit;
    }

    $imageName = "";
    $src = $_FILES['image']['tmp_name'];
    
    $ext = explode('.', $_FILES['image']['name']);
    $index = count($ext) - 1;
    
    $imageName = time() . "." . $ext[$index]; 
    $des = '../assets/uploads/' . $imageName;

    if(move_uploaded_file($src, $des)) {
    
    } else {
        echo "Error uploading file.";
        exit;
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
        echo "<br><a href='../views/admin_dashboard.php'>Back to Dashboard</a>";
    } else {
        echo "Error adding product to Database.";
    }

} else {
    header("Location: ../views/admin_dashboard.php");
}
?>
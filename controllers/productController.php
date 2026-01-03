<?php
session_start();
require_once('../models/productModel.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if(deleteProduct($id)){
        header("Location: ../views/deleteProduct.php");
    } else {
        echo "Failed to delete product.";
    }
    exit;
}

if (isset($_POST['update_product'])) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $imageName = "";

 
    if($name == "" || $price == "" || $type == ""){
        echo "Name, Price, and Type are required.";
        exit;
    }

  
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        
        $src = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];

      
        $extArray = explode('.', $originalName);
        $index = count($extArray) - 1;
        $ext = strtolower($extArray[$index]);

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if(!in_array($ext, $allowed_extensions)){
            echo "Error: Invalid file type. Only JPG, PNG, WEBP, and GIF are allowed.";
            exit;
        }

        $imageName = time() . "." . $ext;
        $des = '../assets/uploads/' . $imageName;

        if(!move_uploaded_file($src, $des)) {
            echo "Error uploading file.";
            exit;
        }
    }

    $product = [
        'id' => $id,
        'name' => $name,
        'type' => $type,
        'price' => $price,
        'description' => $description,
        'image' => $imageName 
    ];

    if(updateProduct($product)){
        echo "Product updated successfully! <br>";
        echo "<a href='../views/products.php'>Back to Product List</a>";
    } else {
        echo "Error updating product.";
    }
    exit; 
}

if (isset($_POST['type'])) {
    
    if($_POST['price'] == "" || $_POST['type'] == "" || $_POST['name'] == ""){
        echo "Name, Price, and Type are required.";
        exit;
    }

    if (!isset($_FILES['image']['name']) || $_FILES['image']['name'] == "") {
        echo "Error: Product Image is Mandatory.";
        exit;
    }

    $imageName = "";
    $src = $_FILES['image']['tmp_name'];
    $originalName = $_FILES['image']['name'];

    $extArray = explode('.', $originalName);
    $index = count($extArray) - 1;
    $ext = strtolower($extArray[$index]);

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if(!in_array($ext, $allowed_extensions)){
        echo "Error: Invalid file type. Only JPG, PNG, WEBP, and GIF are allowed.";
        exit;
    }

    $imageName = time() . "." . $ext; 
    $des = '../assets/uploads/' . $imageName;

    if(move_uploaded_file($src, $des)) {
        
    } else {
        echo "Error uploading file.";
        exit;
    }
    
    $product = [
        'name' => $_POST['name'], 
        'type' => $_POST['type'],
        'price' => $_POST['price'],
        'description' => isset($_POST['description']) ? $_POST['description'] : '',
        'image' => $imageName
    ];

    if(addProduct($product)){
        echo "Product added successfully! <br>";
        echo "<a href='../views/adminDashboard.php'>Back to Dashboard</a>";
    } else {
        echo "Error adding product to Database.";
    }

} else {
    header("Location: ../views/adminDashboard.php");
}
?>
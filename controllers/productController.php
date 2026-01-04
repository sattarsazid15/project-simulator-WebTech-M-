<?php
session_start();
require_once('../models/productModel.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if(deleteProduct($id)){
        header("Location: ../views/productManagement.php");
    } else {
        echo "<script>alert('Failed to delete product.'); window.location='../views/productManagement.php';</script>";
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
        echo "<script>alert('Name, Price, and Type are required.'); window.history.back();</script>";
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
            echo "<script>alert('Error: Invalid file type.'); window.history.back();</script>";
            exit;
        }

        $imageName = time() . "." . $ext;
        $des = '../assets/uploads/' . $imageName;

        if(!move_uploaded_file($src, $des)) {
            echo "<script>alert('Error uploading file.'); window.history.back();</script>";
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
        header("Location: ../views/productManagement.php");
    } else {
        echo "<script>alert('Error updating product.'); window.history.back();</script>";
    }
    exit; 
}

if (isset($_POST['type'])) {
    
    if($_POST['price'] == "" || $_POST['type'] == "" || $_POST['name'] == ""){
        echo "<script>alert('Name, Price, and Type are required.'); window.history.back();</script>";
        exit;
    }

    if (!isset($_FILES['image']['name']) || $_FILES['image']['name'] == "") {
        echo "<script>alert('Error: Product Image is Mandatory.'); window.history.back();</script>";
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
        echo "<script>alert('Error: Invalid file type.'); window.history.back();</script>";
        exit;
    }

    $imageName = time() . "." . $ext; 
    $des = '../assets/uploads/' . $imageName;

    if(!move_uploaded_file($src, $des)) {
        echo "<script>alert('Error uploading file.'); window.history.back();</script>";
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
        header("Location: ../views/productManagement.php");
    } else {
        echo "<script>alert('Error adding product to Database.'); window.history.back();</script>";
    }

} else {
    header("Location: ../views/adminDashboard.php");
}
?>
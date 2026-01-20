<?php
session_start();
require_once('../models/productModel.php');

if (isset($_GET['action']) && $_GET['action'] == 'get_product' && isset($_GET['id'])) {
    $product = getProductById($_GET['id']);
    echo json_encode($product);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'search' && isset($_GET['value'])) {
    $value = $_GET['value'];
    $result = searchProducts($value);
    $products = [];
    while($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode($products);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'filter' && isset($_GET['value'])) {
    $value = $_GET['value'];
    if($value == 'all') {
        $result = getAllProducts();
    } else {
        $result = getProductsByType($value);
    }
    $products = [];
    while($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode($products);
    exit;
}


if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
    $id = $_POST['id'];
    if(deleteProduct($id)){
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
    exit;
}


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
    
}

if (isset($_POST['action']) && $_POST['action'] == 'toggle_wishlist' && isset($_POST['id'])) {
    if (!isset($_SESSION['customer'])) {
        echo json_encode(['status' => 'unauthorized']);
        exit;
    }

    $user_id = $_SESSION['customer']['id'];
    $product_id = $_POST['id'];

    if (isInWishlist($user_id, $product_id)) {
        if (removeFromWishlist($user_id, $product_id)) {
            echo json_encode(['status' => 'removed']);
        }
    } else {
        if (addToWishlist($user_id, $product_id)) {
            echo json_encode(['status' => 'added']);
        }
    }
    exit;
}
?>
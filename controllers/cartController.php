<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_POST['action']) && $_POST['action'] == 'update_qty_ajax'){
    $id = $_POST['id'];
    $qty = (int)$_POST['qty'];

    if($qty < 1) $qty = 1;
    if($qty > 5) $qty = 5;

    $_SESSION['cart'][$id] = $qty;

    $product = getProductById($id);
    $itemSubtotal = $product['price'] * $qty;
    
    $grandTotal = 0;
    foreach($_SESSION['cart'] as $cartId => $cartQty){
        $p = getProductById($cartId);
        if($p) $grandTotal += ($p['price'] * $cartQty);
    }

    echo json_encode([
        'status' => 'success',
        'subtotal' => $itemSubtotal,
        'grandTotal' => $grandTotal
    ]);
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'remove_item_ajax'){
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);

    $grandTotal = 0;
    foreach($_SESSION['cart'] as $cartId => $cartQty){
        $p = getProductById($cartId);
        if($p) $grandTotal += ($p['price'] * $cartQty);
    }

    echo json_encode([
        'status' => 'success',
        'grandTotal' => $grandTotal,
        'isEmpty' => empty($_SESSION['cart'])
    ]);
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'add'){
    
    $id = $_POST['id'];
    $quantityToAdd = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;
    
    if($quantityToAdd < 1) $quantityToAdd = 1;

    if(isset($_SESSION['cart'][$id])){
        $newQty = $_SESSION['cart'][$id] + $quantityToAdd;

        if($newQty <= 5){
            $_SESSION['cart'][$id] = $newQty;
            echo "<script>
                    alert('Item quantity updated!'); 
                    window.location.href = '../views/customerDashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Limit reached! You can only buy 5 of this item.'); 
                    window.location.href = '../views/customerDashboard.php';
                  </script>";
        }
    } else {
        if($quantityToAdd <= 5){
            $_SESSION['cart'][$id] = $quantityToAdd;
            echo "<script>
                    alert('Added to cart!'); 
                    window.location.href = '../views/customerDashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('You cannot add more than 5 items at once.'); 
                    window.location.href = '../views/productDetails.php?id=$id';
                  </script>";
        }
    }
    exit;
}

if(isset($_POST['update_qty'])){
    $id = $_POST['id'];
    $qty = (int)$_POST['qty'];
    if($qty < 1) $qty = 1;
    if($qty > 5) $qty = 5; 
    $_SESSION['cart'][$id] = $qty;
    header("Location: ../views/checkout.php");
    exit;
}

if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: ../views/checkout.php");
    exit;
}

if(isset($_GET['clear'])){
    unset($_SESSION['cart']);
    header("Location: ../views/customerDashboard.php");
    exit;
}
?>
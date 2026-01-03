<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_POST['action']) && $_POST['action'] == 'add'){
    
    $id = $_POST['id'];
    
   
    if(isset($_SESSION['cart'][$id])){
        if($_SESSION['cart'][$id] < 5){
            $_SESSION['cart'][$id]++;
            echo "<script>
                    alert('Item quantity increased!'); 
                    window.location.href = '../views/customerDashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Limit reached! You can only buy 5 of this item.'); 
                    window.location.href = '../views/customerDashboard.php';
                  </script>";
        }
    } else {
       
        $_SESSION['cart'][$id] = 1;
        echo "<script>
                alert('Added to cart!'); 
                window.location.href = '../views/customerDashboard.php';
              </script>";
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
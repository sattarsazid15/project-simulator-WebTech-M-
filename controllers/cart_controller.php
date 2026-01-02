<?php
session_start();

if(isset($_POST['add_to_cart'])){
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $item = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'qty' => $qty
    ];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach($_SESSION['cart'] as $key => $val){
        if($val['id'] == $id){
            $_SESSION['cart'][$key]['qty'] += $qty;
            $found = true;
            break;
        }
    }

    if(!$found){
        array_push($_SESSION['cart'], $item);
    }

    header("Location: ../views/checkout.php");
}
?>
<?php
session_start();
require_once('../models/orderModel.php');

if (isset($_POST['action']) && $_POST['action'] == 'update_status') {
    
    if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        exit;
    }

    $id = $_POST['id'];
    $status = $_POST['status'];

    if(updateOrderStatus($id, $status)){
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
    }
    exit;
}

if(isset($_POST['total_amount'])){

    if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
        header("Location: ../views/customerLogin.php");
        exit();
    }
    
    $order = [
        'customer_id' => $_SESSION['customer']['id'],
        'customer_name' => $_SESSION['customer']['username'],
        'contact' => $_POST['contact'], 
        'address' => $_POST['address'], 
        'total_amount' => $_POST['total_amount'],
        'status' => 'Pending',
        'payment_method' => isset($_POST['payment_method']) ? $_POST['payment_method'] : 'Cash on Delivery'
    ];

    if(addOrder($order)){
        unset($_SESSION['cart']);
        
        echo "<script>
                alert('Order Placed Successfully!'); 
                window.location.href = '../views/customerDashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error placing order. Please try again.'); 
                window.history.back();
              </script>";
    }
    exit;
}

header("Location: ../views/checkout.php");
?>
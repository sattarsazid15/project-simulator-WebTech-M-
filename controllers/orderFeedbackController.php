<?php
session_start();
require_once('../models/orderModel.php');

if(!isset($_SESSION['customer'])){
    header("Location: ../views/customerLogin.php");
    exit;
}

if(isset($_POST['order_id'], $_POST['feedback'])){
    $orderId = $_POST['order_id'];
    $feedback = trim($_POST['feedback']);
    $customerId = $_SESSION['customer']['id'];

    if($feedback == ""){
        echo "<script>alert('Feedback cannot be empty'); window.history.back();</script>";
        exit;
    }

    if(addOrderFeedback($orderId, $customerId, $feedback)){
        echo "<script>
                alert('Thank you for your feedback!');
                window.location='../views/orderStatus.php';
              </script>";
    } else {
        echo "<script>alert('Failed to submit feedback');</script>";
    }
}

<?php
session_start();
require_once('../models/db.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: ../views/customerLogin.php");
    exit();
}

if(isset($_POST['total_amount'])){
    
    $con = getConnection();
    
    $customer_name = $_SESSION['customer']['username'];
    $contact = "017XXXXXXXX";
    $address = "Dhaka, Bangladesh";
    $total = $_POST['total_amount'];
    $status = "Pending";

    $sql = "INSERT INTO orders (customer_name, contact, address, total_amount, status) 
            VALUES ('{$customer_name}', '{$contact}', '{$address}', '{$total}', '{$status}')";

    if(mysqli_query($con, $sql)){
        unset($_SESSION['cart']);
        
        echo "<script>
                alert('Order Placed Successfully!'); 
                window.location.href = '../views/customerDashboard.php';
              </script>";
    } else {
        echo "Error placing order: " . mysqli_error($con);
    }
} else {
    header("Location: ../views/checkout.php");
}
?>
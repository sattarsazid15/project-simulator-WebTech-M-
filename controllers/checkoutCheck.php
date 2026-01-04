<?php
session_start();
require_once('../models/orderModel.php');
require_once('../models/productModel.php');

if(!isset($_SESSION['customer'])){
    header("Location: ../views/customerLogin.php");
    exit();
}

if(isset($_POST['submit'])){

    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $payment = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];

    if(empty($fullname) || empty($contact) || empty($address) || empty($payment)){
        echo "<script>alert('Please fill in all shipping details.'); window.history.back();</script>";
        exit();
    }

    if(!is_numeric($contact) || strlen($contact) != 11) {
        echo "<script>alert('Invalid contact number! It must be exactly 11 digits.'); window.history.back();</script>";
        exit();
    }

    $orderData = [
        'customer_id' => $_SESSION['customer']['id'],
        'customer_name' => $fullname,
        'contact' => $contact,
        'address' => $address,
        'total_amount' => $total_amount,
        'status' => 'Pending',
        'payment_method' => $payment
    ];

    $order_id = addOrder($orderData);

    if($order_id){
        $invoiceItems = [];
        foreach($_SESSION['cart'] as $id => $qty){
            $product = getProductById($id);
            if($product){
                $invoiceItems[] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'qty' => $qty
                ];
            }
        }

        $_SESSION['current_order'] = [
            'order_id' => $order_id,
            'date' => date("Y-m-d H:i:s"),
            'customer_name' => $fullname,
            'contact' => $contact,
            'address' => $address,
            'payment_method' => $payment,
            'total_amount' => $total_amount,
            'items' => $invoiceItems
        ];

        unset($_SESSION['cart']);
        header("Location: ../views/invoice.php");
        exit();

    } else {
        echo "Error placing order.";
    }

} else {
    header("Location: ../views/checkout.php");
}
?>
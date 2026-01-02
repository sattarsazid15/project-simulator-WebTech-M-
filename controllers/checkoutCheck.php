<?php 
    session_start();
    require_once('../models/orderModel.php');

    if(isset($_REQUEST['submit'])){

        $fullname = $_REQUEST['fullname'];
        $contact = $_REQUEST['contact'];
        $address = $_REQUEST['address'];
        $payment_method = $_REQUEST['payment_method'];

        if($fullname == "" || $contact == "" || $address == "" || $payment_method == ""){
            echo "Please fill all the fields!";
        } else {
            
            $total = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $item){
                    $total += $item['price'] * $item['qty'];
                }
            }

            $order = [
                'customer_name' => $fullname,
                'contact' => $contact,
                'address' => $address,
                'total_amount' => $total
            ];

            $order_id = addOrder($order);

            if($order_id){
                $_SESSION['current_order'] = $order;
                $_SESSION['current_order']['order_id'] = $order_id;
                $_SESSION['current_order']['items'] = $_SESSION['cart'];
                $_SESSION['current_order']['date'] = date("Y-m-d");
                $_SESSION['current_order']['payment_method'] = $payment_method;

                unset($_SESSION['cart']);
                
                header('location: ../views/invoice.php');
            } else {
                echo "Error placing order in Database.";
            }
        }

    } else {
        header('location: ../views/checkout.php');
    }
?>
<?php 
    session_start();

    if(isset($_REQUEST['submit'])){

        $fullname = $_REQUEST['fullname'];
        $contact = $_REQUEST['contact'];
        $address = $_REQUEST['address'];
        $payment_method = $_REQUEST['payment_method'];

        if($fullname == "" || $contact == "" || $address == "" || $payment_method == ""){
            echo "Please fill all the fields!";
        } else {
            
            $total = 0;
            $items = [];
            
            if(isset($_SESSION['cart'])){
                $items = $_SESSION['cart'];
                foreach($items as $item){
                    $total += $item['price'] * $item['qty'];
                }
            }

            $order = [
                'order_id' => rand(1000, 9999),
                'customer_name' => $fullname,
                'contact' => $contact,
                'address' => $address,
                'payment_method' => $payment_method,
                'items' => $items,
                'total_amount' => $total,
                'date' => date("Y-m-d H:i:s")
            ];

            if(!isset($_SESSION['order_history'])){
                $_SESSION['order_history'] = [];
            }
            array_push($_SESSION['order_history'], $order);

            $_SESSION['current_order'] = $order;

            unset($_SESSION['cart']);

            header('location: ../views/invoice.php');
        }

    } else {
        header('location: ../views/checkout.php');
    }
?>
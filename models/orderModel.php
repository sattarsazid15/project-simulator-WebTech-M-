<?php
require_once('db.php');

function addOrder($order){
    $con = getConnection();
    $customerId = isset($order['customer_id']) ? $order['customer_id'] : 0;
    $payMethod = isset($order['payment_method']) ? $order['payment_method'] : 'Cash on Delivery';

    $sql = "INSERT INTO orders (customer_id, customer_name, contact, address, total_amount, status, payment_method) 
            VALUES (
                '{$customerId}', 
                '{$order['customer_name']}', 
                '{$order['contact']}', 
                '{$order['address']}', 
                '{$order['total_amount']}', 
                '{$order['status']}', 
                '{$payMethod}'
            )";
    
    if(mysqli_query($con, $sql)){
        return mysqli_insert_id($con);
    }
    return false;
}

function getAllOrders(){
    $con = getConnection();
    $sql = "SELECT * FROM orders ORDER BY order_date DESC";
    return mysqli_query($con, $sql);
}

function getOrdersByCustomer($customer_id){
    $con = getConnection();
    $sql = "SELECT * FROM orders WHERE customer_id='{$customer_id}' ORDER BY order_date DESC";
    return mysqli_query($con, $sql);
}

function getTotalEarnings(){
    $con = getConnection();
    $sql = "SELECT SUM(total_amount) as total FROM orders WHERE status='Delivered'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ? $row['total'] : "0.00";
}

function updateOrderStatus($id, $status){
    $con = getConnection();
    $sql = "UPDATE orders SET status='{$status}' WHERE id='{$id}'";
    return mysqli_query($con, $sql);
}

function addOrderFeedback($orderId, $customerId, $feedback){
    $con = getConnection();
    $sql = "INSERT INTO order_feedback (order_id, customer_id, feedback)
            VALUES ('$orderId', '$customerId', '$feedback')";
    return mysqli_query($con, $sql);
}

function getAllFeedbacks(){
    $con = getConnection();
    $sql = "SELECT f.order_id, f.feedback, f.created_at, u.username
            FROM order_feedback f
            JOIN users u ON f.customer_id = u.id
            ORDER BY f.created_at DESC";
    return mysqli_query($con, $sql);
}

function hasFeedback($orderId){
    $con = getConnection();
    $sql = "SELECT id FROM order_feedback WHERE order_id='$orderId'";
    $res = mysqli_query($con, $sql);
    return mysqli_num_rows($res) > 0;
}
?>
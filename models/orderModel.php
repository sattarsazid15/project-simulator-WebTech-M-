<?php
require_once('db.php');

function addOrder($order){
    $con = getConnection();
    $sql = "INSERT INTO orders (customer_id, customer_name, contact, address, total_amount, status, payment_method) 
            VALUES (
                '{$order['customer_id']}', 
                '{$order['customer_name']}', 
                '{$order['contact']}', 
                '{$order['address']}', 
                '{$order['total_amount']}', 
                '{$order['status']}', 
                '{$order['payment_method']}'
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
?>
<?php
require_once('db.php');

function addOrder($order){
    $con = getConnection();
    $sql = "INSERT INTO orders (customer_name, contact, address, total_amount, status) 
            VALUES (
                '{$order['customer_name']}', 
                '{$order['contact']}', 
                '{$order['address']}', 
                '{$order['total_amount']}', 
                'Pending'
            )";
    
    if(mysqli_query($con, $sql)){
        return mysqli_insert_id($con);
    } else {
        return false;
    }
}

function getAllOrders(){
    $con = getConnection();
    $sql = "SELECT * FROM orders ORDER BY order_date DESC";
    return mysqli_query($con, $sql);
}

function updateOrderStatus($id, $status){
    $con = getConnection();
    $sql = "UPDATE orders SET status='{$status}' WHERE id={$id}";
    return mysqli_query($con, $sql);
}
?>
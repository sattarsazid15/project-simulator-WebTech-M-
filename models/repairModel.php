<?php
require_once('db.php');

function addRepairRequest($request){
    $con = getConnection();
    $sql = "INSERT INTO repair_requests (customer_id, device_name, issue_description, status) 
            VALUES ('{$request['customer_id']}', '{$request['device_name']}', '{$request['issue_description']}', 'Pending')";
    return mysqli_query($con, $sql);
}

function getPendingRequests(){
    $con = getConnection();
    $sql = "SELECT r.*, u.username, u.email 
            FROM repair_requests r 
            JOIN users u ON r.customer_id = u.id 
            WHERE r.status='Pending'";
    return mysqli_query($con, $sql);
}

function getRequestsByTechnician($tech_id){
    $con = getConnection();
    $sql = "SELECT * FROM repair_requests WHERE technician_id='{$tech_id}' AND status != 'Completed'";
    return mysqli_query($con, $sql);
}

function assignRepair($request_id, $tech_id){
    $con = getConnection();
    $sql = "UPDATE repair_requests SET status='In Progress', technician_id='{$tech_id}' WHERE id='{$request_id}'";
    return mysqli_query($con, $sql);
}

function completeRepair($request_id){
    $con = getConnection();
    $sql = "UPDATE repair_requests SET status='Completed' WHERE id='{$request_id}'";
    return mysqli_query($con, $sql);
}

function rejectRepair($request_id){
    $con = getConnection();
    $sql = "UPDATE repair_requests SET status='Rejected' WHERE id='{$request_id}'";
    return mysqli_query($con, $sql);
}

function getCompletedRequestsByTechnician($tech_id){
    $con = getConnection();
    $sql = "SELECT * FROM repair_requests WHERE technician_id='{$tech_id}' AND status='Completed'";
    return mysqli_query($con, $sql);
}

function getRequestsByCustomer($customer_id){
    $con = getConnection();
    $sql = "SELECT * FROM repair_requests WHERE customer_id='{$customer_id}' ORDER BY id DESC";
    return mysqli_query($con, $sql);
}
?>
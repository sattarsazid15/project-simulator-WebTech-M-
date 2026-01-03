<?php
require_once('db.php');

function addRepairRequest($request){
    $con = getConnection();
    $sql = "INSERT INTO repair_requests (customer_id, device_name, issue_description, status) 
            VALUES (
                '{$request['customer_id']}', 
                '{$request['device_name']}', 
                '{$request['issue_description']}', 
                'Pending'
            )";
    return mysqli_query($con, $sql);
}

function getAllRepairRequests(){
    $con = getConnection();
    $sql = "SELECT * FROM repair_requests ORDER BY request_date DESC";
    return mysqli_query($con, $sql);
}
?>
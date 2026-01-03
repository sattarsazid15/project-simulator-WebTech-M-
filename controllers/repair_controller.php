<?php
session_start();
require_once('../models/repairModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: ../views/customer_login.php");
    exit();
}

if(isset($_POST['submit'])){
    
    $device = $_POST['device_name'];
    $issue = $_POST['issue_description'];
    
    if($device == "" || $issue == ""){
        echo "Please fill all fields.";
        exit;
    }

    $customer_id = 0;
    if(isset($_SESSION['customer']['id'])){
        $customer_id = $_SESSION['customer']['id'];
    } elseif(isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
    } else {
        echo "Error: User ID not found. Please re-login.";
        exit;
    }

    $request = [
        'customer_id' => $customer_id,
        'device_name' => $device,
        'issue_description' => $issue
    ];

    if(addRepairRequest($request)){
        header("Location: ../views/customer_menudemo.php?success=repair_submitted");
    } else {
        echo "Error submitting request.";
    }

} else {
    header("Location: ../views/repair_request.php");
}
?>
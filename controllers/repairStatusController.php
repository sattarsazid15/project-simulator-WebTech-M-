<?php
session_start();
require_once('../models/repairModel.php');

if(!isset($_SESSION['technician']) && !isset($_COOKIE['tech_status'])){
    header("Location: ../views/technicianLogin.php");
    exit();
}

$tech_id = $_SESSION['technician']['id'];

if(isset($_POST['claim_id'])){
    $request_id = $_POST['claim_id'];
    if(assignRepair($request_id, $tech_id)){
        header("Location: ../views/technicianDashboard.php");
    } else {
        echo "Error claiming job.";
    }
}

if(isset($_POST['complete_id'])){
    $request_id = $_POST['complete_id'];
    if(completeRepair($request_id)){
        header("Location: ../views/technicianDashboard.php");
    } else {
        echo "Error completing job.";
    }
}
?>
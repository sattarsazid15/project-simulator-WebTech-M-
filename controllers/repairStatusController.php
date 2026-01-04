<?php
session_start();
require_once('../models/repairModel.php');

if(isset($_POST['claim_id'])){
    $repair_id = $_POST['claim_id'];
    $tech_id = $_SESSION['technician']['id'];

    if(assignRepair($repair_id, $tech_id)){
        header("Location: ../views/technicianDashboard.php?msg=claimed");
    } else {
        echo "Error claiming job.";
    }
}

if(isset($_POST['complete_id'])){
    $repair_id = $_POST['complete_id'];

    if(completeRepair($repair_id)){
        header("Location: ../views/technicianDashboard.php?msg=completed");
    } else {
        echo "Error completing job.";
    }
}

if(isset($_POST['reject_id'])){
    $repair_id = $_POST['reject_id'];

    if(rejectRepair($repair_id)){
        header("Location: ../views/technicianDashboard.php?msg=rejected");
    } else {
        echo "Error rejecting job.";
    }
}
?>
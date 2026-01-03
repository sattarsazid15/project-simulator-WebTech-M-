<?php
session_start();
require_once('../models/technicianModel.php');

if ($_POST['username'] == "admin" && $_POST['password'] == "admin") {
    $_SESSION['admin'] = true;
    setcookie('admin_status', 'true', time()+3000, '/');
    header("Location: ../views/adminDashboard.php");
    exit();
} else {
    echo "Invalid admin login";
}


if(isset($_GET['approve'])){
    approveTechnician($_GET['approve']);
    header("Location: ../views/technicianRequest.php");
}

if(isset($_GET['decline'])){
    declineTechnician($_GET['decline']);
    header("Location: ../views/technicianRequest.php");
}

<?php
session_start();
require_once('../models/technician_model.php');

if ($_POST['username'] == "admin" && $_POST['password'] == "admin") {
    $_SESSION['admin'] = true;
    header("Location: ../views/admin_dashboard.php");
} else {
    echo "Invalid admin login";
}


if(isset($_GET['approve'])){
    approveTechnician($_GET['approve']);
    header("Location: ../views/admin_dashboard.php");
}

if(isset($_GET['decline'])){
    declineTechnician($_GET['decline']);
    header("Location: ../views/admin_dashboard.php");
}

<?php
session_start();
require_once('../models/technician_model.php');

$email = $_POST['email'];
$password = $_POST['password'];

if(technicianLogin($email, $password)){
    $_SESSION['technician'] = $email;
    header("Location: ../views/technician_dashboard.php");
}else{
    echo "Login failed or not approved yet";
}

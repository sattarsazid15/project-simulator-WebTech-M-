<?php
session_start();
require_once('../models/technicianModel.php');

$email = $_POST['email'];
$password = $_POST['password'];

if(technicianLogin($email, $password)){

    $tech = getTechnicianByEmail($email);

    $_SESSION['technician_logged_in'] = true;
    $_SESSION['technician'] = $tech;

    header("Location: ../views/technician_dashboard.php");
    exit;
}

echo "Invalid credentials or not approved";
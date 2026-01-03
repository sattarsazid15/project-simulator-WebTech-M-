<?php
session_start();
require_once('../models/technicianModel.php');

if(isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(technicianLogin($email, $password)){

        $tech = getTechnicianByEmail($email);

        $_SESSION['technician_logged_in'] = true;
        $_SESSION['technician'] = $tech;

        setcookie('tech_status', 'true', time()+3000, '/');

        header("Location: ../views/technician_dashboard.php");
        exit;
    } else {
        echo "Invalid credentials or not approved";
    }
} else {
    header("Location: ../views/technician_login.php");
}
?>
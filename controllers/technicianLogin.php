<?php
session_start();
require_once('../models/technicianModel.php');

if(isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(technicianLogin($email, $password)){

        $tech = getTechnicianByEmail($email);

        unset($_SESSION['admin']);
        unset($_SESSION['customer']);
        setcookie('admin_status', '', time()-3600, '/'); 
        setcookie('status', '', time()-3600, '/');

        $_SESSION['technician_logged_in'] = true;
        $_SESSION['technician'] = $tech;

        setcookie('tech_status', 'true', time()+3000, '/');

        header("Location: ../views/technicianDashboard.php");
        exit;
    } else {
        echo "<script>alert('Invalid credentials or account not approved yet.'); window.location='../views/technicianLogin.php';</script>";
    }
} else {
    header("Location: ../views/technicianLogin.php");
}
?>
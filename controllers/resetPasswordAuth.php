<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['reset_email'])){
    header("Location: ../views/customerLogin.php");
    exit;
}

$password = $_POST['password'];
$email = $_SESSION['reset_email'];

if(updatePassword($email, $password)){
    unset($_SESSION['reset_email']);
    header("Location: ../views/customerLogin.php");
} else {
    echo "Password update failed";
}

?>

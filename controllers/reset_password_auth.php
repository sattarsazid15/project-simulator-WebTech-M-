<?php
session_start();
require_once('../models/user_model.php');

if(!isset($_SESSION['reset_email'])){
    header("Location: ../views/customer_login.php");
    exit;
}

$password = $_POST['password'];
$email = $_SESSION['reset_email'];

if(updatePassword($email, $password)){
    unset($_SESSION['reset_email']);
    header("Location: ../views/customer_login.php");
} else {
    echo "Password update failed";
}

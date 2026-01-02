<?php
session_start();
require_once('../models/userModel.php');

if($_POST['action'] == "signup"){
    $user = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    if(addUser($user)){
        header("Location: ../views/customer_login.php");
    } else {
        echo "Signup failed";
    }
}

if($_POST['action'] == "login"){
    $user = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    if(loginUser($user)){
        $_SESSION['customer_logged_in'] = true;
        $userData = getUserByEmail($user['email']);
        $_SESSION['customer_name'] = $userData['username'];
        header("Location: ../views/customer_menudemo.php");
    } else {
        echo "Invalid Login";
    }
}
?>

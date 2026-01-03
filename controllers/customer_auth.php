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
        exit;
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

        $userData = getUserByEmail($user['email']);

        $_SESSION['customer'] = [
            'id' => $userData['id'],
            'username' => $userData['username'],
            'email' => $userData['email']
        ];

        setcookie('status', 'true', time()+3000, '/');

        header("Location: ../views/customer_menudemo.php");
        exit;

    } else {
        echo "Invalid Login";
    }
}
?>

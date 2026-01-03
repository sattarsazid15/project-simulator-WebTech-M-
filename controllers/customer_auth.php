<?php
session_start();
require_once('../models/userModel.php');

if(isset($_POST['action']) && $_POST['action'] == "signup"){
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($username) || empty($email) || empty($password)){
        echo "All fields are required.";
        exit;
    }

    if(strlen($username) < 2){
        echo "Username must be at least 2 characters.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if(strlen($password) < 6){
        echo "Password must be at least 6 characters.";
        exit;
    }

    $user = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    if(addUser($user)){
        header("Location: ../views/customer_login.php?success=registered");
        exit;
    } else {
        echo "Signup failed. Email might already exist.";
    }
}

if(isset($_POST['action']) && $_POST['action'] == "login"){
    $user = [
        'email' => trim($_POST['email']),
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
        echo "Invalid Login Credentials.";
    }
}
?>
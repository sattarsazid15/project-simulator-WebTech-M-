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

     if(checkEmailExists($email)){
        echo "<script>
            alert('Email already exists. Please login.');
            window.location='../views/customerSignup.php';
        </script>";
        exit;
    }

    $user = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    if(addUser($user)){
        header("Location: ../views/customerLogin.php?success=registered");
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

        unset($_SESSION['admin']);
        unset($_SESSION['technician']);
        unset($_SESSION['technician_logged_in']);
        setcookie('admin_status', '', time()-3600, '/'); 
        setcookie('tech_status', '', time()-3600, '/');

        $_SESSION['customer'] = [
            'id' => $userData['id'],
            'username' => $userData['username'],
            'email' => $userData['email']
        ];

        setcookie('status', 'true', time()+3000, '/'); 

        header("Location: ../views/customerDashboard.php");
        exit;

    } else {
        echo "<script>alert('Invalid Login Credentials.'); window.location='../views/customerLogin.php';</script>";
    }
}
?>
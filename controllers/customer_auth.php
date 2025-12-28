<?php
session_start();

if ($_POST['action'] == "signup") {

    $_SESSION['customer'] = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    header("Location: ../views/customer_login.php");
    exit();
}

if ($_POST['action'] == "login") {

    if (
        isset($_SESSION['customer']) &&
        $_SESSION['customer']['email'] == $_POST['email'] &&
        $_SESSION['customer']['password'] == $_POST['password']
    ) {
        $_SESSION['logged_in'] = true;
        header("Location: ../views/customer_menudemo.php");
        exit();
    } else {
        echo "Invalid Login!";
    }
}
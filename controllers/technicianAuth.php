<?php
session_start();
require_once('../models/technicianModel.php');

if(isset($_POST['submit'])){

    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $specialist = trim($_POST['specialist']);
    $experience = trim($_POST['experience']);
    $dob = $_POST['dob'];
    $shop = trim($_POST['shop']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    if(empty($email) || empty($username) || empty($password) || empty($specialist) || empty($experience) || empty($dob) || empty($shop) || empty($gender)){
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    if(strlen($username) < 2){
        echo "<script>alert('Username must be at least 2 characters.'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }

    if(strlen($password) < 6){
        echo "<script>alert('Password must be at least 6 characters.'); window.history.back();</script>";
        exit;
    }

    if(!is_numeric($experience)){
        echo "<script>alert('Experience must be a number (years).'); window.history.back();</script>";
        exit;
    }

    if(technicianEmailExists($email)){
    echo "<script>alert('Email already exists'); window.history.back();</script>";
    exit;
    }

    if(technicianUsernameExists($username)){
    echo "<script>alert('Username already exists'); window.history.back();</script>";
    exit;
    }


    $tech = [
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'specialization' => $specialist,
        'experience' => $experience,
        'dob' => $dob,
        'gender' => $gender,
        'shop_details' => $shop
    ];

    if(addTechnician($tech)){
        echo "<script>
                alert('Registration submitted successfully! Please wait for admin approval.'); 
                window.location='../views/technicianLogin.php';
              </script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
    }

} else {
    header("Location: ../views/technicianSignup.php");
}
?>
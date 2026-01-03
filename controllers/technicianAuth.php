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

    if(!is_numeric($experience)){
        echo "Experience must be a number (years).";
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
        echo "Registration submitted. Wait for admin approval.<br>";
        echo "<a href='../index.php'>Back to Home</a>";
    } else {
        echo "Registration failed";
    }

} else {
    header("Location: ../views/technicianSignup.php");
}
?>
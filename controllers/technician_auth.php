<?php
session_start();
require_once('../models/technicianModel.php');

$tech = [
    'email' => $_POST['email'],
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'specialization' => $_POST['specialist'],
    'experience' => $_POST['experience'],
    'dob' => $_POST['dob'],
    'gender' => $_POST['gender'],
    'shop_details' => $_POST['shop']
];

if(addTechnician($tech)){
    echo "Registration submitted. Wait for admin approval.<br>";
    echo "<a href='../views/home.php'>Back to Home</a>";
}else{
    echo "Registration failed";
}

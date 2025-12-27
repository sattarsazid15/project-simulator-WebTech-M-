<?php
session_start();

$tech = [
    'email' => $_POST['email'],
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'specialist' => $_POST['specialist'],
    'experience' => $_POST['experience'],
    'dob' => $_POST['dob'],
    'gender' => $_POST['gender'],
    'shop' => $_POST['shop']
];

$_SESSION['pending_technicians'][] = $tech;

echo "Registration submitted. Wait for admin approval.";
echo "<br><a href='../views/home.php'>Back To Home</a>";
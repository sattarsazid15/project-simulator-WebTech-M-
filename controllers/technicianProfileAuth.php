<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['technician']) && !isset($_COOKIE['tech_status'])){
    header("Location: ../views/technicianLogin.php");
    exit;
}

$id = $_SESSION['technician']['id'];

if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $shop = $_POST['shop'];

    $status = updateTechnicianFullProfile($id, $username, $email, $specialization, $experience, $dob, $gender, $shop);

    if($status){
        $_SESSION['technician']['username'] = $username;
        $_SESSION['technician']['email'] = $email;
        $_SESSION['technician']['specialization'] = $specialization;
        $_SESSION['technician']['experience'] = $experience;
        $_SESSION['technician']['dob'] = $dob;
        $_SESSION['technician']['gender'] = $gender;
        $_SESSION['technician']['shop_details'] = $shop;

        echo "<script>alert('Profile updated successfully'); 
              window.location='../views/technicianEditProfile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile'); 
              window.location='../views/technicianEditProfile.php';</script>";
    }
    exit;
}

if(isset($_POST['change_password'])){
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if($new != $confirm){
        echo "<script>alert('Passwords do not match'); 
              window.location='../views/technicianEditProfile.php';</script>";
        exit;
    }

    if(changeTechnicianPassword($id, $old, $new)){
        echo "<script>alert('Password changed successfully'); 
              window.location='../views/technicianEditProfile.php';</script>";
    } else {
        echo "<script>alert('Old password is incorrect'); 
              window.location='../views/technicianEditProfile.php';</script>";
    }
}
?>
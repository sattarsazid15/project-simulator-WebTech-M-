<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['technician'])){
    header("Location: ../views/technician_login.php");
    exit;
}

$id = $_SESSION['technician']['id'];

if(isset($_POST['update_profile'])){
    $email = $_POST['email'];

    updateTechnicianProfile($id, $email);
    $_SESSION['technician']['email'] = $email;

    echo "<script>alert('Profile updated successfully'); 
          window.location='../views/technician_edit_profile.php';</script>";
    exit;
}

if(isset($_POST['change_password'])){
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if($new != $confirm){
        echo "<script>alert('Passwords do not match'); 
              window.location='../views/technician_edit_profile.php';</script>";
        exit;
    }

    if(changeTechnicianPassword($id, $old, $new)){
        echo "<script>alert('Password changed successfully'); 
              window.location='../views/technician_edit_profile.php';</script>";
    } else {
        echo "<script>alert('Old password is incorrect'); 
              window.location='../views/technician_edit_profile.php';</script>";
    }
}

<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['customer'])){
    header("Location: ../views/customerLogin.php");
    exit;
}

$userId = $_SESSION['customer']['id'];

if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $email = $_POST['email'];

    updateProfile($userId, $username, $email);

    $_SESSION['customer']['username'] = $username;
    $_SESSION['customer']['email'] = $email;

    header("Location: ../views/customerEditProfile.php?success=profile");
    exit;
}

if(isset($_POST['change_password'])){
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if($new != $confirm){
        header("Location: ../views/customerEditProfile.php?error=match");
        exit;
    }

    if(changePassword($userId, $old, $new)){
        header("Location: ../views/customerEditProfile.php?success=password");
    } else {
        header("Location: ../views/customerEditProfile.php?error=old");
    }
    exit;
}
?>

<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['customer'])){
    header("Location: ../views/customer_login.php");
    exit;
}

$userId = $_SESSION['customer']['id'];

if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $email = $_POST['email'];

    updateProfile($userId, $username, $email);

    $_SESSION['customer']['username'] = $username;
    $_SESSION['customer']['email'] = $email;

    header("Location: ../views/customer_edit_profile.php?success=profile");
    exit;
}

if(isset($_POST['change_password'])){
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if($new != $confirm){
        header("Location: ../views/customer_edit_profile.php?error=match");
        exit;
    }

    if(changePassword($userId, $old, $new)){
        header("Location: ../views/customer_edit_profile.php?success=password");
    } else {
        header("Location: ../views/customer_edit_profile.php?error=old");
    }
    exit;
}

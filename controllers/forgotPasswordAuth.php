<?php
session_start();
require_once('../models/userModel.php');

if (!isset($_POST['email'])) {
    header("Location: ../views/forgotPassword.php");
    exit();
}

$email = $_POST['email'];

$user = getUserByEmail($email);

if ($user) {
    $_SESSION['reset_email'] = $email;

    header("Location: ../views/resetPassword.php");
    exit();
} else {
    echo "Email not found!";
}
<<<<<<< HEAD
?>
=======

?>
>>>>>>> 44b5411b9b2883641a8aa10033209170651b60cf

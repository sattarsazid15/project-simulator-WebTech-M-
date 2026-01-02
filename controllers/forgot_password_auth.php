<?php
session_start();
require_once('../models/userModel.php');

if (!isset($_POST['email'])) {
    header("Location: ../views/forgot_password.php");
    exit();
}

$email = $_POST['email'];

// check if email exists
$user = getUserByEmail($email);

if ($user) {
    // store email in session for reset step
    $_SESSION['reset_email'] = $email;

    header("Location: ../views/reset_password.php");
    exit();
} else {
    echo "Email not found!";
}

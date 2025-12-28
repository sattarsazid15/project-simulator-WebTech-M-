<?php
session_start();

if ($_POST['username'] == "admin" && $_POST['password'] == "admin") {
    $_SESSION['admin'] = true;
    header("Location: ../views/admin_dashboard.php");
} else {
    echo "Invalid admin login";
}

if (isset($_GET['approve'])) {
    $index = $_GET['approve'];

    if (isset($_SESSION['pending_technicians'][$index])) {
        $_SESSION['approved_technicians'][] =
            $_SESSION['pending_technicians'][$index];

        unset($_SESSION['pending_technicians'][$index]);
    }

    header("Location: ../views/admin_dashboard.php");
    exit;
}
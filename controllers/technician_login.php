<?php
session_start();

if (!empty($_SESSION['approved_technicians'])) {
    foreach ($_SESSION['approved_technicians'] as $tech) {
        if ($_POST['username'] == $tech['username'] &&
            $_POST['password'] == $tech['password']) {

            $_SESSION['technician'] = $tech;
            header("Location: ../views/technician_dashboard.php");
            exit;
        }
    }
}

echo "Not approved or invalid credentials.";
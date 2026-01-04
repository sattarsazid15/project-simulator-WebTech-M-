<?php
session_start();
require_once('../models/userModel.php');
require_once('../models/technicianModel.php');

if ($_POST['username'] == "admin" && $_POST['password'] == "admin") {
    $_SESSION['admin'] = true;
    setcookie('admin_status', 'true', time()+3000, '/');
    header("Location: ../views/adminDashboard.php");
    exit();
} else {
    echo "Invalid admin login";
}

if(isset($_GET['approve'])){
    approveTechnician($_GET['approve']);
    header("Location: ../views/technicianRequest.php");
}

if(isset($_GET['decline'])){
    declineTechnician($_GET['decline']);
    header("Location: ../views/technicianRequest.php");
}

if(isset($_POST['update_customer_admin'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    if(updateCustomerByAdmin($id, $username, $email)){
        header("Location: ../views/adminCustomers.php?msg=updated");
    } else {
        echo "Error updating customer.";
    }
}

if(isset($_GET['delete_customer'])){
    $id = $_GET['delete_customer'];
    if(deleteCustomer($id)){
        header("Location: ../views/adminCustomers.php?msg=deleted");
    } else {
        echo "Error deleting customer.";
    }
}

if(isset($_POST['update_technician_admin'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $spec = $_POST['specialization'];
    
    if(updateTechnicianByAdmin($id, $username, $email, $spec)){
        header("Location: ../views/adminTechnicians.php?msg=updated");
    } else {
        echo "Error updating technician.";
    }
}

if(isset($_GET['delete_technician'])){
    $id = $_GET['delete_technician'];
    if(deleteTechnician($id)){
        header("Location: ../views/adminTechnicians.php?msg=deleted");
    } else {
        echo "Error deleting technician.";
    }
}
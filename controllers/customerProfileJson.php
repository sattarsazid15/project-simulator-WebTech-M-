<?php
session_start();
require_once('../models/userModel.php');

if(!isset($_SESSION['customer'])){
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['customer']['id'];
$user = getUserById($userId);

echo json_encode($user);
<<<<<<< HEAD
?>
=======

?>

>>>>>>> 44b5411b9b2883641a8aa10033209170651b60cf

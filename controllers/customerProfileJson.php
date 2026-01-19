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

?>


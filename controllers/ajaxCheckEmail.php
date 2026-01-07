<?php
require_once('../models/userModel.php');

if(isset($_POST['email'])){
    $email = $_POST['email'];

    if(checkEmailExists($email)){
        echo "exists";
    } else {
        echo "available";
    }
}
?>

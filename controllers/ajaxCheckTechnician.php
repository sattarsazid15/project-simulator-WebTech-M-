<?php
require_once('../models/technicianModel.php');

if(isset($_POST['email'])){
    if(technicianEmailExists($_POST['email'])){
        echo "email_exists";
    } else {
        echo "email_available";
    }
}

if(isset($_POST['username'])){
    if(technicianUsernameExists($_POST['username'])){
        echo "username_exists";
    } else {
        echo "username_available";
    }
}

?>

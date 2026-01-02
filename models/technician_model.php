<?php
require_once('db.php');

function addTechnician($tech){
    $con = getConnection();
    $sql = "INSERT INTO technicians 
    (email, username, password, specialization, experience, dob, gender, shop_details, status)
    VALUES (
        '{$tech['email']}',
        '{$tech['username']}',
        '{$tech['password']}',
        '{$tech['specialization']}',
        '{$tech['experience']}',
        '{$tech['dob']}',
        '{$tech['gender']}',
        '{$tech['shop_details']}',
        'pending'
    )";

    return mysqli_query($con, $sql);
}

function getPendingTechnicians(){
    $con = getConnection();
    $sql = "SELECT * FROM technicians WHERE status='pending'";
    return mysqli_query($con, $sql);
}

function approveTechnician($id){
    $con = getConnection();
    $sql = "UPDATE technicians SET status='approved' WHERE id=$id";
    return mysqli_query($con, $sql);
}

function declineTechnician($id){
    $con = getConnection();
    $sql = "DELETE FROM technicians WHERE id=$id";
    return mysqli_query($con, $sql);
}

function technicianLogin($email, $password){
    $con = getConnection();
    $sql = "SELECT * FROM technicians 
            WHERE email='$email' 
            AND password='$password' 
            AND status='approved'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) == 1;
}

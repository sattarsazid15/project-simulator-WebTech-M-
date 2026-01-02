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

function getTechnicianById($id){
    $con = getConnection();
    $sql = "SELECT * FROM technicians WHERE id=$id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function updateTechnicianEmail($id, $email){
    $con = getConnection();
    $sql = "UPDATE technicians SET email='$email' WHERE id=$id";
    return mysqli_query($con, $sql);
}

function changeTechnicianPassword($id, $old, $new){
    $con = getConnection();
    $check = "SELECT * FROM technicians 
              WHERE id=$id AND password='$old'";
    $res = mysqli_query($con, $check);

    if(mysqli_num_rows($res) == 1){
        $sql = "UPDATE technicians SET password='$new' WHERE id=$id";
        return mysqli_query($con, $sql);
    }
    return false;
}

function getTechnicianByEmail($email){
    $con = getConnection();
    $sql = "SELECT * FROM technicians WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}


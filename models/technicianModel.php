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

function updateTechnicianFullProfile($id, $username, $email, $specialization, $experience, $dob, $gender, $shop_details){
    $con = getConnection();
    $sql = "UPDATE technicians SET 
            username='{$username}', 
            email='{$email}', 
            specialization='{$specialization}', 
            experience='{$experience}', 
            dob='{$dob}', 
            gender='{$gender}', 
            shop_details='{$shop_details}' 
            WHERE id={$id}";
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

function getApprovedTechnCount(){
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS total FROM technicians WHERE status='approved'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}


function getAllApprovedTechnicians(){
    $con = getConnection();
    $sql = "SELECT * FROM technicians WHERE status='approved'"; 
    return mysqli_query($con, $sql);
}

function deleteTechnician($id){
    $con = getConnection();
    $sql = "DELETE FROM technicians WHERE id='{$id}'";
    return mysqli_query($con, $sql);
}

function updateTechnicianByAdmin($id, $username, $email, $specialization){
    $con = getConnection();
    $sql = "UPDATE technicians SET username='{$username}', email='{$email}', specialization='{$specialization}' WHERE id='{$id}'";
    return mysqli_query($con, $sql);
}

function technicianEmailExists($email){
    $con = getConnection();
    $sql = "SELECT id FROM technicians WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

function technicianUsernameExists($username){
    $con = getConnection();
    $sql = "SELECT id FROM technicians WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}
?>
<?php
require_once('db.php');

function addUser($user){
    $con = getConnection();
    $sql = "INSERT INTO users VALUES(
        null,
        '{$user['username']}',
        '{$user['password']}',
        '{$user['email']}'
    )";
    return mysqli_query($con, $sql);
}

function loginUser($user){
    $con = getConnection();
    $sql = "SELECT * FROM users 
            WHERE email='{$user['email']}' 
            AND password='{$user['password']}'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) == 1;
}

function getUserByEmail($email) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email='{$email}'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }

    return false;
}

function checkEmailExists($email){
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) == 1;
}

function updatePassword($email, $password){
    $con = getConnection();
    $sql = "UPDATE users SET password='$password' WHERE email='$email'";
    return mysqli_query($con, $sql);
}
?>

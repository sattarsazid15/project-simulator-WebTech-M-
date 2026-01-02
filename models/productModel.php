<?php
require_once('db.php');

function addProduct($product){
    $con = getConnection();
    $sql = "INSERT INTO products (name, type, price, description, image) 
            VALUES (
                '{$product['name']}', 
                '{$product['type']}', 
                '{$product['price']}', 
                '{$product['description']}', 
                '{$product['image']}'
            )";
    
    if(mysqli_query($con, $sql)){
        return true;
    } else {
        return false;
    }
}

function getAllProducts(){
    $con = getConnection();
    $sql = "SELECT * FROM products";
    return mysqli_query($con, $sql);
}

function getProductsByType($type){
    $con = getConnection();
    $sql = "SELECT * FROM products WHERE type='{$type}'";
    return mysqli_query($con, $sql);
}

function deleteProduct($id){
    $con = getConnection();
    $sql = "DELETE FROM products WHERE id={$id}";
    return mysqli_query($con, $sql);
}

function getProductById($id){
    $con = getConnection();
    $sql = "SELECT * FROM products WHERE id={$id}";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}
?>
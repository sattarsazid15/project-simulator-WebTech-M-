<?php
require_once('db.php');

function getAllProducts(){
    $con = getConnection();
    $sql = "SELECT * FROM products";
    return mysqli_query($con, $sql);
}

function getProductById($id){
    $con = getConnection();
    $sql = "SELECT * FROM products WHERE id='{$id}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getProductsByType($type){
    $con = getConnection();
    $sql = "SELECT * FROM products WHERE type='{$type}'";
    return mysqli_query($con, $sql);
}

function searchProducts($query){
    $con = getConnection();
    $sql = "SELECT * FROM products WHERE name LIKE '%{$query}%' OR type LIKE '%{$query}%'";
    return mysqli_query($con, $sql);
}

function addProduct($product){
    $con = getConnection();
    $sql = "INSERT INTO products (name, type, price, description, image) 
            VALUES ('{$product['name']}', '{$product['type']}', '{$product['price']}', '{$product['description']}', '{$product['image']}')";
    return mysqli_query($con, $sql);
}

function deleteProduct($id){
    $con = getConnection();
    $sql = "DELETE FROM products WHERE id='{$id}'";
    return mysqli_query($con, $sql);
}

function updateProduct($product){
    $con = getConnection();
    
   
    if($product['image'] != ""){
        $sql = "UPDATE products SET 
                name='{$product['name']}', 
                type='{$product['type']}', 
                price='{$product['price']}', 
                description='{$product['description']}', 
                image='{$product['image']}' 
                WHERE id='{$product['id']}'";
    } else {
        $sql = "UPDATE products SET 
                name='{$product['name']}', 
                type='{$product['type']}', 
                price='{$product['price']}', 
                description='{$product['description']}' 
                WHERE id='{$product['id']}'";
    }
    
    return mysqli_query($con, $sql);
}

function getTotalProducts(){
    $con = getConnection();
    $sql = "SELECT count(*) as count FROM products";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
function isInWishlist($user_id, $product_id) {
    $con = getConnection();
    $sql = "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}
function addToWishlist($user_id, $product_id) {
    $con = getConnection();
    $sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
    return mysqli_query($con, $sql);
}

function removeFromWishlist($user_id, $product_id) {
    $con = getConnection();
    $sql = "DELETE FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
    return mysqli_query($con, $sql);
}
function getUserWishlist($user_id) {
    $con = getConnection();
    $sql = "SELECT p.*, w.id as wishlist_id 
            FROM wishlist w 
            JOIN products p ON w.product_id = p.id 
            WHERE w.user_id = '$user_id'";
    return mysqli_query($con, $sql);
}
?>
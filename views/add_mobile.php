<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Mobile Product</title>
    <link rel="stylesheet" href="../assets/css/product_form.css">
</head>
<body>
</head>
<body>

<div class="form-container">
    <h2>Add Mobile Product</h2>

    <form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
        <input type="hidden" name="type" value="mobile">

        <label>Product Image</label>
        <input type="file" name="image">

        <label>Price</label>
        <input type="text" name="price">

        <label>Model</label>
        <input type="text" name="model">

        <label>Display Size</label>
        <input type="text" name="display">

        <label>Camera</label>
        <input type="text" name="camera">

        <label>Battery</label>
        <input type="text" name="battery">

        <label>Processor</label>
        <input type="text" name="processor">

        <label>RAM</label>
        <input type="text" name="ram">

        <button type="submit">Add Mobile</button>
    </form>
</div>

</body>
</html>

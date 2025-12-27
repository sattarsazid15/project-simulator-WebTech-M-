<!DOCTYPE html>
<html>
<body>

<h2>Add Mobile Product</h2>

<form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
    <input type="hidden" name="type" value="mobile">

    Product Image: <input type="file" name="image"><br><br>
    Price: <input type="text" name="price"><br><br>
    Model: <input type="text" name="model"><br><br>
    Display Size: <input type="text" name="display"><br><br>
    Camera: <input type="text" name="camera"><br><br>
    Battery: <input type="text" name="battery"><br><br>
    Processor: <input type="text" name="processor"><br><br>
    RAM: <input type="text" name="ram"><br><br>

    <button type="submit">Add Mobile</button>
</form>

</body>
</html>

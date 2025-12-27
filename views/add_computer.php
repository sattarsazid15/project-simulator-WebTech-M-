<!DOCTYPE html>
<html>
<body>

<h2>Add Computer Product</h2>

<form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
    <input type="hidden" name="type" value="computer">

    Product Image: <input type="file" name="image"><br><br>
    Price: <input type="text" name="price"><br><br>
    Brand: <input type="text" name="brand"><br><br>
    Processor: <input type="text" name="processor"><br><br>
    RAM: <input type="text" name="ram"><br><br>
    Storage: <input type="text" name="storage"><br><br>
    Display Size: <input type="text" name="display"><br><br>

    <button type="submit">Add Computer</button>
</form>

</body>
</html>

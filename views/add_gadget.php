<!DOCTYPE html>
<html>
<body>

<h2>Add Gadget</h2>

<form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
    <input type="hidden" name="type" value="gadget">

    Product Image: <input type="file" name="image"><br><br>
    Product Name: <input type="text" name="name"><br><br>
    Price: <input type="text" name="price"><br><br>
    Details: <input type="text" name="details"><br><br>

    <button type="submit">Add Gadget</button>
</form>

</body>
</html>

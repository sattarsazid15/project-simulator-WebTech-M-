<!DOCTYPE html>
<html>
<head>
    <title>Add Gadget Product</title>


    <link rel="stylesheet" href="../assets/css/product_form.css">
<body>

<div class="form-container">
    <h2>Add Gadget Product</h2>

    <form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
        <input type="hidden" name="type" value="gadget">

        <label>Product Image</label>
        <input type="file" name="image">

        <label>Price</label>
        <input type="text" name="price">

        <label>Brand</label>
        <input type="text" name="brand">

        <label>Description</label>
        <input type="text" name="description">

        <button type="submit">Add Gadget</button>
    </form>
</div>

</body>
</html>

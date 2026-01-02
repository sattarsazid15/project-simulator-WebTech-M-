<!DOCTYPE html>
<html>
<head>
    <title>Add Computer Product</title>
    <link rel="stylesheet" href="../assets/css/product_form.css">
</head>
<body>

<div class="form-container">
    <h2>Add Computer Product</h2>

    <form method="post" action="../controllers/product_controller.php" enctype="multipart/form-data">
        <input type="hidden" name="type" value="computer">

        <label>Product Image</label>
        <input type="file" name="image" required>

        <label>Price</label>
        <input type="text" name="price" required>

        <label>Brand</label>
        <input type="text" name="brand" required>

        <label>Processor</label>
        <input type="text" name="processor" required>

        <label>RAM</label>
        <input type="text" name="ram" required>

        <label>Storage</label>
        <input type="text" name="storage" required>

        <label>Display Size</label>
        <input type="text" name="display" required>

        <button type="submit">Add Computer</button>
    </form>
</div>

</body>
</html>

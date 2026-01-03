<?php
session_start();
require_once('../models/productModel.php');

$result = null;

if(isset($_GET['search']) && !empty($_GET['search'])){
    $searchQuery = $_GET['search'];
    $result = searchProducts($searchQuery);
} elseif(isset($_GET['type'])) {
    $result = getProductsByType($_GET['type']);
} else {
    $result = getAllProducts();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse Products</title>
    <link rel="stylesheet" href="../assets/css/productBrowse.css"> 
    <link rel="stylesheet" href="../assets/css/style1.css">
</head>
<body>

<center>
    <h2>Browse Products</h2>
    <a href="customerDashboard.php">Back to Dashboard</a>
    <br><br>

    <form method="GET" action="productBrowse.php">
        <input type="text" name="search" placeholder="Search by name or type..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Search</button>
        <a href="productBrowse.php"><button type="button">Reset</button></a>
    </form>

    <br>
    <div class="categories">
        Filter: 
        <a href="productBrowse.php?type=Mobile">Mobile</a> | 
        <a href="productBrowse.php?type=Computer">Computer</a> | 
        <a href="productBrowse.php?type=Gadget">Gadget</a>
    </div>
    <br>

    <div class="product-grid">
        <?php 
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){ 
        ?>
            <div style="border:1px solid #ccc; padding:10px; margin:10px; display:inline-block; width:200px; vertical-align:top;">
                <img src="../assets/uploads/<?php echo $row['image']; ?>" width="150" height="150" style="object-fit:cover;"><br>
                <h3><?php echo $row['name']; ?></h3>
                <p>Type: <?php echo $row['type']; ?></p>
                <p>Price: <?php echo $row['price']; ?> Tk</p>
                <a href="productDetails.php?id=<?php echo $row['id']; ?>">
                    <button>View Details</button>
                </a>
            </div>
        <?php 
            }
        } else {
            echo "<p>No products found matching your criteria.</p>";
        }
        ?>
    </div>

</center>
</body>
</html>
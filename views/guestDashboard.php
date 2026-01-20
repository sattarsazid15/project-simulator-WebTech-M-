<?php
require_once('../models/productModel.php');

$result = null;
if(isset($_GET['search']) && !empty($_GET['search'])){
    $result = searchProducts($_GET['search']); 
} else {
    $result = getAllProducts();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest</title>
    <link rel="stylesheet" href="../assets/css/customerMenu.css">
    <script>

        const isGuest = true;
    </script>
    <script src="../assets/js/ajax.js"></script>
</head>
<body>

<div id="header">
    <h2>Welcome Guest</h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
</div>

<div id="main-container">

    <div id="content-area">

        <div id="search-section">
            <input type="text" id="search-input" onkeyup="searchProducts()" placeholder="Search by name or type..." 
                   value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            
            <button type="button" id="search-btn" onclick="searchProducts()">Search</button>
            
            <button type="button" id="reset-btn" onclick="window.location.reload()">Reset</button>
        </div>

        <select id="filter-select" onchange="filterProducts()">
            <option value="all">All Categories</option>
            <option value="mobile">Mobile</option>
            <option value="computer">Computer</option>
            <option value="gadget">Gadgets</option>
        </select>

        <div id="products-box">
            <h2>Available Products</h2>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="product-card" data-type="<?= strtolower($row['type']); ?>">
                    
                    <img src="../assets/uploads/<?= $row['image']; ?>" alt="Product Image">

                    <b><?= $row['name']; ?></b><br>
                    <span class="product-price">Tk <?= $row['price']; ?></span><br><br>

                    <a href="guestProductDetails.php?id=<?= $row['id']; ?>">
                        <button>View Details</button>
                    </a>

                    <button onclick="loginAlert()">Add to Cart</button>

                </div>
            <?php } ?>
        </div>

    </div>

    <div id="side-panel">
        <a href="customerLogin.php" class="side-btn">Login 🔐</a>
        <a href="../index.php" class="side-btn">Back to Roles 🔙</a>
    </div>

</div>

<script>
    function loginAlert(){
    alert("Please login first to add items to cart!");
}
</script>
</body>
</html>
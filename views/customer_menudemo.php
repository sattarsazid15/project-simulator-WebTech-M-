<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customer_login.php");
    exit();
}

$result = getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../assets/css/customer_menu.css">
</head>
<body>

<div class="header">
    <h2>Welcome <?= isset($_SESSION['customer']['username']) ? $_SESSION['customer']['username'] : 'Customer'; ?></h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
</div>

<div class="main-container">

    <div class="content-area">

        <div class="offers-box">
            Offers will be added later
        </div>

        <select class="filter-btn" onchange="filterProducts(this.value)">
            <option value="all">All Products</option>
            <option value="mobile">Mobile</option>
            <option value="computer">Computer</option>
            <option value="gadget">Gadgets</option> </select>

        <div class="products-box">
            <h2>Products</h2>

            <?php 
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
                <div class="product-card" data-type="<?= strtolower($row['type']); ?>">
                    <img src="../assets/uploads/<?= $row['image']; ?>" alt="Product Image">

                    <b><?= $row['name']; ?></b><br>
                    Type: <?= $row['type']; ?><br>
                    Price: $<?= $row['price']; ?><br><br>

                    <a href="product_details.php?id=<?= $row['id']; ?>">
                        <button>View Details / Buy</button>
                    </a>

                    <button onclick="alert('Added to Cart!')">Add to Cart</button>
                </div>
            <?php 
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>

    </div>

    <div class="side-panel">
        <a href="customer_edit_profile.php" class="side-btn">Edit Profile 👤</a>
        
        <a href="product_browse.php" class="side-btn">Browse Product 🔎︎</a>
        
        <a href="repair_request.php" class="side-btn">Request Repair 🛠️</a>
        
        <a href="#" class="side-btn">Repair Status ⚙️</a>
        <a href="#" class="side-btn">View Cart 🛒</a>
        
        <a href="checkout.php" class="side-btn">Checkout 💳</a>
        
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

<script>
function filterProducts(type) {
    const products = document.querySelectorAll('.product-card');

    products.forEach(product => {
        if (type === 'all' || product.dataset.type === type) {
            product.style.display = 'inline-block';
        } else {
            product.style.display = 'none';
        }
    });
}
</script>

</body>
</html>
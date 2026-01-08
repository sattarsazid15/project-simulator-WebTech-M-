<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}


$user_id = $_SESSION['customer']['id'];
$wishlist_data = getUserWishlist($user_id);
$wishlist_ids = [];
while($w = mysqli_fetch_assoc($wishlist_data)){
    $wishlist_ids[] = $w['id']; 
}


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
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../assets/css/customerMenu.css">
    <script src="../assets/js/ajax.js"></script>
</head>
<body>

<div id="header">
    <h2>Welcome <?= isset($_SESSION['customer']['username']) ? $_SESSION['customer']['username'] : 'Customer'; ?></h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
</div>

<div id="main-container">

    <div id="content-area">

        <div id="search-section">
            <input type="text" id="search-input" onkeyup="searchProducts()" placeholder="Search by name or type..." 
                   value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            
            <button type="button" id="search-btn" onclick="searchProducts()">Search</button>
            <button type="button" id="reset-btn" onclick="window.location.href='customerDashboard.php'">Reset</button>
        </div>

        <select id="filter-select" onchange="filterProducts()">
            <option value="all">All Categories</option>
            <option value="mobile">Mobile</option>
            <option value="computer">Computer</option>
            <option value="gadget">Gadgets</option>
        </select>

        <div id="products-box">
            <h2>Available Products</h2>

            <?php 
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) { 
                    // Wishlist Logic
                    $is_wishlisted = in_array($row['id'], $wishlist_ids);
                    $heart_class = $is_wishlisted ? 'heart-active' : '';
                    $heart_symbol = $is_wishlisted ? '❤' : '♡';
            ?>
                <div class="product-card" data-type="<?= strtolower($row['type']); ?>">
                    
                    <button class="wishlist-btn <?= $heart_class; ?>" 
                            onclick="toggleWishlist(<?= $row['id']; ?>, this)">
                        <?= $heart_symbol; ?>
                    </button>

                    <img src="../assets/uploads/<?= $row['image']; ?>" alt="Product Image">

                    <b><?= $row['name']; ?></b><br>
                    <span class="product-price">Tk <?= $row['price']; ?></span><br><br>

                    <a href="productDetails.php?id=<?= $row['id']; ?>">
                        <button>View Details</button>
                    </a>

                    <form method="POST" action="../controllers/cartController.php" class="cart-form">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn-cart">Add to Cart</button>
                    </form>
                </div>
            <?php 
                }
            } else {
                echo "<p class='no-products'>No products found.</p>";
            }
            ?>
        </div>

    </div>

    <div id="side-panel">
        <a href="customerEditProfile.php" class="side-btn">Edit Profile 👤</a>
        <a href="wishlist.php" class="side-btn">My Wishlist ❤</a> 
        <a href="orderStatus.php" class="side-btn">Order Status 📦</a> 
        <a href="repairRequest.php" class="side-btn">Request Repair 🛠️</a>
        <a href="repairStatus.php" class="side-btn">Repair Status ⚙️</a> 
        <a href="checkout.php" class="side-btn">Checkout 💳</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
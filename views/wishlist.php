<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}

$user_id = $_SESSION['customer']['id'];
$result = getUserWishlist($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
    <link rel="stylesheet" href="../assets/css/customerMenu.css">
    <script src="../assets/js/ajax.js"></script>
</head>
<body>

<div id="header">
    <h2>Welcome <?= $_SESSION['customer']['username']; ?></h2>
    <h1>My Wishlist</h1>
</div>

<div id="main-container">

    <div id="content-area">
        <div id="products-box">
            <h2>Your Favorite Items</h2>

            <?php 
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
                <div class="product-card" id="card-<?= $row['id']; ?>">
                    
                    <button class="wishlist-btn heart-active" 
                            onclick="toggleWishlist(<?= $row['id']; ?>, this)">
                        &#10084;
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
                echo "<p class='no-products'>Your wishlist is empty.</p>";
            }
            ?>
        </div>
    </div>

    <div id="side-panel">
        <a href="customerDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="wishlist.php" class="side-btn" id="active-btn">My Wishlist ❤</a>
        <a href="orderStatus.php" class="side-btn">Order Status 📦</a> 
        <a href="repairRequest.php" class="side-btn">Request Repair 🛠️</a>
        <a href="checkout.php" class="side-btn">Checkout 💳</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
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
</head>
<body>

<div id="header">
    <h2>Welcome <?= isset($_SESSION['customer']['username']) ? $_SESSION['customer']['username'] : 'Customer'; ?></h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
</div>

<div id="main-container">

    <div id="content-area">

        <div id="search-section">
            <form method="GET" action="customerDashboard.php" id="search-form">
                <input type="text" name="search" placeholder="Search by name or type..." 
                       value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                       id="search-input">
                <button type="submit" id="search-btn">Search</button>
                <?php if(isset($_GET['search'])) { ?>
                    <a href="customerDashboard.php"><button type="button" id="reset-btn">Reset</button></a>
                <?php } ?>
            </form>
        </div>

        <select id="filter-select" onchange="filterProducts(this.value)">
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
            ?>
                <div class="product-card" data-type="<?= strtolower($row['type']); ?>">
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
        <a href="orderStatus.php" class="side-btn">Order Status 📦</a> <a href="repairRequest.php" class="side-btn">Request Repair 🛠️</a>
        <a href="repairStatus.php" class="side-btn">Repair Status ⚙️</a> 
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
<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customer_login.php");
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
    <link rel="stylesheet" href="../assets/css/customer_menu.css">
    </head>
<body>

<div class="header">
    <h2>Welcome <?= isset($_SESSION['customer']['username']) ? $_SESSION['customer']['username'] : 'Customer'; ?></h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
</div>

<div class="main-container">

    <div class="content-area">

        <div class="offers-box" style="text-align: left; background: #e9ecef; border: none;">
            <form method="GET" action="customer_menudemo.php" style="display: flex; gap: 10px;">
                <input type="text" name="search" placeholder="Search by name or type..." 
                       value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                       style="padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
                <button type="submit" style="padding: 10px 20px; background: #155f7d; color: white; border: none; cursor: pointer; border-radius: 5px;">Search</button>
                <?php if(isset($_GET['search'])) { ?>
                    <a href="customer_menudemo.php"><button type="button" style="padding: 10px 20px; background: #dc3545; color: white; border: none; cursor: pointer; border-radius: 5px;">Reset</button></a>
                <?php } ?>
            </form>
        </div>

        <select class="filter-btn" onchange="filterProducts(this.value)">
            <option value="all">All Categories</option>
            <option value="mobile">Mobile</option>
            <option value="computer">Computer</option>
            <option value="gadget">Gadgets</option>
        </select>

        <div class="products-box">
            <h2>Available Products</h2>

            <?php 
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
                <div class="product-card" data-type="<?= strtolower($row['type']); ?>">
                    <img src="../assets/uploads/<?= $row['image']; ?>" alt="Product Image">

                    <b><?= $row['name']; ?></b><br>
                    <span style="color: #666; font-size: 0.9em;"><?= $row['type']; ?></span><br>
                    <span style="color: #b12704; font-weight: bold;">Tk <?= $row['price']; ?></span><br><br>

                    <a href="product_details.php?id=<?= $row['id']; ?>">
                        <button>View Details / Buy</button>
                    </a>

                    <form method="POST" action="../controllers/cart_controller.php" style="margin-top:5px;">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button type="submit" style="width:100%; background:#28a745; color:white; border:none; padding:8px; cursor:pointer; border-radius:4px;">Add to Cart</button>
                    </form>
                </div>
            <?php 
                }
            } else {
                echo "<p style='text-align:center; padding:20px;'>No products found.</p>";
            }
            ?>
        </div>

    </div>

    <div class="side-panel">
        <a href="customer_edit_profile.php" class="side-btn">Edit Profile 👤</a>
        
        <a href="repair_request.php" class="side-btn">Request Repair 🛠️</a>
        <a href="#" class="side-btn">Repair Status ⚙️</a> <a href="checkout.php" class="side-btn">Checkout 💳</a>
        
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
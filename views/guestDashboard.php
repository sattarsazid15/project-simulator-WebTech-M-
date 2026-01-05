<?php
require_once('../models/productModel.php');

$result = getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest</title>
    <link rel="stylesheet" href="../assets/css/customerMenu.css">
</head>
<body>

<div id="header">
    <h2>Welcome Guest</h2>
    <h1>Online Mobile Shop & Servicing Center</h1>
</div>

<div id="main-container">

    <div id="content-area">

        <div id="search-section">
            <form method="GET" action="guestDashboard.php" id="search-form">
                <input type="text" name="search" placeholder="Search by name or type..." 
                       value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                       id="search-input">
                <button type="submit" id="search-btn">Search</button>
                <?php if(isset($_GET['search'])) { ?>
                    <a href="guestDashboard.php"><button type="button" id="reset-btn">Reset</button></a>
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

function loginAlert(){
    alert("Please login first to add items to cart!");
}
</script>

</body>
</html>

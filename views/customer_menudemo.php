<?php
session_start();

if(!isset($_SESSION['customer'])){
    header("Location: customer_login.php");
    exit();
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
    <h2>Welcome <?= $_SESSION['customer']['username']; ?></h2>
    <h1>To our Online Mobile Shop and Servicing Center</h1>
</div>

<div class="main-container">

    <div class="content-area">

        <div class="offers-box">
            Will add offers here later
        </div>

        <button class="filter-btn">Filter product</button>

        <div class="products-box">
            <h2>Products</h2>
            <p>
                (will add from database later after finishing adding product)
            </p>
        </div>

    </div>

    <div class="side-panel">
        <a href="customer_edit_profile.php" class="side-btn">Edit Profile 👤</a>
        <a href="#" class="side-btn">Browse Product 🔎︎</a>
        <a href="#" class="side-btn">Go for repair 🛠️</a>
        <a href="#" class="side-btn">Repair Status ⚙️</a>
        <a href="#" class="side-btn">View Cart 🛒</a>
        <a href="checkout.php" class="side-btn">Checkout 💳</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜]</a>
    </div>

</div>

</body>
</html>


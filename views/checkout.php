<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customer_login.php");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/technician_dashboard.css">
    <link rel="stylesheet" href="../assets/css/style1.css">
    <style>
        .checkout-container {
            width: 80%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .qty-input {
            width: 50px;
            padding: 5px;
            text-align: center;
        }
        .total-row {
            font-size: 1.2em;
            font-weight: bold;
            background-color: #eee;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Checkout</h2>
    <h1>Review Your Order</h1>
</div>

<div class="main-container" style="display:block;">
    <div class="checkout-container">
        <a href="customer_menudemo.php" class="btn">Back to Shopping</a>
        <br><br>

        <?php if(empty($cart)) { ?>
            <center>
                <h3>Your cart is empty.</h3>
                <br>
                <a href="customer_menudemo.php" class="btn" style="background:#28a745;">Browse Products</a>
            </center>
        <?php } else { ?>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity (Max 5)</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($cart as $id => $qty) {
                        $product = getProductById($id);
                        if(!$product) continue;
                        
                        $subtotal = $product['price'] * $qty;
                        $total_price += $subtotal;
                    ?>
                    <tr>
                        <td>
                            <img src="../assets/uploads/<?= $product['image']; ?>" width="50" style="vertical-align:middle;">
                            <?= $product['name']; ?>
                        </td>
                        <td>Tk <?= $product['price']; ?></td>
                        <td>
                            <form method="POST" action="../controllers/cart_controller.php" style="display:inline;">
                                <input type="hidden" name="update_qty" value="true">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                <input type="number" name="qty" value="<?= $qty; ?>" min="1" max="5" class="qty-input" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>Tk <?= $subtotal; ?></td>
                        <td>
                            <a href="../controllers/cart_controller.php?remove=<?= $id; ?>" style="color:red; font-weight:bold;">Remove</a>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <tr class="total-row">
                        <td colspan="3" style="text-align:right;">Grand Total:</td>
                        <td colspan="2">Tk <?= $total_price; ?></td>
                    </tr>
                </tbody>
            </table>

            <br>
            <div style="text-align: right;">
                <form action="../controllers/order_controller.php" method="POST">
                    <input type="hidden" name="total_amount" value="<?= $total_price; ?>">
                    <button type="button" class="btn" style="background:#28a745; font-size:1.2em;" onclick="alert('Payment Gateway Integration Coming Soon!')">Proceed to Payment</button>
                </form>
            </div>

        <?php } ?>
    </div>
</div>

</body>
</html>
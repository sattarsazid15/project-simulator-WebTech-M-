<?php
session_start();
require_once('../models/productModel.php');

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <script src="../assets/js/validation.js"></script>
    <script src="../assets/js/ajax.js"></script> </head>
<body>

<div id="header">
    <h2>Checkout</h2>
    <h1>Review Your Order</h1>
</div>

<div id="checkout-wrapper">
    <div id="checkout-box">
        
        <?php if(empty($cart)) { ?>
            <div id="empty-cart">
                <h3>Your cart is empty.</h3>
                <a href="customerDashboard.php" class="btn btn-shop">Browse Products</a>
            </div>
        <?php } else { ?>

            <div id="checkout-header">
                <h3>Shopping Cart</h3>
                <a href="customerDashboard.php" class="btn btn-back">&larr; Continue Shopping</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th class="col-product">Product</th>
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
                    <tr id="cart-row-<?= $id; ?>">
                        <td>
                            <div class="product-info">
                                <img src="../assets/uploads/<?= $product['image']; ?>" alt="img">
                                <div>
                                    <strong><?= $product['name']; ?></strong><br>
                                    <small style="color:#666;"><?= $product['type']; ?></small>
                                </div>
                            </div>
                        </td>
                        <td>Tk <?= $product['price']; ?></td>
                        <td>
                            <input type="number" 
                                   value="<?= $qty; ?>" 
                                   min="1" max="5" 
                                   class="qty-input" 
                                   onchange="updateCartQty(<?= $id; ?>, this)">
                        </td>
                        <td id="subtotal-<?= $id; ?>">Tk <?= $subtotal; ?></td>
                        <td>
                            <button class="remove-link" 
                                    onclick="removeCartItem(<?= $id; ?>)" 
                                    style="background:none; border:none; color:red; cursor:pointer; text-decoration:underline;">
                                Remove
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <tr id="total-row">
                        <td colspan="3" class="text-right">Grand Total:</td>
                        <td colspan="2" id="grand-total">Tk <?= $total_price; ?></td>
                    </tr>
                </tbody>
            </table>

            <br>
            <hr class="divider">
            <br>

            <h3>Shipping & Payment Details</h3>
            
            <form method="POST" action="../controllers/checkoutCheck.php" id="checkout-form" onsubmit="return validateCheckout()">
                <input type="hidden" name="total_amount" id="input-total-amount" value="<?= $total_price; ?>">
                
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="fullname" value="<?= $_SESSION['customer']['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Contact No:</label>
                    <input type="text" name="contact" id="contact" required placeholder="e.g. 017XXXXXXXX">
                </div>

                <div class="form-group">
                    <label>Address:</label>
                    <textarea name="address" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label>Payment Method:</label>
                    <select name="payment_method" required>
                        <option value="">Select Method</option>
                        <option value="COD">Cash on Delivery</option>
                        <option value="Online" disabled>Online Payment (Coming Soon)</option>
                    </select>
                </div>

                <div id="form-actions">
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-payment">
                </div>
            </form>

        <?php } ?>
    </div>
</div>

</body>
</html>
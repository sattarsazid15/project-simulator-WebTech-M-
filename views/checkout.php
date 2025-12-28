<?php
    session_start();

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [
            ['name' => 'iPhone 13', 'price' => 80000, 'qty' => 1],
            ['name' => 'Back Cover', 'price' => 500, 'qty' => 2]
        ];
    }

    $totalAmount = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $totalAmount += $item['price'] * $item['qty'];
        }
    }
?>

<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <center>
        <h1>Checkout</h1>
        <a href="home.php">Back to Home</a> | 
        <a href="../controllers/logout.php">Logout</a>
        <br><br>

        <fieldset style="width: 50%;">
            <legend><b>Order Summary</b></legend>
            <table border="1" width="100%">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php 
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $item){ 
                ?>
                <tr>
                    <td align="center"><?php echo $item['name']; ?></td>
                    <td align="center"><?php echo $item['price']; ?></td>
                    <td align="center"><?php echo $item['qty']; ?></td>
                    <td align="center"><?php echo $item['price'] * $item['qty']; ?></td>
                </tr>
                <?php 
                        }
                    } 
                ?>
                <tr>
                    <td colspan="3" align="right"><b>Grand Total:</b></td>
                    <td align="center"><b><?php echo $totalAmount; ?></b></td>
                </tr>
            </table>
        </fieldset>
        
        <br>

        <fieldset style="width: 50%;">
            <legend><b>Shipping & Payment Details</b></legend>
            <form method="POST" action="../controllers/checkoutCheck.php">
                <table width="100%">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="fullname" value=""></td>
                    </tr>
                    <tr>
                        <td>Contact No:</td>
                        <td><input type="text" name="contact" value=""></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><textarea name="address"></textarea></td>
                    </tr>
                    <tr>
                        <td>Payment Method:</td>
                        <td>
                            <select name="payment_method">
                                <option value="">Select Method</option>
                                <option value="COD">Cash on Delivery</option>
                                <option value="Online">Online Payment</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <input type="submit" name="submit" value="Confirm Order">
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </center>
</body>
</html>
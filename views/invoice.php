<?php 
    session_start();

    if(!isset($_SESSION['current_order'])){
        header('location: home.php');
        exit();
    }

    $order = $_SESSION['current_order'];
    $items = $order['items'];
?>

<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <center>
        <h1>Order Invoice</h1>
        <hr width="50%">
        
        <div style="border: 1px solid black; width: 60%; padding: 20px; text-align: left;">
            <table width="100%">
                <tr>
                    <td>
                        <b>Order ID:</b> #<?php echo $order['order_id']; ?> <br>
                        <b>Date:</b> <?php echo $order['date']; ?> <br>
                        <b>Payment Method:</b> <?php echo $order['payment_method']; ?>
                    </td>
                    <td align="right">
                        <b>Customer:</b> <?php echo $order['customer_name']; ?> <br>
                        <b>Phone:</b> <?php echo $order['contact']; ?> <br>
                        <b>Address:</b> <?php echo $order['address']; ?>
                    </td>
                </tr>
            </table>

            <br>
            
            <h3>Items Purchased:</h3>
            <table border="1" width="100%" cellspacing="0" cellpadding="5">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <?php foreach($items as $item){ ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td align="center"><?php echo $item['price']; ?></td>
                    <td align="center"><?php echo $item['qty']; ?></td>
                    <td align="center"><?php echo $item['price'] * $item['qty']; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right"><b>Grand Total:</b></td>
                    <td align="center"><b><?php echo $order['total_amount']; ?></b></td>
                </tr>
            </table>

            <br><br>
            <center>
                <button onclick="window.print()">Print Invoice</button> 
                <a href="home.php"><button>Go Home</button></a>
            </center>
        </div>
    </center>
</body>
</html>
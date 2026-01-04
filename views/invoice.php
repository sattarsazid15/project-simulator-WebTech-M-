<?php 
session_start();

if(!isset($_SESSION['current_order'])){
    header('location: customerDashboard.php');
    exit();
}

$order = $_SESSION['current_order'];
$items = $order['items'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?= $order['order_id']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    
    <div id="invoice-container">
        
        <h1 id="invoice-title">Order Invoice</h1>
        <hr id="invoice-divider">
        
        <table id="invoice-details-table">
            <tr>
                <td class="valign-top">
                    <b>Order ID:</b> #<?= $order['order_id']; ?> <br>
                    <b>Date:</b> <?= $order['date']; ?> <br>
                    <b>Payment:</b> <?= $order['payment_method']; ?>
                </td>
                <td class="text-right valign-top">
                    <b>Customer:</b> <?= $order['customer_name']; ?> <br>
                    <b>Phone:</b> <?= $order['contact']; ?> <br>
                    <b>Address:</b> <?= $order['address']; ?>
                </td>
            </tr>
        </table>

        <table id="invoice-items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item){ ?>
                <tr>
                    <td><?= $item['name']; ?></td>
                    <td class="text-center">Tk <?= $item['price']; ?></td>
                    <td class="text-center"><?= $item['qty']; ?></td>
                    <td class="text-center">Tk <?= $item['price'] * $item['qty']; ?></td>
                </tr>
                <?php } ?>
                
                <tr id="invoice-total-row">
                    <td colspan="3" class="text-right"><b>Grand Total:</b></td>
                    <td class="text-center total-highlight"><b>Tk <?= $order['total_amount']; ?></b></td>
                </tr>
            </tbody>
        </table>

        <div id="invoice-actions">
            <button onclick="window.print()" id="print-btn">Print Invoice</button> 
            <a href="customerDashboard.php"><button id="dashboard-btn">Back to Dashboard</button></a>
        </div>

    </div>

</body>
</html>
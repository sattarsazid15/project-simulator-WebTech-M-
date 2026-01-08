<?php
session_start();

if(!isset($_SESSION['customer'])){
    header("Location: customerLogin.php");
    exit;
}

if(!isset($_GET['order_id'])){
    header("Location: orderStatus.php");
    exit;
}

$orderId = $_GET['order_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Feedback</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="form-container">
    <h2>Order Feedback</h2>

    <form method="post" action="../controllers/orderFeedbackController.php">
        <input type="hidden" name="order_id" value="<?= $orderId ?>">

        <div class="form-group">
            <label>Order ID</label>
            <input type="text" value="#<?= $orderId ?>" readonly>
        </div>

        <div class="form-group">
            <label>Give Feedback</label>
            <textarea name="feedback" rows="5" required></textarea>
        </div>

        <button type="submit">Submit Feedback</button>
    </form>

    <div class="form-footer">
        <a href="orderStatus.php">Back</a>
    </div>
</div>

</body>
</html>

<?php
session_start();
require_once('../models/orderModel.php');

if(!isset($_SESSION['admin']) && !isset($_COOKIE['admin_status'])){
    header("Location: adminLogin.php");
    exit;
}

if(isset($_POST['update_status'])){
    $id = $_POST['order_id'];
    $status = $_POST['status'];
    if(updateOrderStatus($id, $status)){
        echo "<script>alert('Status updated successfully to $status!');</script>";
    } else {
        echo "<script>alert('Failed to update status.');</script>";
    }
}

$result = getAllOrders();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../assets/css/adminOrders.css">
</head>
<body>

<div class="header">
    <h2>Admin Panel</h2>
    <h1>Order Management</h1>
</div>

<div class="main-container">

    <div class="content-area">
        <div class="table-box">
            <h3>Customer Orders List</h3>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Total (Tk)</th>
                        <th>Update Status</th>
                        <th>Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>#<?= $row['id']; ?></td>
                            <td>
                                <b><?= $row['customer_name']; ?></b><br>
                                <span style="font-size:0.9em; color:#666;"><?= $row['address']; ?></span>
                            </td>
                            <td><?= $row['contact']; ?></td>
                            <td><?= $row['total_amount']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                                    <select name="status">
                                        <option value="Pending" <?= ($row['status']=='Pending')?'selected':''; ?>>Pending</option>
                                        <option value="Processing" <?= ($row['status']=='Processing')?'selected':''; ?>>Processing</option>
                                        <option value="Delivered" <?= ($row['status']=='Delivered')?'selected':''; ?>>Delivered</option>
                                        <option value="Cancelled" <?= ($row['status']=='Cancelled')?'selected':''; ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn-update">Update</button>
                                </form>
                            </td>
                            <td class="status-<?= $row['status']; ?>"><?= $row['status']; ?></td>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6" style="text-align:center;">No orders found.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="side-panel">
        <a href="adminDashboard.php" class="side-btn">Dashboard 🏠</a>
        <a href="products.php" class="side-btn">Manage Products 📦</a>
        <a href="technicianRequest.php" class="side-btn">Technician Request 🛠️</a>
        <a href="../controllers/logout.php" class="side-btn logout">Logout ➜</a>
    </div>

</div>

</body>
</html>
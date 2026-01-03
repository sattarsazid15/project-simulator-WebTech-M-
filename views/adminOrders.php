<?php
session_start();
require_once('../models/orderModel.php');

if(isset($_POST['update_status'])){
    $id = $_POST['order_id'];
    $status = $_POST['status'];
    updateOrderStatus($id, $status);
    echo "Status updated to $status!";
}

$result = getAllOrders();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Order Management</title>
</head>
<body>
<center>
    <h2>Order Management</h2>
    <a href="adminDashboard.php">Back to Dashboard</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Processing" <?php if($row['status']=='Processing') echo 'selected'; ?>>Processing</option>
                        <option value="Delivered" <?php if($row['status']=='Delivered') echo 'selected'; ?>>Delivered</option>
                        <option value="Cancelled" <?php if($row['status']=='Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                    <input type="submit" name="update_status" value="Update">
                </form>
            </td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php } ?>
    </table>
</center>
</body>
</html>
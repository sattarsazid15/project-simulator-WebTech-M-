<?php
session_start();

if(!isset($_SESSION['customer']) && !isset($_COOKIE['status'])){
    header("Location: customerLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Repair Service</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>

<div class="form-container">
    <h2>Request Device Repair</h2>
    
    <form method="POST" action="../controllers/repairController.php">
        
        <div class="form-group">
            <label>Device Name / Model</label>
            <input type="text" name="device_name" placeholder="e.g. iPhone 13 Pro" required>
        </div>

        <div class="form-group">
            <label>Describe the Issue</label>
            <textarea name="issue_description" rows="5" style="width:100%; padding:10px;" placeholder="e.g. Screen cracked, battery not charging..." required></textarea>
        </div>

        <br>
        <button type="submit" name="submit">Submit Request</button>
    </form>

    <div class="form-footer">
        <a href="customerDashboard.php">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
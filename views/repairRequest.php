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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/productForm.css">
</head>
<body>

<div class="form-container" id="repair-container">
    <h2>Request Device Repair</h2>
    
    <form method="POST" action="../controllers/repairController.php" id="repair-form">
        
        <div class="form-group">
            <label for="device-name">Device Name / Model</label>
            <input type="text" name="device_name" id="device-name" placeholder="e.g. iPhone 13 Pro" required>
        </div>

        <div class="form-group">
            <label for="issue-desc">Describe the Issue</label>
            <textarea name="issue_description" id="issue-desc" rows="5" placeholder="e.g. Screen cracked, battery not charging..." required></textarea>
        </div>

        <button type="submit" name="submit" id="submit-btn">Submit Request</button>
    </form>

    <div class="form-footer">
        <a href="customerDashboard.php" id="dashboard-link">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
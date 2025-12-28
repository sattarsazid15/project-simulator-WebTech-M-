<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2>Customer Sign Up</h2>

<form method="post" action="../controllers/customer_auth.php">
    <input type="hidden" name="action" value="signup">

    Name:
    <input type="text" name="name" required><br><br>

    Email:
    <input type="email" name="email" required><br><br>

    Password:
    <input type="password" name="password" required><br><br>

    <button type="submit">Sign Up</button>
</form>

</body>
</html>
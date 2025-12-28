<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2>Customer Login</h2>

<form method="post" action="../controllers/customer_auth.php">
    <input type="hidden" name="action" value="login">

    Email:
    <input type="email" name="email" required><br><br>

    Password:
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>
    New user? <a href="customer_signup.php">Sign Up</a>
</p>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Admin Login</h2>

    <form method="post" action="../controllers/admin_auth.php" onsubmit="return validateAdminLogin();">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="admin_username">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="admin_password">
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Technician Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container">
    <h2>Technician Sign Up</h2>

    <form method="post" action="../controllers/technician_auth.php" onsubmit="return validateTechSignup();">

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="email">
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label>Specialization</label>
            <input type="text" name="specialist" id="specialist">
        </div>

        <div class="form-group">
            <label>Experience (years)</label>
            <input type="text" name="experience" id="experience">
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" id="dob">
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender">
                <option value="">Select</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label>Shop Details</label>
            <input type="text" name="shop" id="shop">
        </div>

        <button type="submit">Submit</button>
    </form>

    <div class="form-footer">
        Already registered? <a href="technician_login.php">Login</a>
    </div>
</div>

</body>
</html>

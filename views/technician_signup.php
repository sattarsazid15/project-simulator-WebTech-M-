<!DOCTYPE html>
<html>
<body>

<h2>Technician Sign Up</h2>

<form method="post" action="../controllers/technician_auth.php">
    Email: <input type="text" name="email"><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    Specialization: <input type="text" name="specialist"><br>
    Experience (years): <input type="text" name="experience"><br>
    DOB: <input type="date" name="dob"><br>
    Gender:
    <select name="gender">
        <option>Male</option>
        <option>Female</option>
    </select><br>
    Shop Details: <input type="text" name="shop"><br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>
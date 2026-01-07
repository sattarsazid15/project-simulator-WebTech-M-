<!DOCTYPE html>
<html>
<head>
    <title>Technician Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="tech-signup-container">
    <h2>Technician Sign Up</h2>

    <form method="post" action="../controllers/technicianAuth.php" onsubmit="return validateTechSignup();" id="tech-signup-form">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" onkeyup="checkTechEmail()">
            <span id="email-msg"></span>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" onkeyup="checkTechUsername()">
            <span id="username-msg"></span>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="specialist">Specialization</label>
            <input type="text" name="specialist" id="specialist">
        </div>

        <div class="form-group">
            <label for="experience">Experience (years)</label>
            <input type="text" name="experience" id="experience">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="shop">Shop Details</label>
            <input type="text" name="shop" id="shop">
        </div>

        <button type="submit" name="submit" id="signup-btn">Submit</button>
    </form>

    <div class="form-footer">
        Already registered? <a href="technicianLogin.php">Login</a>
    </div>
</div>

</body>
</html>

<script>
function checkTechEmail(){
    let email = document.getElementById("email").value;
    let msg = document.getElementById("email-msg");

    if(email === ""){
        msg.innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/ajaxCheckTechnician.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText.trim() === "email_exists"){
                msg.innerHTML = "<span style='color:red'>Email already exists</span>";
            } else {
                msg.innerHTML = "<span style='color:green'>Email available</span>";
            }
        }
    }
}

function checkTechUsername(){
    let username = document.getElementById("username").value;
    let msg = document.getElementById("username-msg");

    if(username === ""){
        msg.innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/ajaxCheckTechnician.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText.trim() === "username_exists"){
                msg.innerHTML = "<span style='color:red'>Username already exists</span>";
            } else {
                msg.innerHTML = "<span style='color:green'>Username available</span>";
            }
        }
    }
}
</script>

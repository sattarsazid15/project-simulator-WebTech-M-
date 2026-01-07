<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/validation.js"></script>
</head>
<body>

<div class="form-container" id="customer-signup-container">
    <h2>Customer Sign Up</h2>

    <form method="post" action="../controllers/customerAuth.php" onsubmit="return validateSignup();" id="customer-signup-form">

        <input type="hidden" name="action" value="signup">

        <div class="form-group">
            <label for="username">Name</label>
            <input type="text" name="username" id="username">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" onkeyup="checkEmail()">
            <span id="email-msg"></span>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit" id="signup-btn">Sign Up</button>
    </form>

    <div class="form-footer">
        Already have an account?
        <a href="customerLogin.php">Login</a>
    </div>
</div>

</body>
</html>

<script>
function checkEmail(){
    let email = document.getElementById("email").value;

    if(email === ""){
        document.getElementById("email-msg").innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/ajaxCheckEmail.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);

    xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        let res = this.responseText.trim();

        if(res === "exists"){
            document.getElementById("email-msg").innerHTML =
                "<span style='color:red'>Email already exists</span>";
        } else {
            document.getElementById("email-msg").innerHTML =
                "<span style='color:green'>Email available</span>";
        }
    }
}
}
</script>

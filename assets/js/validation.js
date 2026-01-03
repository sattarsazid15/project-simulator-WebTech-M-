function validateSignup() {
    var name = document.getElementById("username").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value;

    if (name === "" || email === "" || password === "") {
        alert("All fields are required (and cannot be empty spaces).");
        return false;
    }

    if (name.length < 2) {
        alert("Username must be at least 2 characters.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must have at least 6 characters!");
        return false;
    }

    var atPos = email.indexOf('@');
    var dotPos = email.lastIndexOf('.');

    if (atPos < 1 || dotPos < atPos + 2 || dotPos + 2 >= email.length) {
        alert("Invalid email format (e.g., user@example.com)");
        return false;
    }

    return true;
}

function validateLogin() {
    var email = document.getElementById("login_email").value;
    var password = document.getElementById("login_password").value;

    if (email === "" || password === "") {
        alert("Email and password required");
        return false;
    }

    return true;
}

function validateForgotPassword() {
    var email = document.getElementById("forgot_email").value;
    if (email === "") {
        alert("Email is required");
        return false;
    }
    return true;
}

function validateResetPassword() {
    var pass = document.getElementById("new_password").value;
    var confirm = document.getElementById("confirm_password").value;

    if (pass === "" || confirm === "") {
        alert("All fields are required");
        return false;
    }

    if (pass !== confirm) {
        alert("Passwords do not match");
        return false;
    }

    return true;
}

function validateTechLogin() {
    const username = document.getElementById("login_username").value;
    const password = document.getElementById("login_password").value;

    if (username === "" || password === "") {
        alert("All fields are required");
        return false;
    }
    return true;
}

function validateTechSignup() {
    var email = document.getElementById("email").value.trim();
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value;
    var specialist = document.getElementById("specialist").value.trim();
    var experience = document.getElementById("experience").value.trim();
    var dob = document.getElementById("dob").value;
    var shop = document.getElementById("shop").value.trim();
    var gender = document.getElementById("gender").value; 

    if (email === "" || username === "" || password === "" || specialist === "" || experience === "" || dob === "" || shop === "" || gender === "") {
        alert("All fields are required.");
        return false;
    }

    if (username.length < 2) {
        alert("Username must be at least 2 characters.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }

    if (isNaN(experience)) {
        alert("Experience must be a number.");
        return false;
    }

    var atPos = email.indexOf('@');
    var dotPos = email.lastIndexOf('.');

    if (atPos < 1 || dotPos < atPos + 2 || dotPos + 2 >= email.length) {
        alert("Invalid email format.");
        return false;
    }

    return true;
}

function validateProfile(){
    let username = document.querySelector("input[name='username']").value;
    let email = document.querySelector("input[name='email']").value;

    if(username === "" || email === ""){
        alert("All fields are required");
        return false;
    }
    return true;
}

function validatePassword(){
    let oldP = document.querySelector("input[name='old_password']").value;
    let newP = document.querySelector("input[name='new_password']").value;
    let conP = document.querySelector("input[name='confirm_password']").value;

    if(oldP === "" || newP === "" || conP === ""){
        alert("All password fields are required");
        return false;
    }

    if(newP !== conP){
        alert("New password and confirm password do not match");
        return false;
    }
    return true;
}

function validateTechProfile(){
    var email = document.querySelector("input[name='email']").value;
    if(email === ""){
        alert("Email cannot be empty");
        return false;
    }
    return true;
}

function validateTechPassword(){
    var oldp = document.querySelector("input[name='old_password']").value;
    var newp = document.querySelector("input[name='new_password']").value;
    var conf = document.querySelector("input[name='confirm_password']").value;

    if(oldp === "" || newp === "" || conf === ""){
        alert("All password fields are required");
        return false;
    }
    if(newp !== conf){
        alert("Passwords do not match");
        return false;
    }
    return true;
}
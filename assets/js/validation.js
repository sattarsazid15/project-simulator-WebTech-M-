function validateSignup() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (name === "" || email === "" || password === "") {
        alert("All fields are required");
        return false;
    }

    if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
        alert("Invalid email format");
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
    const fields = [
        "email", "username", "password",
        "specialist", "experience", "dob", "shop"
    ];

    for (let i = 0; i < fields.length; i++) {
        if (document.getElementById(fields[i]).value === "") {
            alert("Please fill all fields");
            return false;
        }
    }

    return true;
}



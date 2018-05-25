function validateForm() {
    try {
    return (validateUserName() &&
            validateFirstName() &&
            validateLastName() &&
            validateEmail() &&
            validatePasswords());
    } catch(err) {
        alert(err);
    }
}

function validateUserName() {
    var e = document.getElementById('uname');
    var v = e.value;
    if (v.length < 1) {
        alert("Username must be at least one character long!");
        return false;
    }
    var r = v.search(/^[-'\w\s]+$/);
    if (r != 0) {
        alert("Invalid username!");
        return false;
    }
    return true;
}

function validateFirstName() {
    var e = document.getElementById('fname');
    var v = e.value;
    if (v.length < 1) {
        alert("First name must be at least one character long!");
        return false;
    }
    var r = v.search(/^\w+$/);
    if (r != 0) {
        alert("Invalid first name!");
        return false;
    }
    return true;
}

function validateLastName() {
    var e = document.getElementById('lname');
    var v = e.value;
    if (v.length < 1) {
        alert("Last name must be at least one character long!");
        return false;
    }
    var r = v.search(/^\w+$/);
    if (r != 0) {
        alert("Invalid last name!");
        return false;
    }
    return true;
}

function validateEmail() {
    var e = document.getElementById('email');
    var v = e.value;
    var r = v.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/);
    if (r != 0) {
        alert("Invalid E-mail address!");
        return false;
    }
    return true;
}

function validatePasswords() {
    var e1 = document.getElementById('passw');
    var e2 = document.getElementById('confirm_passw');

    var v1 = e1.value;
    var v2 = e2.value;

    if (v1.length < 6) {
        alert("Password must be at least six characters long!");
        return false;
    }
    var re = /[0-9]/;
    if (!re.test(v1)) {
        alert("Password must contain at least one digit!");
        return false;
    }
    re = /[A-Z]/;
    if (!re.test(v1)) {
        alert("Password must contain at least one uppercase letter!");
        return false;
    }
    re = /[a-z]/;
    if (!re.test(v1)) {
        alert("Password must contain at least one lowercase letter!");
        return false;
    }
    if (v1 != v2) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}

function isBlank(inputField) {
    if (inputField.type == "checkbox") {
        if (inputField.checked)
            return false;
        return true;
    }
    if (inputField.value == "") {
        return true;
    }
    return false;
}

function makeRed(div) {
    div.style.backgroundColor = "#AA0000";
    //div.parentNode.style.backgroundColor = "#AA0000";
    div.parentNode.style.color = "#FFFFFF";
}

function makeClean(div) {
    div.parentNode.style.backgroundColor = "#FFFFFF";
    div.parentNode.style.color = "#000000";
}

window.onload = function() {
    var myForm = document.getElementById("signup");

    var requiredInputs = document.querySelectorAll(".required");
    for (var i = 0; i < requiredInputs.length; i++) {
        requiredInputs[i].onfocus = function() {
            this.style.backgroundColor = "#EEEE00";
        }
    }

    myForm.onsubmit = function(e) {
        var requiredInputs = document.querySelectorAll(".required");
        for (var i=0; i < requiredInputs.length; i++) {
            if (isBlank(requiredInputs[i])) {
                e.preventDefault();
                makeRed(requiredInputs[i]);
            }
            else {
                makeClean(requiredInputs[i]);
            }
        }
        if (!validateForm()) {
            e.preventDefault();
        }
    }
}


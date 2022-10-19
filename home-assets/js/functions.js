// Function for SIGN UP HYPERLINK
function btn_switchSignUp() {
    document.getElementById("login_form").hidden = true;
    document.getElementById("signup_form").hidden = false;
}

// Function for LOGIN HYPERLINK
function btn_switchLogin() {
    document.getElementById("login_form").hidden = false;
    document.getElementById("signup_form").hidden = true;
}
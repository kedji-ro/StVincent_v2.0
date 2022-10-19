
// Event listener for pressing ENTER when cursor is in Email or Password Field
$(document).keyup(function (event) {
    if ($("#email").is(":focus") && event.key == "Enter") {
        btn_login();   // If cursor is in Email field then ENTER is pressed, will activate LOGIN BUTTON FUNCTION
    }
    if ($("#password").is(":focus") && event.key == "Enter") {
        btn_login();  // If cursor is in Password field then ENTER is pressed, will activate LOGIN BUTTON FUNCTION
    }
});

/************************* Button click functions START *************************/
// Function for LOGIN BUTTON
function btn_login() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    
    execute_login(email, pass);  
}

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

// Function for CREATE ACCOUNT BUTTON
function btn_SignUp() { 
    var fullname = document.getElementById("signup_fullname").value;
    var email = document.getElementById("signup_email").value; 
    var mobile = document.getElementById("signup_mobile").value;
    var address = document.getElementById("signup_address").value; 
    var username = document.getElementById("signup_username").value;
    var password = document.getElementById("signup_password").value; 
    var password2 = document.getElementById("signup_repassword").value; 

    var UserSignUp = (function () {
        function UserSignUp() {
            this.fullname = fullname;
            this.email = email;
            this.mobile = mobile;
            this.address = address;
            this.username = username;
            this.password = password; 
        }
        return UserSignUp;
    }());
    
    var input_UserSignUp= new UserSignUp();

    if (fullname.length > 0 && email.length > 0 && username.length > 0 && password.length > 0 && password2.length > 0){
        if (password == password2){
            execute_signup(input_UserSignUp); 
        } 
        else{
            document.getElementById("signup_text_response").hidden = false; 
            document.getElementById("signup_text_response").style.color = "#ff0000"; // Red
            document.getElementById("signup_text_response").innerText ='Password Does Not Match!';
        }
    } 
    else{
        document.getElementById("signup_text_response").hidden = false; 
        document.getElementById("signup_text_response").style.color = "#ff0000"; // Red
        document.getElementById("signup_text_response").innerText ='Insert Data on Required Fields!';
    } 
}

/************************* Button click functions END *************************/


/************************* JavaScript functions START *************************/
// Function for passing data and validating LOGIN FORM
function execute_login(email, pass) {
    fetch('includes/execute.php', {
        method: 'POST',
        headers: {
            'Content-Type':'application/x-www-form-urlencoded'
        },
        body: 'data=user_login'
        + '&email=' + email  
        + '&pass=' + pass 
    }).then(function (response) {
        return response.json();
    }).then(function (data) { 
        if (data.status == 1){   
            document.getElementById("email").value = '';
            document.getElementById("password").value = '';
            window.location.href = 'dashboard.php?activitylists';
        }
        else{
            document.getElementById("text_error").hidden = false; 
            document.getElementById("password").value = '';
            document.getElementById("text_error").innerText ='Wrong Username/Email or Password!';
        }
    })["catch"](function (error) {
        console.log(error);  
        document.getElementById("text_error").hidden = false;  
        document.getElementById("text_error").innerText ='Error! Cannot connect to server.';
    });  
}

// Function for passing data and validating CREATE ACCOUNT/SIGN UP FORM
function execute_signup(input) { 
    document.getElementById("signup_text_response").hidden = false;
    document.getElementById("btn_signup").disabled = true;
    fetch('includes/sign-up.php', {
        method: 'POST',
        headers: {
            'Content-Type':'application/x-www-form-urlencoded'
        },
        body: 'data=user_signup'
        + '&fullname=' + input.fullname  
        + '&email=' + input.email 
        + '&mobile=' + input.mobile  
        + '&address=' + input.address 
        + '&username=' + input.username  
        + '&password=' + input.password 
    }).then(function (response) {
        console.log(response);  
        return response.json();
    }).then(function (data) { 
        console.log(data); 
        if (data.status == 1){ 
            document.getElementById("signup_fullname").value = '';
            document.getElementById("signup_email").value = ''; 
            document.getElementById("signup_mobile").value = '';
            document.getElementById("signup_address").value = ''; 
            document.getElementById("signup_username").value = '';
            document.getElementById("signup_password").value = ''; 
            document.getElementById("signup_repassword").value = '';  
            document.getElementById("signup_text_response").style.color = "#00ff14"; // Green
            document.getElementById("signup_text_response").innerText ='Success! Please check your email to verify your account.';  
        } else if (data.status == 2) {
            document.getElementById("signup_email").value = ''; 
            document.getElementById("signup_username").value = '';
            document.getElementById("signup_password").value = ''; 
            document.getElementById("signup_repassword").value = '';  
            document.getElementById("signup_text_response").style.color = "#ff0000"; // Red
            document.getElementById("signup_text_response").innerText ='Email or username already exists. Please proceed to login.';  
        } else { 
            document.getElementById("signup_text_response").style.color = "#ff0000";
            document.getElementById("signup_text_response").innerText ='Error! Cannot connect to Database.';
        }
    })["catch"](function (error) {
        console.log(error);   
        document.getElementById("signup_text_response").style.color = "#ff0000";
        document.getElementById("signup_text_response").innerText ='Internal Error! Cannot connect to server.';
    });

    document.getElementById("btn_signup").disabled = false;
}
/************************* JavaScript functions END *************************/
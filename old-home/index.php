<!DOCTYPE html>
<html lang="en">

<head>
    <title>St. Vincent Strambi C.P of Home for the Aged</title>

    <link rel="stylesheet" href="old-folders/assets/css/mainpage.css">
    <link rel="stylesheet" href="old-folders/assets/css/custom.css">
</head>

<body class="main">
    <div>
        <!-- Navigation bar start -->
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">St. Vincent Strambi</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li style="width: 80px;"><a href="about.html">ABOUT US</a></li>
                    <li><a href="about.html#services">SERVICES</a></li>
                    <li><a href="about.html#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>
        <!-- Navigation bar end -->

        <div class="content">
            <div>
                <h1>St. Vincent <br><span>Strambi C.P</span> <br>of Home for the Aged</h1>
                <p class="par">WE CARE, WE VALUE.</p>
                <button class="btnn" onclick="location.href='donate.html';" style="margin-left: 20px;">Donate</button>
            </div>

            <!-- Login Form Start -->
            <div id="login_form" class="form login row">
                <form action="includes/actions.php?data=login" method="post">
                    <h2>Login Here</h2>
                    <?php include('includes/alert-message.php'); ?>
                    <input type="text" id="email" name="user" placeholder="Username/ Email">
                    <input type="password" id="password" name="pass" placeholder="Password">
                    <div style="margin-top: 10px;"></div>
                    <button type="submit" class="btnn" value="submit"><a href="javascript:void(0);">Login</a></button>
    
                    <p class="link">Don't have an account<br>
                        <a onclick="btn_switchSignUp()" href="javascript:void(0);">Sign up </a> here</a>
                    </p>
                </form>  
            </div>
            <!-- Login Form End -->

            <!-- Sign Up Form Start -->
            <div id="signup_form" class="form logout container row" hidden>
                <form action="includes/actions.php?data=signup" method="post">
                    <div class="div-center">
                        <h2 style="width: 495px;">Sign Up Here</h2>
                    </div>
                    <div class="div-center">
                        <!-- <p id="signup_text_response" class="text-danger italic" hidden></p> -->
                        <?php include('includes/alert-message.php'); ?>
                    </div>
                    <div class="form-logout-div">
                        <input name="sName" class="mr-15" type="text" id="signup_fullname" placeholder="Full Name" style="width: 495px;">
                    </div>
                    <div class="form-logout-div">
                        <input name="sEmail" class="mr-15" type="email" id="signup_email" placeholder="Email">
                        <input name="sMobile" type="text" id="signup_mobile" placeholder="Mobile (Optional)">
                    </div>
                    <div class="form-logout-div">
                        <input name="sAddress" type="text" id="signup_address" placeholder="Address (Optional)" style="width: 495px;">
                    </div> <br>
                    <div class="form-logout-div">
                        <input name="sUser" type="text" id="signup_username" placeholder="Username" style="width: 495px;">
                    </div><br>
                    <div class="form-logout-div">
                        <input name="sPass"class="mr-15" type="password" id="signup_password" placeholder="Password">
                        <input name="sRePass" type="password" id="signup_repassword" placeholder="Re-type Password">
                    </div>
                    <div class="div-center">
                        <button type="submit" id="btn_signup" class="btnn" value="submit"><a>Create Account</a></button>
                    </div>
                    <p class="link">If you already have an account<br>
                        <a onclick="btn_switchLogin()" href="javascript:void(0);">Login </a> here</a>
                    </p>
                </form>      
            </div>
        </div>
        <!-- Sign Up Form End -->
    </div>
    </div>
    </div>
    </div>

    <!-- JavaScript references -->
    <script src="assets/js/jquery.js"></script>
    <script src="includes/actions.js"></script>

</body>
</html>
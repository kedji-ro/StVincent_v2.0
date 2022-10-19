<?php 
include_once '../includes/config.php';  
$token = isset($_GET['token'])? mysqli_real_escape_string($conn, $_GET['token']): null;

$query_getToken = "SELECT * FROM `tb_useracct` WHERE `_tokenactivation`='".$token."' AND `_active`='0'"; 
$result = $conn->query($query_getToken); 
$row_cnt = $result->num_rows;  

$today = date("Y-m-d H:i:s");  

if ($row_cnt > 0){
    $query_updateAcct = "UPDATE `tb_useracct` SET `_active`='1', `_email_verified_date`='".$today."' WHERE `_tokenactivation`='".$token."' AND `_active`='0'"; 
    $conn->query($query_updateAcct); 
}
$conn->close();  
?>

<!doctype html>
<html lang="en"> 
    <head>
        <meta charset="utf-8">
        <title><?php echo ($row_cnt > 0)? "Account Activation Link": "404 Page Not Found"; ?> | St. Vincent Strambi C.P of Home for the Aged</title> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="St. Vincent Strambi C.P of Home for the Aged">
        <!-- <link rel="shortcut icon" href="../assets/images/favicon.ico" /> -->
        <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
        <!-- Font Awesome -->  
        <link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome-4.7.0/css/font-awesome.min.css" >
        <!-- Pagination -->   
        <link rel="stylesheet" type="text/css" href="../assets/css/jquery.bdt.css" >
        <link rel="stylesheet" type="text/css" href="../assets/css/jquery.gritter.min.css"> 
        <link rel="stylesheet" type="text/css" href="../assets/css/custom.css"> 

        <style>
            body {
                background-color: #f1f1f1;
            }

            .vertical-center {
                min-height: 100%;
                min-height: 100vh;

                display: flex;
                align-items: center;
            }
        </style>
    </head> 

    <body>

        <div class="vertical-center">
            <div class="container">
                <?php if ($row_cnt > 0): ?>
                    <div id="congrats" class="text-center"> 
                        <h1 style="font-weight: bold;font-size: 75px;color: #12a32a; margin-bottom: 10px;">Congratulations!</h1>
                        <p>Your account successfully activated.</p>
                        You can now <a href="../" style="color: #2e24c3;">Sign In here.</a>
                    </div>
                </div>
                <?php else: ?>
                    <div id="notfound" class="text-center">
                        <h1>😮</h1>
                        <h2>Oops! Page Not Be Found</h2>
                        <p>Sorry but the page you are looking for does not exist.</p>
                        <a href="../" style="color: #2e24c3;">Back to homepage</a>
                    </div>
                <?php endif; ?> 
            </div>
        </div>

        <footer class="footer" style="text-align: center;">
            <p class="copyright">&copy; 2022 | St. Vincent Strambi C.P of Home for the Aged. All rights reserved.
            </p>
        </footer>  
        <a href="#" class="overlayer"></a> 

        <script type="text/javascript" src="../assets/js/jquery.js"></script> 
        <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="../assets/js/css3-animate-it.js"></script>
        <!-- Popper -->
        <script type="text/javascript" src="../assets/js/jquery.gritter.min.js"></script> 
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <script type="text/javascript" src="../assets/js/buttons.js"></script>
        <!-- Pagination --> 
        <script type="text/javascript" src="../assets/js/jquery.sortelements.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.bdt.min.js"></script> 
        <script type="text/javascript" src="../assets/js/custom.js"></script> 

    </body> 
</html> 
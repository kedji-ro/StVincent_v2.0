<?php
include '../includes/config.php';
include 'read-notif.php';

if ($_SESSION['st_role'] == 'admin') {
    header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?patient-info');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- <link rel="icon" type="image/png" href="assets/img/favicon.ico"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link href='fullcalendar/main.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrapFontAwesome',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 600,
                handleWindowResize: true,


                events: [{

                }]
            });
            calendar.render();

        });
    </script>

    <title>User Dashboard | St. Vincent Strambi C.P of Home for the Aged</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />


    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!--     FullCalendar     -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.11.3/main.css,npm/fullcalendar@5.11.3/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

    <!-- CSS Files -->
    <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" /> -->
</head>

<body id="inBody" onload="toast.showNotification('pe-7s-info','<?php echo $_SESSION['message']; ?>','<?php echo $_SESSION['message_type']; ?>');">
    <?php unset($_SESSION['message']); ?>

    <div class="wrapper">
        <div class="sidebar" data-color="black" data-image="assets/img/sidebar-5.jpg">

            <!-- 
            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag 
            -->

            <!-- Left Navigation Bar -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="" class="simple-text">
                        User Dashboard
                    </a>
                </div>
                <ul class="nav" id="leftNav">
                    <li id="navEvent" class="nav-item <?php if (isset($_GET['event-activity']) != null) {
                                                            echo 'active';
                                                        } ?>">
                        <a class="nav-link" href="?event-activity">
                            <i class="fa fa-calendar"></i>
                            <p>Event Activity</p>
                        </a>
                    </li>
                    <li id="navDonation" class="nav-item <?php if (isset($_GET['donation']) != null) {
                                                                echo 'active';
                                                            } ?>">
                        <a class="nav-link" href="?donation">
                            <i class="fa fa-money"></i>
                            <p>My Donations</p>
                        </a>
                    </li>
                    <li id="navSettings" class="nav-item <?php if (isset($_GET['settings']) != null) {
                                                                echo 'active';
                                                            } ?>">
                        <a class="nav-link" href="?settings">
                            <i class="fa fa-cogs"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Header Navigation Bar -->
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navB" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <!-- Input <li> here to show on left side of header navbar-->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown" id="notifBell">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i>
                                    <?php if ($_SESSION['st_notifs'] != 0) { ?>
                                        <span class="notification"> <?php echo $_SESSION['st_notifs']; ?> </span>
                                    <?php } ?>
                                </a>
                                <ul class="container dropdown-menu text-wrap" style="width: 300px; height: 400px;; overflow-y:scroll;">
                                    <?php include 'notifications.php'; ?>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        <i class="fa fa-user"></i>
                                        <?php
                                        if (isset($_SESSION['st_fullname'])) {
                                            echo $_SESSION['st_fullname'];
                                        } else {
                                            echo 'Juan Dela Cruz';
                                        }

                                        ?>
                                        <b class="caret"></b>
                                    </p>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="modal" data-target="#changePassword" href="#">Change Password</a></li>
                                    <li><a href="http://localhost:8080/GitHub/StVincent_v2.0/includes/actions/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Load page content based on what item is clicked on the left navigation bar -->
            <?php
            if (isset($_GET['event-activity']) != null) {
                include('pages/event-activity.php');
            }
            if (isset($_GET['donation']) != null) {
                include('pages/donation.php');
            }
            if (isset($_GET['settings']) != null) {
                include('pages/settings.php');
            }
            ?>

            <!-- Footer -->
            <div class="container-fluid">
                <p class="copyright text-right" style="color:gray; font-size: small; margin-right:15px;">
                    © 2022 | St. Vincent Strambi C.P of Home for the Aged <br>
                    All rights reserved.
                </p>
            </div>
        </div>

        <?php include('modals.php'); ?>

</body>

<!------------------------- Asset references ------------------------->
<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<!-- Pop Up Alerts -->
<script src="toast.js"></script>

<!---------------------- Functionality scripts ---------------------->

<script>
    function readNotification(id) {
        $.ajax({
            type: 'POST',
            url: 'read-notif.php',
            data: {
                "id": id
            },
            success: function(msg) {
                $("#navB").load(location.href + " #navB");
            }
        });
    }
</script>

</html>
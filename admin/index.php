<?php

include '../includes/config.php';
if ($_SESSION['st_role'] == 'user') {
    header('Location: localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity');
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
                selectable: true
            });
            calendar.render();
        });
    </script>

    <title>Admin Dashboard | St. Vincent Strambi C.P of Home for the Aged</title>

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

<body onload="toast.showNotification('pe-7s-info','<?php echo $_SESSION['message']; ?>','<?php echo $_SESSION['message_type']; ?>');">
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
                        Admin Dashboard
                    </a>
                </div>
                <ul class="nav" id="leftNav">
                    <li id="navPatient" class="nav-item <?php if (isset($_GET['patient-info']) != null) {
                                                            echo 'active';
                                                        } ?>">
                        <a class="nav-link" href="?patient-info">
                            <i class="fa fa-user"></i>
                            <p>Patient Info</p>
                        </a>
                    </li>
                    <li id="navUsers" class="nav-item <?php if (isset($_GET['user-accounts']) != null) {
                                                            echo 'active';
                                                        } ?>">
                        <a class="nav-link" href="?user-accounts">
                            <i class="fa fa-users"></i>
                            <p>User Accounts</p>
                        </a>
                    </li>
                    <li id="navDonation" class="nav-item <?php if (isset($_GET['donation']) != null) {
                                                                echo 'active';
                                                            } ?>">
                        <a class="nav-link" href="?donation">
                            <i class="fa fa-money"></i>
                            <p>Donation</p>
                        </a>
                    </li>
                    <li id="navEmployee" class="nav-item <?php if (isset($_GET['employee']) != null) {
                                                                echo 'active';
                                                            } ?>">
                        <a class="nav-link" href="?employee">
                            <i class="fa fa-handshake-o"></i>
                            <p>Employee/Volunteer</p>
                        </a>
                    </li>
                    <li id="navItems" class="nav-item <?php if (isset($_GET['items']) != null) {
                                                            echo 'active';
                                                        } ?>">
                        <a class="nav-link" href="?items">
                            <i class="fa fa-calendar"></i>
                            <p>Items/Inventory</p>
                        </a>
                    </li>
                    <li id="navEvents" class="nav-item <?php if (isset($_GET['events']) != null) {
                                                            echo 'active';
                                                        } ?>">
                        <a class="nav-link" href="?events">
                            <i class="fa fa-list-alt"></i>
                            <p>Event/Activity</p>
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
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <!-- Input <li> here to show on left side of header navbar-->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-money"></i>
                                </a>
                                <?php
                                $query = "SELECT SUM(`_amount_onhand`) AS `OnHand`, 
                                                    SUM(`_amount_onbank`) AS `OnBank`, 
                                                    SUM(`_total_amount`) AS `Total` FROM `tb_monetary`";
                                $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    foreach ($query_run as $rows) {
                                        $OnBank = number_format($rows['OnHand'], 2);
                                        $OnHand = number_format($rows['OnBank'], 2);
                                        $Total = number_format($rows['Total'], 2);
                                    }
                                ?>
                                    <ul class="container dropdown-menu text-wrap" style="width: 300px;">
                                        <li class="row text-wrap" style="margin: 5px;">
                                            <a class="col" href="#">
                                                <div class="border-top justify-content-center">
                                                    <span style="font-weight: bold;">Remaining Assets</span>
                                                </div>
                                                <hr>
                                                <p class="text-wrap">Cash On Hand: <span style="color: orange;"><?php echo $OnHand; ?> PHP</span></p>
                                                <p class="text-wrap">Cash On Bank: <span style="color: orange;"><?php echo $OnBank; ?> PHP</span></p>
                                                <hr>
                                                <div class="border-bottom">
                                                    <p class="col text-center"> Total Amount: <span style="color: orange; font-weight: bold;"><?php echo $Total; ?> PHP</span></p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                <?php } ?>
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
            if (isset($_GET['patient-info']) != null) {
                include('pages/patient-info.php');
            } else {
                unset($_GET['patient-info']);
            }
            if (isset($_GET['user-accounts']) != null) {
                include('pages/user-accounts.php');
            } else {
                unset($_GET['user-accounts']);
            }
            if (isset($_GET['donation']) != null) {
                include('pages/donation.php');
            } else {
                unset($_GET['donation']);
            }
            if (isset($_GET['employee']) != null) {
                include('pages/employee.php');
            } else {
                unset($_GET['employee']);
            }
            if (isset($_GET['items']) != null) {
                include('pages/items.php');
            } else {
                unset($_GET['items']);
            }
            if (isset($_GET['events']) != null) {
                include('pages/events.php');
            } else {
                unset($_GET['events']);
            }
            if (isset($_GET['settings']) != null) {
                include('pages/settings.php');
            } else {
                unset($_GET['settings']);
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

<!-- Toast JS -->
<script src="toast.js"></script>

<!---------------------- Functionality scripts ---------------------->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: '2022-10-20',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [{
                    title: 'EVENT TEST',
                    start: '2022-10-20'
                }
                // },
                // {
                //     title: 'Long Event',
                //     start: '2022-08-07',
                //     end: '2022-08-10'
                // },
                // {
                //     groupId: '999',
                //     title: 'Repeating Event',
                //     start: '2022-08-09T16:00:00'
                // },
                // {
                //     groupId: '999',
                //     title: 'Repeating Event',
                //     start: '2022-08-16T16:00:00'
                // },
                // {
                //     title: 'Conference',
                //     start: '2022-08-11',
                //     end: '2022-08-13'
                // },
                // {
                //     title: 'Meeting',
                //     start: '2022-08-12T10:30:00',
                //     end: '2022-08-12T12:30:00'
                // },
                // {
                //     title: 'Lunch',
                //     start: '2022-08-12T12:00:00'
                // },
                // {
                //     title: 'Meeting',
                //     start: '2022-08-12T14:30:00'
                // },
                // {
                //     title: 'Birthday Party',
                //     start: '2022-08-13T07:00:00'
                // },
                // {
                //     title: 'Click for Google',
                //     url: 'http://google.com/',
                //     start: '2022-08-28'
                // }
            ]
        });

        calendar.render();
    });

</script>

</html>
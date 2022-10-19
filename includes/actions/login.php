<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // username and password sent from form
    $user =  mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $sql = mysqli_query($conn, "SELECT _id, _username, _password, _fullname, _email, _mobile, _role, _volunteer, _address FROM `tb_useracct` WHERE _username = '" . $user . "' AND _password = MD5('" . $pass . "') AND _active = 0;");
    $sql_active = mysqli_query($conn, "SELECT _id, _username, _password, _fullname, _email, _mobile, _role, _volunteer, _address FROM `tb_useracct` WHERE _username = '" . $user . "' AND _password = MD5('" . $pass . "') AND _active = 1;");

    $row_cnt = mysqli_num_rows($sql);
    $row_cnt_active = mysqli_num_rows($sql_active);

    if ($row_cnt > 0) {
        header("location: http://localhost:8080/GitHub/StVincent_v2.0/?2");
    }

    if ($row_cnt_active > 0) { // Has Account
        $row = mysqli_fetch_assoc($sql_active);

        $_SESSION['st_id'] = session_id();
        $_SESSION['st_userid'] = $row['_id'];
        $_SESSION['st_username'] = $row['_username'];
        $_SESSION['st_fullname'] = $row['_fullname'];
        $_SESSION['st_mobile'] = $row['_mobile'];
        $_SESSION['st_email'] = $row['_email'];
        $_SESSION['st_address'] = $row['_address'];
        $_SESSION['st_role'] = $row['_role'];
        $_SESSION['st_volunteer'] = $row['_volunteer'];

        $sql_notif = mysqli_query($conn, "SELECT COUNT(*) as `notif_count` FROM tb_notifications WHERE _user_id = ".$_SESSION['st_userid'].";");
        
        $row = mysqli_fetch_assoc($sql_notif);
        $_SESSION['st_notifs'] = $row['notif_count'];

        header("location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity");
    }

    else {
        header("location: http://localhost:8080/GitHub/StVincent_v2.0/?1");
    }

    $conn->close();
}

?>
<?php

include '../config.php';

if (isset($_POST['req_event'])) {

    $from = mysqli_real_escape_string($conn, $_POST['date_from']);
    $to = mysqli_real_escape_string($conn, $_POST['date_to']);
    $title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $info = mysqli_real_escape_string($conn, $_POST['event_info']);

    $add_item = "INSERT INTO `tb_events`(`_userID`, `_title`, `_body`, `_startdate`, 
                                        `_enddate`, `_draft`, `_datecreated`) 
                                        VALUES ('" . $_SESSION['st_userid'] . "','" . $title . "','" . $info . "','" . $from . "',
                                                '" . $to . "','0','" . $datetime . "')";

    $qry_notif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
                                                VALUES ('" . $_SESSION['st_userid'] . "','Event Request Sent','Made an event request','" . $datetime . "',false);";

    if (mysqli_query($conn, $add_item)) {
        if (mysqli_query($conn, $qry_notif)) {

            $sql_notif = mysqli_query($conn, "SELECT COUNT(*) as `notif_count` FROM tb_notifications WHERE _user_id = " . $_SESSION['st_userid'] . ";");

            $row = mysqli_fetch_assoc($sql_notif);
            $_SESSION['st_notifs'] = $row['notif_count'];
            $_SESSION['message'] = 'Event request sent.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error;
            $_SESSION['message_type'] = 'danger';
            echo $conn->error;
        }
    } else {
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
        echo $conn->error;
    }

    header('Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity');

    $conn->close();
} else {
    echo $conn->error;
}

<?php

include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $e_id = mysqli_real_escape_string($conn, $_POST['e_id']);
    $u_id = mysqli_real_escape_string($conn, $_POST['u_id']);

    $up_e = "UPDATE `tb_events` SET `_draft`='2' WHERE _id = '" . $e_id . "'";

    $query_insertNotif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	    VALUES ('" . $u_id . "','Event Request Cancelled','You cancelled an event request.', CURRENT_TIMESTAMP(),false);";

    if (mysqli_query($conn, $up_e)) {
        if (mysqli_query($conn, $query_insertNotif)) {
            $_SESSION['message'] = ' Cancelled Event Request. ';
            $_SESSION['message_type'] = 'warning';
            header('Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity');
        }
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity');
    }

    $conn->close();
}

?>
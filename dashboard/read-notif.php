<?php
include '../includes/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "UPDATE `tb_notifications` SET _read = '1' WHERE _id =" . $id;

    if (mysqli_query($conn, $query)) {
        echo json_encode(array('status' => 1));
        $sql_notif = mysqli_query($conn, "SELECT COUNT(*) as `notif_count` FROM tb_notifications 
                                          WHERE _read = '0' AND _user_id = " . $_SESSION['st_userid'] . ";");

        $row = mysqli_fetch_assoc($sql_notif);
        $_SESSION['st_notifs'] = $row['notif_count'];
    } else {
        echo json_encode(array('status' => 2));
    }
} else {
    $sql_notif = mysqli_query($conn, "SELECT COUNT(*) as `notif_count` FROM tb_notifications 
    WHERE _read = '0' AND _user_id = " . $_SESSION['st_userid'] . ";");

    $row = mysqli_fetch_assoc($sql_notif);
    $_SESSION['st_notifs'] = $row['notif_count'];
}
?>

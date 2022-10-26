<?php

include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass_select = mysqli_query($conn, "SELECT _password FROM `tb_useracct`WHERE _id = " . $_SESSION['st_userid']);
    $row_cnt = mysqli_num_rows($pass_select);

    $old_pass = md5(mysqli_real_escape_string($conn, $_POST['cOldPass']));
    $new_pass = mysqli_real_escape_string($conn, $_POST['cNewPass']);

    if ($row_cnt > 0) { // Has Account
        $row = mysqli_fetch_assoc($pass_select);

        $pass = $row['_password'];

        if ($old_pass == $pass) {
            $update_pass = "UPDATE `tb_useracct` SET `_password`=MD5('" . $new_pass . "') WHERE `_id` =" . $_SESSION['st_userid'];
            if (mysqli_query($conn, $update_pass)){
                header("location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity");
            }     
        }

        //header("location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?event-activity");
    }

    $conn->close();
}

?>

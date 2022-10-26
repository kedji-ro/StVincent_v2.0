<?php

include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_SESSION['st_userid']);
    $payment =mysqli_real_escape_string($conn, $_POST['p_type']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $amount_cash = mysqli_real_escape_string($conn, $_POST['csh_amount']);
    $bankname = mysqli_real_escape_string($conn, $_POST['bnk']);
    $checkno = mysqli_real_escape_string($conn, $_POST['check_no']);;
    $amount_check = mysqli_real_escape_string($conn, $_POST['chk_amount']);
    $d_img = mysqli_real_escape_string($conn, $_POST['d_img']);
    $datetimenow = date("Y-m-d h:i:sa");

    $name = mysqli_real_escape_string($conn, $_SESSION['st_fullname']);

    $query_insertNotif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	VALUES ('".$user."','Donation Sent','Made a donation', CURRENT_TIMESTAMP(),false);";

    $query_addMyDonate = "INSERT INTO `tb_donation`(`_userID`,`_fullname`, `_mop`, `_amount`, 
	`_bankname`, `_checkno`, `_remarks`, `_date`, `_type`) 
	VALUES ('".$user."','".$name."','" . $payment . "','" . $amount_cash . "','" . $bankname . "','" . $checkno . "','" . $remarks . "','" . $datetimenow . "');";
    
    if (mysqli_query($conn, $query_addMyDonate)) {
        if (mysqli_query($conn, $query_insertNotif)) {
            $sql_notif = mysqli_query($conn, "SELECT COUNT(*) as `notif_count` FROM tb_notifications WHERE _user_id = ".$_SESSION['st_userid'].";");
        
            $row = mysqli_fetch_assoc($sql_notif);
            $_SESSION['st_notifs'] = $row['notif_count'];
    
            echo json_encode(array('status' => 1));
            header ("Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?donation");
        }
        else {
            echo("Error description: " . $conn -> error);
        }
    } else {
        echo json_encode(array('status' => 0));
        $conn->error;
    }
    $conn->close();
}

?>

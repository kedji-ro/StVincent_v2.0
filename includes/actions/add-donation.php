<?php

include '../config.php';

if (isset($_POST['u_donation'])) {

    $userid = $_SESSION['st_userid'];
    $dtype = mysqli_real_escape_string($conn, $_POST['d_type']);
    $payment = mysqli_real_escape_string($conn, $_POST['p_type']);

    $amount_cash = mysqli_real_escape_string($conn, $_POST['csh_amount']);
    $amount_check = mysqli_real_escape_string($conn, $_POST['chk_amount']);
    $checkno = mysqli_real_escape_string($conn, $_POST['check_no']);
    $bankname = mysqli_real_escape_string($conn, $_POST['bnk']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    $d_filename = $_FILES['d_img']['name'];
    $d_tempname = $_FILES['d_img']['tmp_name'];
    $d_size = $_FILES['d_img']['size'];
    $folder = "../../uploads/donations/" . $d_filename;

    $q = mysqli_query($conn, "SELECT * FROM `tb_useracct` WHERE `_id` = '" . $_SESSION['st_userid'] . "'");
    $u_rows = mysqli_fetch_assoc($q);

    $fullname = $u_rows['_fullname'];
    $mobile = $u_rows['_mobile'];
    $address = $u_rows['_address'];

    if ($q) {
        $fullname = $u_rows['_fullname'];
        $mobile = $u_rows['_mobile'];
        $address = $u_rows['_address'];
    } else {
        $_SESSION['message'] = "User error." . $conn->error;
        $_SESSION['message_type'] = "danger";
        header("Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?donation");
        exit();
    }

    $qry = "";

    $qry_notif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	                    VALUES ('" . $userid . "','Donation Sent','Made a donation','" . $datetime . "',false);";

    if ($dtype == 'G') {
        $qry = "INSERT INTO `tb_donation`(`_userID`, `_fullname`, `_mobile`, `_address`, `_type`, `_remarks`, `_status`, `_datecreated`, `_upload`) 
                                    VALUES ('" . $userid . "', '" . $fullname . "', '" . $mobile . "', '" . $address . "', 'G', '" . $remarks . "','0', '" . $datetime . "', '" . $d_filename . "')";
    } else {
        if ($payment == 'Cash') {
            $qry = "INSERT INTO `tb_donation`(`_userID`,`_fullname`, `_mobile`, `_address`, `_type`, `_amount`, `_mop`, `_remarks`, `_status`, `_datecreated`, `_upload`) 
                                      VALUES ('" . $userid . "','" . $fullname . "','" . $mobile . "','" . $address . "','M','" . $amount_cash . "','Cash','" . $remarks . "','0', '" . $datetime . "', '" . $d_filename . "')";
        } else {
            $qry = "INSERT INTO `tb_donation`(`_userID`,`_fullname`, `_mobile`, `_address`, `_type`, `_bankname`, `_checkno`, `_amount`, `_mop`, `_remarks`, `_status`, `_datecreated`, `_upload`) 
                                      VALUES ('" . $userid . "','" . $fullname . "','" . $mobile . "','" . $address . "','M', '" . $bankname . "','" . $checkno . "', '" . $amount_chk . "','Check','" . $remarks . "','0', '" . $datetime . "', '" . $d_filename . "')";
        }
    }

    if (mysqli_query($conn, $qry)) {
        if (move_uploaded_file($d_tempname, $folder)) {
            if (mysqli_query($conn, $qry_notif)) {

                $sql_notif = mysqli_query($conn, "SELECT COUNT(*) as `notif_count` FROM tb_notifications WHERE _user_id = " . $_SESSION['st_userid'] . ";");

                $row = mysqli_fetch_assoc($sql_notif);
                $_SESSION['st_notifs'] = $row['notif_count'];

                $_SESSION['message'] = "Donation sent! We will notify you when donation is recieved.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Notification error.";
                $_SESSION['message_type'] = "danger";
                echo $conn->error;
            }
        } else {
            if ($d_size == 0) {
                $_SESSION['message'] = "Donation sent! We will notify you when donation is recieved.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "File upload error." . $conn->error;
                $_SESSION['message_type'] = "danger";
                echo $conn->error;
            }
        }
    } else {
        $_SESSION['message'] = "Something went wrong." . $conn->error;
        $_SESSION['message_type'] = "danger";
        echo $conn->error;
    }

    header("Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?donation");

    $conn->close();
}

if (isset($_POST['a_donation'])) {
    $dtype = mysqli_real_escape_string($conn, $_POST['d_type']);
    $amount = mysqli_real_escape_string($conn, $_POST['d_amt']);
    $bank = mysqli_real_escape_string($conn, $_POST['chk_bank']);
    $check = mysqli_real_escape_string($conn, $_POST['chk_checkref']);
    $remarks = mysqli_real_escape_string($conn, $_POST['ad_remarks']);
    //$file = mysqli_real_escape_string($conn, $_POST['ad_file']);

    $d_filename = $_FILES['ad_file']['name'];
    $d_tempname = $_FILES['ad_file']['tmp_name'];
    $d_size = $_FILES['ad_file']['size'];
    $folder = "../../uploads/donations/" . $d_filename;

    $query_addMyDonate = "INSERT INTO `tb_donation`(`_mop`, `_amount`, `_bankname`, `_checkno`, `_remarks`, `_date`, `_upload`, `_status`) 
	                                        VALUES ('" . $dtype . "','" . $amount . "', '" . $bank . "','" . $check . "','" . $remarks . "','" . $datetime . "', '" . $d_filename . "', '1');";

    if (mysqli_query($conn, $query_addMyDonate)) {
        if (move_uploaded_file($d_tempname, $folder)) {
            $_SESSION['message'] = "Donation sent! Thank you for your generousity.";
            $_SESSION['alert-message'] = "success";
        } else {
            if ($d_size == 0) {
                $_SESSION['message'] = "Donation sent! Thank you for your generousity.";
                $_SESSION['alert-message'] = "success";
            } else {
                $_SESSION['message'] = "File upload error.";
                $_SESSION['alert-message'] = "danger";
               
            }
            echo $conn->error;
        }
    } else {
        $_SESSION['message'] = "Something went wrong." . $conn->error;
        $_SESSION['alert-message'] = "danger";
    }

    header("Location: http://localhost:8080/GitHub/StVincent_v2.0/donation.php");
    $conn->close();
}

?>
<?php

include '../includes/config.php';

unset($_SESSION['message']);

if (isset($_POST['change_pass'])) {

    $pass_select = mysqli_query($conn, "SELECT _password FROM `tb_useracct`WHERE _id = " . $_SESSION['st_userid']);
    $row_cnt = mysqli_num_rows($pass_select);

    $old_pass = md5(mysqli_real_escape_string($conn, $_POST['cOldPass']));
    $new_pass = mysqli_real_escape_string($conn, $_POST['cNewPass']);

    if ($row_cnt > 0) { // Has Account
        $row = mysqli_fetch_assoc($sql_active);

        $pass = $row['_password'];

        if ($old_pass == $pass) {
            $update_pass = "UPDATE `tb_useracct` SET `_password`=MD5('" . $new_pass . "') WHERE `_id` =" . $_SESSION['st_userid'];
            if (mysqli_query($conn, $update_pass)) {
                $_SESSION['message'] = '<br> Password changed! <br><br>';
                $_SESSION['message_type'] = 'success';
                header("location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?patient-info");
            } else {
                $_SESSION['message'] = '<br> Someting went wrong: ' . $conn->error . ' <br><br>';
                $_SESSION['message_type'] = 'danger';
                header("location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?patient-info");
            }
        } else {
            $_SESSION['message'] = "<br> Passwords don't match! <br><br>";
            $_SESSION['message_type'] = 'warning';
            header("location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?patient-info");
        }
    }

    $conn->close();
}

if (isset($_POST['add_patient'])) {

    $surname = mysqli_real_escape_string($conn, $_POST['p_surname']);
    $givenname = mysqli_real_escape_string($conn, $_POST['p_givenname']);
    $midname = mysqli_real_escape_string($conn, $_POST['p_midname']);
    $nickname = mysqli_real_escape_string($conn, $_POST['p_nickname']);
    $dob = mysqli_real_escape_string($conn, $_POST['p_dob']);
    $address = mysqli_real_escape_string($conn, $_POST['p_address']);
    $religion = mysqli_real_escape_string($conn, $_POST['p_religion']);
    $edatt = mysqli_real_escape_string($conn, $_POST['p_edatt']);
    $spouse = mysqli_real_escape_string($conn, $_POST['p_spouse']);
    $age = mysqli_real_escape_string($conn, $_POST['p_age']);
    $disability = mysqli_real_escape_string($conn, $_POST['p_disability']);
    $skills = mysqli_real_escape_string($conn, $_POST['p_skills']);
    $nearest_rel = mysqli_real_escape_string($conn, $_POST['p_nearest_rel']);
    $referral = mysqli_real_escape_string($conn, $_POST['p_referral']);
    $ref_address = mysqli_real_escape_string($conn, $_POST['p_ref_address']);
    $reasons = mysqli_real_escape_string($conn, $_POST['p_reasons']);

    $fullname = $surname . ' ' . $givenname . ' ' . $midname;
    $datenow = date('Y-m-d H:i:s');

    $add_patient = "INSERT INTO `tb_patient`(`_surname`, `_givenname`, `_midname`, `_nickname`, `_fullname`, 
                                             `_birthdate`, `_address`, `_religion`, `_education`,
                                             `_spouse`, `_age`, `_disable`, `_skill`, `_relative`, `_referral`, 
                                             `_referraladdress`, `_referralreason`, `_dateentered`, `_active`, `_datecreated`)
                                                VALUES ('" . $surname . "','" . $givenname . "','" . $midname . "','" . $nickname . "','" . $fullname . "',
                                                        '" . $dob . "','" . $address . "','" . $religion . "','" . $edatt . "','" . $spouse . "','" . $age . "',
                                                        '" . $disability . "','" . $skills . "','" . $nearest_rel . "','" . $referral . "','" . $ref_address . "',
                                                        '" . $reasons . "','" . $datenow . "','1','" . $datenow . "')";

    if (mysqli_query($conn, $add_patient)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = '<br> Patient added! <br><br>';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?patient-info');
    } else {
        $_SESSION['message'] = '<br> Someting went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?patient-info');
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

if (isset($_POST['create_account'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['ua_fullname']);
    $mobile = mysqli_real_escape_string($conn, $_POST['ua_mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['ua_email']);
    $address = mysqli_real_escape_string($conn, $_POST['ua_address']);
    $user = mysqli_real_escape_string($conn, $_POST['ua_user']);
    $pass = mysqli_real_escape_string($conn, $_POST['ua_pass']);

    $datenow = date('Y-m-d H:i:s');

    // $query = "SELECT 1 FROM `tb_useracct` WHERE `_email`='" . $email . "' OR `_username`='" . $username . "' AND `_active` = 0";
    // $result = $conn->query($query);

    $add_patient = "INSERT INTO `tb_useracct`(`_username`, `_password`, `_fullname`, `_mobile`, `_email`, `_address`, `_role`, `_active`, `_datecreated`) 
                                                VALUES ('" . $user . "','" . $pass . "','" . $fullname . "','" . $mobile . "','" . $email . "','" . $address . "','user','1','" . $datenow . "')";

    if (mysqli_query($conn, $add_patient)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = '<br> Password changed! <br><br>';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?user-accounts');
    } else {
        echo json_encode(array("status" => 2));
        $_SESSION['message'] = '<br> Someting went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?user-accounts');
    }

    $conn->close();
}

if (isset($_POST['add_donation'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['d_fullname']);
    $mobile = mysqli_real_escape_string($conn, $_POST['d_mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['d_address']);
    $type = mysqli_real_escape_string($conn, $_POST['d_type']);
    $payment = mysqli_real_escape_string($conn, $_POST['d_payment']);
    $amount = mysqli_real_escape_string($conn, $_POST['d_amount']);
    $bankname = mysqli_real_escape_string($conn, $_POST['d_bankname']);
    $checkno = mysqli_real_escape_string($conn, $_POST['d_checkno']);
    $camount = mysqli_real_escape_string($conn, $_POST['d_camount']);
    $remarks = mysqli_real_escape_string($conn, $_POST['d_remarks']);

    $datenow = date('Y-m-d H:i:s');

    $add_donation = "INSERT INTO `tb_donation`( `_fullname`, `_mobile`, `_address`, `_type`, `_date`,
                                                `_mop`, `_amount`, `_bankname`, `_checkno`, `_remarks`,
                                                `_status`) 
                                                VALUES ('" . $fullname . "','" . $mobile . "','" . $address . "','" . $type . "','" . $datenow . "',
                                                '" . $payment . "','" . $amount . "','" . $bankname . "','" . $checkno . "','" . $remarks . "','1')";

    if (mysqli_query($conn, $add_donation)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = '<br> Donation sent! <br><br>';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?donation');
    } else {
        echo json_encode(array("status" => 2));
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?donation');
    }

    $conn->close();
}

if (isset($_POST['recieve_donation'])) {

    $d_id = mysqli_real_escape_string($conn, $_POST['d_id']);
    $u_id = mysqli_real_escape_string($conn, $_POST['u_id']);

    $datenow = date('Y-m-d H:i:s');

    $up_d = "UPDATE `tb_donation` SET `_status`='1' WHERE _id = '" . $d_id . "'";

    $query_insertNotif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	    VALUES ('" . $u_id . "','Donation Recieved','Your donation has been recieved.', CURRENT_TIMESTAMP(),false);";

    if (mysqli_query($conn, $up_d)) {
        if (mysqli_query($conn, $query_insertNotif)) {
            echo json_encode(array("status" => 1));
            $_SESSION['message'] = '<br> Donation received! <br><br>';
            $_SESSION['message_type'] = 'success';
            header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?donation');
        }   
    } else {
        echo json_encode(array("status" => 2));
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?donation');
    }

    $conn->close();
}

if (isset($_POST['add_employee'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['e_fullname']);
    $age = mysqli_real_escape_string($conn, $_POST['e_age']);
    $sex = mysqli_real_escape_string($conn, $_POST['e_sex']);
    $dob = mysqli_real_escape_string($conn, $_POST['e_dob']);
    $address = mysqli_real_escape_string($conn, $_POST['e_address']);
    $role = mysqli_real_escape_string($conn, $_POST['e_role']);
    $enlist_date = mysqli_real_escape_string($conn, $_POST['e_enlist_date']);

    $datenow = date('Y-m-d H:i:s');

    // $query = "SELECT 1 FROM `tb_useracct` WHERE `_email`='" . $email . "' OR `_username`='" . $username . "' AND `_active` = 0";
    // $result = $conn->query($query);

    $add_emp = "INSERT INTO `tb_employee`(`_fullname`, `_age`, `_sex`, `_birthdate`, 
                                            `_address`, `_datehired`, `_role`, `_active`, 
                                            `_datecreated`) 
                                            VALUES ('" . $fullname . "','" . $age . "','" . $sex . "',
                                                    '" . $dob . "','" . $address . "','" . $enlist_date . "',
                                                    '" . $role . "','1','" . $datenow . "')";

    if (mysqli_query($conn, $add_emp)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = '<br> Employee added! <br><br>';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?employee');
    } else {
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?employee');
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

if (isset($_POST['add_item'])) {

    $name = mysqli_real_escape_string($conn, $_POST['i_name']);
    $qty = mysqli_real_escape_string($conn, $_POST['i_qty']);
    $des = mysqli_real_escape_string($conn, $_POST['i_des']);

    $datenow = date('Y-m-d H:i:s');

    $add_item = "INSERT INTO `tb_item`(`_name`, `_desc`, `_stock`, `_active`, `_datecreated`) 
                                VALUES ('" . $name . "','" . $des . "','" . $qty . "','1','" . $datenow . "')";

    if (mysqli_query($conn, $add_item)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = '<br> Item added! <br><br>';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?items');
    } else {
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?items');
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

if (isset($_POST['add_event'])) {

    $from = mysqli_real_escape_string($conn, $_POST['date_from']);
    $to = mysqli_real_escape_string($conn, $_POST['date_to']);
    $title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $info = mysqli_real_escape_string($conn, $_POST['event_info']);

    $datenow = date('Y-m-d H:i:s');

    $add_item = "INSERT INTO `tb_events`(`_userID`, `_title`, `_body`, `_startdate`, 
                                        `_enddate`, `_draft`, `_datecreated`) 
                                        VALUES ('" . $_SESSION['st_userid'] . "','" . $title . "','" . $info . "','" . $from . "',
                                                '" . $to . "','1','" . $datenow . "')";

    if (mysqli_query($conn, $add_item)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = '<br> Event added! <br><br>';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?events');
    } else {
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?events');
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

if (isset($_POST['admin_save'])) {

    $id = mysqli_real_escape_string($conn, $_SESSION['st_userid']);
    $fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));

    $query_editProfile = "UPDATE `tb_useracct` SET 
	`_fullname`='" . $fullname . "',`_mobile`='" . $mobile . "',
	`_email`='" . $email . "',`_address`='" . $address . "' WHERE `_id`='" . $id . "'";

    if (mysqli_query($conn, $query_editProfile)) {
        $_SESSION['st_fullname'] = $fullname;
        $_SESSION['st_mobile'] = $mobile;
        $_SESSION['st_email'] = $email;
        $_SESSION['st_address'] = $address;

        $_SESSION['message'] = '<br> Profile updated! <br><br>';
        $_SESSION['message_type'] = 'success';
        header("Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?settings");
        echo json_encode(array('status' => 1));
    } else {
        $_SESSION['message'] = '<br> Something went wrong: ' . $conn->error . ' <br><br>';
        $_SESSION['message_type'] = 'danger';
        header("Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/?settings");
        echo json_encode(array('status' => 0));
    }

    $conn->close();
}
?>
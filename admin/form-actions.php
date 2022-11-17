<?php

include '../includes/config.php';

unset($_SESSION['message']);

if (isset($_POST['change_pass'])) {

    $pass_select = mysqli_query($conn, "SELECT _password FROM `tb_useracct`WHERE _id = " . $_SESSION['st_userid']);
    $row_cnt = mysqli_num_rows($pass_select);

    $old_pass = md5(mysqli_real_escape_string($conn, $_POST['cOldPass']));
    $new_pass = mysqli_real_escape_string($conn, $_POST['cNewPass']);
    $re_pass = mysqli_real_escape_string($conn, $_POST['cRePass']);

    $update_pass = "UPDATE `tb_useracct` SET `_password`=MD5('" . $new_pass . "') WHERE `_id` =" . $_SESSION['st_userid'];

    if ($row_cnt > 0) {
        $row = mysqli_fetch_assoc($pass_select);

        $pass = $row['_password'];

        if ($old_pass == $pass) {
            if ($re_pass == $new_pass) {
                if (mysqli_query($conn, $update_pass)) {
                    $_SESSION['message'] = 'Password changed succesfully.';
                    $_SESSION['message_type'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong.';
                    $_SESSION['message_type'] = 'danger';
                }
            } else {
                $_SESSION['message'] = 'Passwords do not match.';
                $_SESSION['message_type'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Wrong old password.';
            $_SESSION['message_type'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Database error.';
        $_SESSION['message_type'] = 'danger';
    }

    header("location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?patient-info");

    $conn->close();
}

if (isset($_POST['add_patient'])) {

    $entrydate = mysqli_real_escape_string($conn, $_POST['p_dateOfEntry']);
    $surname = mysqli_real_escape_string($conn, $_POST['p_surname']);
    $givenname = mysqli_real_escape_string($conn, $_POST['p_givenname']);
    $midname = mysqli_real_escape_string($conn, $_POST['p_midname']);
    $nickname = mysqli_real_escape_string($conn, $_POST['p_nickname']);
    $dob = mysqli_real_escape_string($conn, $_POST['p_dob']);
    $pob = mysqli_real_escape_string($conn, $_POST['p_pob']);
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

    $validate_entry = array($entrydate, $surname, $givenname, $dob, $pob, $age, $address);

    foreach ($validate_entry as $field) {
        if (empty($field)) {
            $_SESSION['message'] = 'One or more required fields are missing!  ';
            $_SESSION['message_type'] = 'warning';
            header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?patient-info');
            exit();
        }
    }

    $fullname = $surname . ', ' . $givenname . ' ' . $midname;

    $add_patient = "INSERT INTO `tb_patient`(`_surname`, `_givenname`, `_midname`, `_nickname`, `_fullname`, 
                                             `_birthdate`, `_birthplace`, `_address`, `_religion`, `_education`,
                                             `_spouse`, `_age`, `_disable`, `_skill`, `_relative`, `_referral`, 
                                             `_referraladdress`, `_referralreason`, `_dateentered`, `_active`, `_datecreated`)
                                                VALUES ('" . $surname . "','" . $givenname . "','" . $midname . "','" . $nickname . "','" . $fullname . "',
                                                        '" . $dob . "','" . $pob . "','" . $address . "','" . $religion . "','" . $edatt . "','" . $spouse . "','" . $age . "',
                                                        '" . $disability . "','" . $skills . "','" . $nearest_rel . "','" . $referral . "','" . $ref_address . "',
                                                        '" . $reasons . "','" . $entrydate . "','1','" . $datetime . "')";

    if (mysqli_query($conn, $add_patient)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = ' Patient added!  ';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?patient-info');
    } else {
        $_SESSION['message'] = ' Someting went wrong: ' . $conn->error . '  ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?patient-info');
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

    // $query = "SELECT 1 FROM `tb_useracct` WHERE `_email`='" . $email . "' OR `_username`='" . $username . "' AND `_active` = 0";
    // $result = $conn->query($query);

    $add_patient = "INSERT INTO `tb_useracct`(`_username`, `_password`, `_fullname`, `_mobile`, `_email`, `_address`, `_role`, `_active`, `_datecreated`) 
                                                VALUES ('" . $user . "',md5('" . $pass . "'),'" . $fullname . "','" . $mobile . "','" . $email . "','" . $address . "','user','1','" . $datetime . "')";

    if (mysqli_query($conn, $add_patient)) {
        $_SESSION['message'] = ' Account created! ';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?user-accounts');
    } else {
        $_SESSION['message'] = ' Someting went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?user-accounts');
    }

    $conn->close();
}

if (isset($_POST['deact_account'])) {

    $u_id = mysqli_real_escape_string($conn, $_POST['us_id']);

    $up_u = "UPDATE `tb_useracct` SET `_active`='0' WHERE _id = '" . $u_id . "'";

    if (mysqli_query($conn, $up_u)) {
        $_SESSION['message'] = 'User deactivated.';
        $_SESSION['message_type'] = 'info';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?user-accounts');
    } else {
        $_SESSION['message'] = 'Something went wrong: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?user-accounts');
    }

    $conn->close();
}

if (isset($_POST['act_account'])) {

    $u_id = mysqli_real_escape_string($conn, $_POST['au_id']);

    $up_u = "UPDATE `tb_useracct` SET `_active`='1' WHERE _id = '" . $u_id . "'";

    if (mysqli_query($conn, $up_u)) {
        $_SESSION['message'] = 'User activated.';
        $_SESSION['message_type'] = 'info';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?user-accounts');
    } else {
        $_SESSION['message'] = 'Something went wrong: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?user-accounts');
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

    $add_donation = "INSERT INTO `tb_donation`( `_fullname`, `_mobile`, `_address`, `_type`, `_date`,
                                                `_mop`, `_amount`, `_bankname`, `_checkno`, `_remarks`,
                                                `_status`) 
                                                VALUES ('" . $fullname . "','" . $mobile . "','" . $address . "','" . $type . "','" . $datetime . "',
                                                '" . $payment . "','" . $amount . "','" . $bankname . "','" . $checkno . "','" . $remarks . "','1')";

    if (mysqli_query($conn, $add_donation)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = ' Donation sent! ';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?donation');
    } else {
        echo json_encode(array("status" => 2));
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?donation');
    }

    $conn->close();
}

if (isset($_POST['recieve_donation'])) {

    $d_id = mysqli_real_escape_string($conn, $_POST['d_id']);
    $u_id = mysqli_real_escape_string($conn, $_POST['du_id']);

    $up_d = "UPDATE `tb_donation` SET `_status`='1', `_date`='" . $datetime . "' WHERE _id = '" . $d_id . "'";

    $query_insertNotif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	    VALUES ('" . $u_id . "','Donation Recieved','Your donation has been recieved.', CURRENT_TIMESTAMP(),false);";

    if (mysqli_query($conn, $up_d)) {
        if (mysqli_query($conn, $query_insertNotif)) {
            $_SESSION['message'] = ' Donation received! ';
            $_SESSION['message_type'] = 'success';
        }
    } else {
        echo json_encode(array("status" => 2));
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
       
    }

    header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?donation');

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

    // $query = "SELECT 1 FROM `tb_useracct` WHERE `_email`='" . $email . "' OR `_username`='" . $username . "' AND `_active` = 0";
    // $result = $conn->query($query);

    $add_emp = "INSERT INTO `tb_employee`(`_fullname`, `_age`, `_sex`, `_birthdate`, 
                                            `_address`, `_datehired`, `_role`, `_active`, 
                                            `_datecreated`) 
                                            VALUES ('" . $fullname . "','" . $age . "','" . $sex . "',
                                                    '" . $dob . "','" . $address . "','" . $enlist_date . "',
                                                    '" . $role . "','1','" . $datetime . "')";

    if (mysqli_query($conn, $add_emp)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = ' Employee added! ';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?employee');
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?employee');
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

if (isset($_POST['add_item'])) {

    $name = mysqli_real_escape_string($conn, $_POST['i_name']);
    $qty = mysqli_real_escape_string($conn, $_POST['i_qty']);
    $des = mysqli_real_escape_string($conn, $_POST['i_des']);

    $add_item = "INSERT INTO `tb_item`(`_name`, `_desc`, `_stock`, `_active`, `_datecreated`) 
                                VALUES ('" . $name . "','" . $des . "','" . $qty . "','1','" . $datetime . "')";

    if (mysqli_query($conn, $add_item)) {
        echo json_encode(array("status" => 1));
        $_SESSION['message'] = ' Item added! ';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?items');
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?items');
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

if (isset($_POST['add_event'])) {

    $from = mysqli_real_escape_string($conn, $_POST['date_from']);
    $to = mysqli_real_escape_string($conn, $_POST['date_to']);
    $title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $info = mysqli_real_escape_string($conn, $_POST['event_info']);

    $add_item = "INSERT INTO `tb_events`(`_userID`, `_title`, `_body`, `_startdate`, 
                                        `_enddate`, `_draft`, `_datecreated`) 
                                        VALUES ('" . $_SESSION['st_userid'] . "','" . $title . "','" . $info . "','" . $from . "',
                                                '" . $to . "','1','" . $datetime . "')";

    if (mysqli_query($conn, $add_item)) {
        $_SESSION['message'] = ' Event added! ';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?events');
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?events');
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

        $_SESSION['message'] = ' Profile updated! ';
        $_SESSION['message_type'] = 'success';
        header("Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?settings");
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header("Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?settings");
    }

    $conn->close();
}

if (isset($_POST['p_archive'])) {

    $p_id = mysqli_real_escape_string($conn, $_POST['p_id']);
    $arc_reason = mysqli_real_escape_string($conn, $_POST['arc_reason']);
    $date_died = mysqli_real_escape_string($conn, $_POST['date_died']);
    $date_out = mysqli_real_escape_string($conn, $_POST['date_out']);
    $cod = mysqli_real_escape_string($conn, $_POST['cod']);
    $other = mysqli_real_escape_string($conn, $_POST['other']);

    $upd_p = "";
    if ($p_id == "1") {
        $upd_p = "UPDATE `tb_patient` SET `_datedied`='" . $date_died . "',`_causeofdeath`='" . $cod . "',`_active`='0' WHERE _id= '" . $p_id . "'";
    } else {
        $upd_p = "UPDATE `tb_patient` SET `_causeofdeath`='" . $cod . "',`_active`='0' WHERE _id= '" . $p_id . "'";
    }


    if (mysqli_query($conn, $upd_p)) {
        $_SESSION['message'] = 'Patient information archived successfully.';
        $_SESSION['message_type'] = 'success';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?patient-info');
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?patient-info');
    }

    $conn->close();
}

if (isset($_POST['approve_event'])) {

    $e_id = mysqli_real_escape_string($conn, $_POST['e_id']);
    $u_id = mysqli_real_escape_string($conn, $_POST['u_id']);
    $e_title = mysqli_real_escape_string($conn, $_POST['e_t']);

    $up_d = "UPDATE `tb_events` SET `_draft`='1' WHERE _id = '" . $e_id . "'";

    $query_insertNotif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	    VALUES ('" . $u_id . "','Event Request Approved','" . $e_title . " has been approved.', CURRENT_TIMESTAMP(),false);";

    if (mysqli_query($conn, $up_d)) {
        if (mysqli_query($conn, $query_insertNotif)) {
            $_SESSION['message'] = ' Event Approved! ';
            $_SESSION['message_type'] = 'success';
            header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?events');
        }
    } else {
        $_SESSION['message'] = ' Something went wrong: ' . $conn->error . ' ';
        $_SESSION['message_type'] = 'danger';
        header('Location: http://localhost:8080/GitHub/StVincent_v2.0/admin/dashboard.php?events');
    }

    $conn->close();
}
?>
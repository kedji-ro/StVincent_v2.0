<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_SESSION['st_userid']);
    $payment ='Cash';
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $amount_cash = 1000.00;
    $bankname = 'Metrobank';
    $checkno = '8768';
    $amount_check = 9989.5;
    $datetimenow = date("Y/m/d h:i:sa");
    //$getamount = ($payment == "C") ? $amount_cash : $amount_check;
    //$hasFile = (isset($_FILES['file'])) ? true : false;
    $name = mysqli_real_escape_string($conn, $_SESSION['st_fullname']);
   // $extension = "";
    //$new_name = "";
   // $location = "../assets/uploadfile/";

    // if ($hasFile) {
    //     $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    //     $new_name = $name . '_' . time() . '.' . $extension;
    //     move_uploaded_file($_FILES["file"]["tmp_name"], $location . '' . $new_name);
    // }

    $query_insertNotif = "INSERT INTO `tb_notifications`(`_user_id`,`_title`, `_description`, `_timestamp`,`_read`) 
	VALUES ('".$user."','Donation Sent','Made a donation', CURRENT_TIMESTAMP(),false);";

    $query_addMyDonate = "INSERT INTO `tb_donation`(`_userID`,`_fullname`, `_mop`, `_amount`, 
	`_bankname`, `_checkno`, `_remarks`, `_date`) 
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
    }
    $conn->close();
}

?>

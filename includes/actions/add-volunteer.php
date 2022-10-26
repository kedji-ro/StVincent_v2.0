<?php

include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_SESSION["st_fullname"];
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $datenow = date('Y-m-d H:i:s');

    $q = "SELECT 1 FROM `tb_employee` WHERE _useracctID = " . $_SESSION['st_userid'];
    $result = mysqli_query($conn, $q);
    $row_count = $result->num_rows;


    if ($row_count > 0) {

        $q_update = "UPDATE `tb_employee` SET `_role`='Volunteer' WHERE `_useracctID`=".$_SESSION['st_userid'];
        
        if (mysqli_query($conn,$q_update)) {
            echo json_encode(array("status" => 1));
            header('Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?donation');
        }
        else {
            echo json_encode(array("status" => 2));
            echo $conn->error;
        }
    } else {

        $add_emp = "INSERT INTO `tb_employee`(`_useracctID`,`_fullname`, `_sex`, `_birthdate`, 
                                            `_address`, `_datehired`, `_role`, `_active`, 
                                            `_datecreated`) 
                                            VALUES ('".$_SESSION['st_userid']."','" . $name . "','" . $sex . "',
                                                    '" . $dob . "','" . $address . "','" . $datenow . "',
                                                    'Volunteer','1','" . $datenow . "')";

        if (mysqli_query($conn, $add_emp)) {
            echo json_encode(array("status" => 3));

            header('Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?donation');
        } else {
            echo json_encode(array("status" => 4));
            echo $conn->error;
            // header('Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?donation');
        }
    }
    $conn->close();
}

?>
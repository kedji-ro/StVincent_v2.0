<?php
include 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\config.php';
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

use function PHPSTORM_META\elementType;

require 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\vendor\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\vendor\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\vendor\phpmailer\src\SMTP.php';


function generateToken($length = 35)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['sName']));
    $email = mysqli_real_escape_string($conn, $_POST['sEmail']);
    $mobile = mysqli_real_escape_string($conn, $_POST['sMobile']);
    $address = strtoupper(mysqli_real_escape_string($conn, $_POST['sAddress']));
    $username = mysqli_real_escape_string($conn, $_POST['sUser']);
    $password = mysqli_real_escape_string($conn, $_POST['sPass']);
    $token = generateToken();
    $url = "http://localhost:8080/GitHub/StVincent_v2.0/registration/?token=" . $token;

    $query = "SELECT 1 FROM `tb_useracct` WHERE `_email`='" . $email . "' OR `_username`='" . $username . "' AND `_active` = 0";
    $query_active = "SELECT 1 FROM `tb_useracct` WHERE `_email`='" . $email . "' OR `_username`='" . $username . "' AND `_active` = 1";
    $result = $conn->query($query);
    $row_cnt = $result->num_rows;
    $result = $conn->query($query_active);
    $row_cnt_active = $result->num_rows;

    $query_createUser = "INSERT INTO `tb_useracct`(`_username`, `_password`, `_fullname`, `_mobile`, `_email`, `_address`, `_role`, `_tokenactivation`, `_active`) 
                                VALUES ('" . $username . "',MD5('" . $password . "'),'" . $fullname . "','" . $mobile . "','" . $email . "','" . $address . "','user','" . $token . "','0')";

    if ($row_cnt == 0 && $row_cnt_active == 0) {
        if (mysqli_query($conn, $query_createUser)) {
            echo json_encode(array("status" => 1));
            email_RegistrationForm($email, $token, $url);

            header ('Location: http://localhost:8080/GitHub/StVincent_v2.0/?3');
        }

        else {
            
        }
    }

    else {
        echo json_encode(array("status" => 2));
    }

    $conn->close();
}

function email_RegistrationForm($email, $token, $url)
{

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp-relay.sendinblue.com';
    $mail->SMTPAuth = true;
    $mail->Username = '09488824630gebson@gmail.com';
    $mail->Password = 'G2fc8QMjzVUOSE6p';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("09488824630gebson@gmail.com", "St. Vincent Strambi C.P of Home for the Aged");
    $mail->addAddress($email);
    $mail->addReplyTo("09488824630gebson@gmail.com", "St. Vincent Strambi C.P of Home for the Aged");
    $mail->isHTML(true);
    $body_template = '<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
            <tbody>
            <tr>
            <td id="bodyCell" style="padding: 20px;" align="center" valign="top">
            <table id="templateContainer" style="width: 55%; border: 1px solid #ddd; background-color: #4fa6f0;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
            <td align="center" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
            <td class="" valign="top" style="text-align: center;">
            <p style="font-size: 30px;font-weight: bold;color: azure;padding-bottom: 21px;">St. Vincent Strambi<br>C.P of Home for the Aged</p>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td align="center" valign="top">
            <table id="templateBody" style="background-color: #fff;" border="0" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
            <td class="bodyContent" style="font-family: Helvetica; line-height: 150%; text-align: justify; margin: 0px; color: #505050; font-size: 14px; padding: 20px;" valign="top">
            <p style="text-align: justify;">Hello,</p>
            <p style="text-align: justify;">Welcome to St. Vincent Strambi C.P of Home for the Aged</p>
            <p style="text-align: justify;">To complete with your registration, just follow the link provided below.</p>
            <p style="text-align: justify;"><a href="' . $url . '">' . $url . '</a></p>
            <p style="text-align: justify;">Thank you!</p>&nbsp;
            <p style="text-align: justify;">Regards,</p> 
            <p style="text-align: justify; margin-bottom: -15px;">St. Vincent Strambi C.P of Home for the Aged</p>
            <p style="text-align: justify; margin-bottom: -15px;"></p>
            <p style="text-align: justify;">---.</p>
    
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td align="center" valign="top">
            <table id="templateFooter" style="width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
            <td class="footerNote" style="font-style: italic; background-color: #9fa2a2; line-height: 100%; text-align: justify; font-size: small; padding: 15px;" valign="top">
            <p style="margin: 0px; color: #000000;">This e-mail message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure and protected by Data Privacy Act. If you are not the intended recipient, you are notified that any dissemination, distribution or copying of this communication is strictly prohibited. If you have received this communication in error, please notify the sender and delete this E-mail message immediately.</p>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td align="center" valign="top">
            <table id="templateFooter" style="width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
            <td class="footerContent" style="font-family: Helvetica; line-height: 150%; text-align: center; margin: 0px; color: #ffffff; font-size: small; padding: 15px; width: 100%;" valign="top">
            <p style="margin: 0px; color: #fff;">St. Vincent Strambi C.P of Home for the Aged</p>
            <p style="margin: 0px; color: #fff;">9500 General Santos City, Philippines</p>
            <p style="margin: 0px; color: #fff;"><b>Telefax No.</b>: (083) 111-2222</p>
            <p style="margin: 0px; color: #fff;"><b>Telephone No.</b>: (083) 111-2222</p>
            <p style="margin: 0px; color: #fff;">Copyright &copy; 2022, All Rights Reserved.</p>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
        </table>';

    $mail->Subject = 'Account Activation Email';
    $mail->Body    = $body_template;
    $mail->AltBody = 'Hello, Welcome to St. Vincent Strambi C.P of Home for the Aged. To complete with your registration, just follow this link: ' . $url . '. Thank you! Regards, St. Vincent Strambi C.P of Home for the Aged.';

    if (!$mail->send()) {
        echo json_encode(array('status' => 0));
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo json_encode(array('status' => 1));
    }
}

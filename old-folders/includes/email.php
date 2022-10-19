<?php 

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';  
require('config.php');

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');    
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
}   

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}


if (isset($_GET['data']) && $_GET['data']=="user_verification_email"){
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $token = mysqli_real_escape_string($conn, $_GET['token']); 
    $url = "http://localhost/StVincent/registration/?token=".$token;
    // $url = "https://domain.com/registration/?token=".$token;
  
    if (strlen($email) > 0){ 
        email_RegistrationForm($email,$token,$url);
    } 
    else{
        echo json_encode(array('status'=>2));  
    }
} 

if (isset($_GET['data']) && $_GET['data']=="admincreateuseracct_verification_email"){
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $token = mysqli_real_escape_string($conn, $_GET['token']);
    $uname = mysqli_real_escape_string($conn, $_GET['u']);
    $pass = mysqli_real_escape_string($conn, $_GET['p']); 
    $url = "http://localhost/StVincent/registration/?token=".$token;
    // $url = "https://domain.com/registration/?token=".$token;
  
    if (strlen($email) > 0){ 
        email_RegistrationForm_AdminUsrAcct($email,$token,$uname,$pass,$url);
    } 
    else{
        echo json_encode(array('status'=>2));  
    }
} 

// self::DEBUG_OFF (0) No debug output, default
// self::DEBUG_CLIENT (1) Client commands
// self::DEBUG_SERVER (2) Client commands and server responses
// self::DEBUG_CONNECTION (3) As DEBUG_SERVER plus connection status
// self::DEBUG_LOWLEVEL (4) Low-level data output, all messages.

function email_RegistrationForm($email,$token,$url){ 
    $mail = new PHPMailer(); 

    $mail->isSMTP();
    $mail->Host = 'smtp-relay.sendinblue.com';  
    $mail->SMTPAuth = true; 
    $mail->Username = 'mlksh4ke3@gmail.com';
    $mail->Password = '6hKqLP2bQRtEnJWF';  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;  
    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //     'verify_peer' => false,
    //     'verify_peer_name' => false,
    //     'allow_self_signed' => true
    //     )
    // );
    $mail->setFrom("mlksh4ke3@gmail.com", "St. Vincent Strambi C.P of Home for the Aged");
    $mail->addAddress($email); 
    $mail->addReplyTo("mlksh4ke3@gmail.com", "St. Vincent Strambi C.P of Home for the Aged");
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
        <p style="font-size: 30px;font-weight: bold;color: azure;padding-bottom: 21px;">St. Vincent Strambi C.P of Home for the Aged</p>
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
        <p style="text-align: justify;"><a href="'.$url.'">'.$url.'</a></p>
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
    $mail->AltBody = 'Hello, Welcome to St. Vincent Strambi C.P of Home for the Aged. To complete with your registration, just follow this link: '.$url.'. Thank you! Regards, St. Vincent Strambi C.P of Home for the Aged.';
    
    if(!$mail->send()) {
        echo json_encode(array('status'=>0));  
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
    else {
        echo json_encode(array('status'=>1));  
    }
} 

function email_RegistrationForm_AdminUsrAcct($email,$token,$uname,$pass,$url){
    $mail = new PHPMailer(); 

    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com'; 
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    $mail->Username = 'oj020263@gmail.com';
    $mail->Password = 'maryannjacinto';  
    $mail->Port = 587;  
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );

    $mail->AddAddress($email);
    $mail->SetFrom("oj020263@gmail.com", "St. Vincent Strambi C.P of Home for the Aged");
    $mail->AddReplyTo("oj020263@gmail.com", "St. Vincent Strambi C.P of Home for the Aged");

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
        <p style="font-size: 30px;font-weight: bold;color: azure;padding-bottom: 21px;">St. Vincent Strambi C.P of Home for the Aged</p>
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
        <p style="text-align: justify;">Admin created an account on your behalf. </p>&nbsp;
        <p style="text-align: justify;">Username: '.$uname.'</p>
        <p style="text-align: justify;">Password: '.$pass.'</p>&nbsp;
        <p style="text-align: justify;">But first, you have to activate your account. Just follow the link provided below.</p>
        <p style="text-align: justify;"><a href="'.$url.'">'.$url.'</a></p>
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
    $mail->AltBody = 'Hello, Welcome to St. Vincent Strambi C.P of Home for the Aged. Admin created an account on your behalf with Username: '.$uname.' and Password: '.$pass.'. But first, you have to activate your account, just follow this link: '.$url.'. Thank you! Regards, St. Vincent Strambi C.P of Home for the Aged.';
    
    if(!$mail->send()) {
        echo json_encode(array('status'=>0));  
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
    else {
        echo json_encode(array('status'=>1));  
    }
}
?>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = mysqli_real_escape_string($conn, $_SESSION['st_userid']);  
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address'])); 
 
	$query_editProfile= "UPDATE `tb_useracct` SET 
	`_fullname`='".$fullname."',`_mobile`='".$mobile."',
	`_email`='".$email."',`_address`='".$address."' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_editProfile)){   
		$_SESSION['st_fullname'] = $fullname;  
		$_SESSION['st_mobile'] = $mobile;
		$_SESSION['st_email'] = $email; 
		$_SESSION['st_address'] = $address;  
        
        header ("Location: http://localhost:8080/GitHub/StVincent_v2.0/dashboard/?settings");
		//echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

?>
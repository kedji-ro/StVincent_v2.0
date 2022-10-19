<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// session_start();
date_default_timezone_set('Asia/Manila');
$datetime = date('Y-m-d h:i:s', time()); 
$date = date('Y-m-d'); 
$time = date('H:i', time());   
 
$servername = '127.0.0.1';
$username = 'root';
$password = ''; 
$databasename = 'stvincent_db';  

// $servername = 'localhost';
// $username = 'eaaabpbl_niortech';
// $password = 'VBUs0T48UTJd'; 
// $databasename = 'eaaabpbl_stvincent_db';  

 
$conn = new mysqli($servername, $username, $password, $databasename);  
?>


<?php

include 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\config.php';

$query = "SELECT * FROM `tb_notifications` WHERE _user_id =". $_SESSION['st_userid']." ORDER BY `_timestamp` DESC LIMIT 5";
$result = $conn->query($query);

while ($row = $result->fetch_array()) {
    echo '<li class="border-bottom row text-wrap" style="margin: 5px;">
            <a class="border-top col" href="#"><span style="font-weight: bold;">'.$row['_title'].'</span>
            <br><span class="text-wrap">'.$row['_description'].' </span><br>
            <span class="small">'.$row['_timestamp'].'</span>
            </a>
          </li>';
}
?>
<?php

include '../includes/config.php';

$query = "SELECT * FROM `tb_notifications` WHERE _user_id =" . $_SESSION['st_userid'] . " 
                                                    ORDER BY `_read`,`_timestamp` DESC";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
  foreach ($query_run as $row) {
    if ($row['_read'] == '0') {  ?>
      <li class="border-bottom row text-wrap" style="margin: 5px; background-color: rgba(237, 243, 248, 0.3);" onclick="readNotification(<?php echo $row['_id']; ?>)">
        <a class="border-top col" href="#"><span style="font-weight: bold; color:cornflowerblue;"><?php echo $row['_title']; ?></span>
          <br><span class="text-wrap"><?php echo $row['_description']; ?></span><br>
          <span class="small"><?php echo $row['_timestamp']; ?></span>
        </a>
      </li>
    <?php   } else { ?>
      <li class="border-bottom row text-wrap" style="margin: 5px;" id="notifElement" value="<?php echo $row['_id']; ?>">
        <a class="border-top col" href="#"><span style="font-weight: bold;"><?php echo $row['_title']; ?></span>
          <br><span class="text-wrap"><?php echo $row['_description']; ?></span><br>
          <span class="small"><?php echo $row['_timestamp']; ?></span>
        </a>
      </li>
<?php   }
  }
} 


// $query = "SELECT * FROM `tb_notifications` WHERE _user_id =". $_SESSION['st_userid']." ORDER BY `_timestamp` DESC";
// $result = $conn->query($query);

// while ($row = $result->fetch_array()) {
//     echo '<li class="border-bottom row text-wrap" style="margin: 5px;">
//             <a class="border-top col" href="#"><span style="font-weight: bold;">'.$row['_title'].'</span>
//             <br><span class="text-wrap">'.$row['_description'].' </span><br>
//             <span class="small">'.$row['_timestamp'].'</span>
//             </a>
//           </li>';
// }
?>
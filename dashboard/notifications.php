<?php

include '../includes/config.php';

$query = "SELECT * FROM `tb_notifications` WHERE _user_id =" . $_SESSION['st_userid'] . " 
                                                    ORDER BY `_read`,`_timestamp` DESC LIMIT 15";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
  foreach ($query_run as $row) {
    if ($row['_read'] == '0') {  ?>
      <li class="border-bottom row text-wrap" style="margin: 5px; background-color: rgba(237, 243, 248, 0.8);" onclick="readNotification(<?php echo $row['_id']; ?>)">
        
        <a class="border-top col" href="#"><i class="fa fa-<?php if (strpos($row['_title'],'Event') !== false) {echo 'calendar';} elseif (strpos($row['_title'],'Donation') !== false) {echo 'money';} else { echo 'bell';}?>"></i><span style="font-weight: bold; color:cornflowerblue;"><?php echo ' '. $row['_title']; ?></span>
          <br><span class="text-wrap"><?php echo $row['_description']; ?></span><br>
          <span class="small"><?php echo $row['_timestamp']; ?></span>
        </a>
      </li>
    <?php   } else { ?>
      <li class="border-bottom row text-wrap" style="margin: 5px;" id="notifElement" value="<?php echo $row['_id']; ?>">
        <a class="border-top col" href="#"><i class="fa fa-<?php if (strpos($row['_title'],'Event') !== false) {echo 'calendar';} elseif (strpos($row['_title'],'Donation') !== false) {echo 'money';} else { echo 'bell';}?>"></i><span style="font-weight: bold;"><?php echo ' '. $row['_title']; ?></span>
          <br><span class="text-wrap"><?php echo $row['_description']; ?></span><br>
          <span class="small"><?php echo $row['_timestamp']; ?></span>
        </a>
      </li>
<?php   }
  }
}

?>
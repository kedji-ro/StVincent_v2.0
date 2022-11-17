<?php

$schedules = $conn->query("SELECT _id, _title, _startdate, _enddate FROM `tb_events`");
$sched_res = [];

foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    $row['title'] = $row['_title'];  
    $row['start'] = $row['_startdate'];
    $row['end'] = $row['_enddate'];

    switch ($date) {
        case $row['_enddate'] < $date:
            $row['color'] = "gray";
            break;
        case $row['_startdate'] > $date:
            $row['color'] = "yellowgreen";
            break;
        case $date >= $row['_startdate'] && $date <= $row['_enddate']: //:$row['_startdate'] == $date && $row['_enddate'] <= $date:
            $row['color'] = "skyblue";
            break;
        default:
            $row['color'] = "skyblue";
            break;
    }

    $sched_res[] = $row;
    echo '<script> console.log("' . $row['_startdate'] . '"); </script>';
}


echo '<script> console.log("' . $date . '"); </script>';

?>

<div class="content container-fluid animated fadeIn">
    <div class="container-fluid" id='calendar'></div> <br>
</div>


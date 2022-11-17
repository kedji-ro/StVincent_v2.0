<?php

date_default_timezone_set('Asia/Manila');
$datetime = date('Y-m-d h:i:s', time());
$date = date('Y-m-d');
$time = date('H:i', time());

$schedules = $conn->query("SELECT _id, _title, _startdate, _enddate, _draft FROM `tb_events` WHERE _userID ='" . $_SESSION['st_userid'] . "' AND _draft ='1'");
$sched_res = [];

foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    if ($row['_draft'] != '0') {
        $sdt = new DateTime($row['_startdate']);
        $edt = new DateTime($row['_enddate']);

        $row['title'] = $row['_title'];
        $row['start'] = $sdt->format('Y-m-d');
        $row['end'] = $edt->format('Y-m-d');

        switch ($date) {
            case $row['start'] < $date:
                $row['color'] = "gray";
                break;
            case $row['start'] > $date:
                $row['color'] = "yellowgreen";
                break;
            case $date >= $row['start'] && $date <= $row['end']: //:$row['_startdate'] == $date && $row['_enddate'] <= $date:
                $row['color'] = "skyblue";
                break;
            default:
                $row['color'] = "skyblue";
                break;
        }

        if ($row['_draft'] == '0') {
            $row['color'] = "orange";
        }

        $sched_res[] = $row;
    }
}

?>


<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title" style="margin-bottom:10px;">Calendar of Events/Activities</h4>
                        <a type="button" class="btn btn-info btn-fill btn-wd" style="margin-bottom:10px;" data-toggle="modal" data-target="#requestEvent">
                            <i class="pe-7s-plus fa-lg"></i>
                            Request Event
                        </a>
                        <a type="button" class="btn btn-primary btn-fill btn-wd pull-right" style="margin-bottom:10px;" data-toggle="modal" data-target="#requestedEvents">
                            <i class="pe-7s-look fa-lg"></i>
                            View Requested Events
                        </a>
                        <div class="legend">
                            <i class="fa fa-circle text-muted"></i> PREVIOUS
                            <i class="fa fa-circle text-info"></i> ONGOING
                            <i class="fa fa-circle text-success"></i> UPCOMING
                        </div>
                    </div>
                    <div class="content">
                        <div class="conatiner-fluid" id='calendar'></div> <br>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"> </div>
        </div>
    </div>
</div>

<script>
    function cancelRequest(e_id, user_id) {
        $.ajax({
            type: 'POST',
            url: '../includes/actions/cancel-event.php',
            data: {
                "e_id": e_id,
                "u_id": user_id
            },
            success: function(msg) {
                $.notify({
                    icon: 'pe-7s-info',
                    message: 'Event Request Canceled.'

                }, {
                    type: 'warning',
                    timer: '1000',
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
                $("#reqEvTBDiv").load(location.href + " #reqEventsTable");
                $("#navA").load(location.href + " #navB");
                $("#requestedEvents").modal('hide');
            }
        });
    }

    <?php unset($_SESSION['message']);
          unset($_SESSION['message-type']); ?>
</script>
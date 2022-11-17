<div class="row">
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Search" id="search" onkeyup="searchTable()"></div>
    <div class="col-sm-1"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
    <div class="col-sm-1"><input type="text" class="form-control" placeholder="No." value=""></div>
</div>
<div class="content">
    <div class="row animated fadeIn">
        <div class="table-responsive table-full-width col" id="reqsTableDiv">
            <table class="table table-hover table-striped" id="reqsTable">
                <thead>
                    <th>Action</th>
                    <th>Requested By</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT *, `tb_events`.`_id` AS _eid  FROM `tb_events` INNER JOIN `tb_useracct`ON `tb_useracct`.`_id` = `tb_events`.`_userID`  WHERE _draft != '2' ORDER BY _draft ASC";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        foreach ($query_run as $rows) {
                    ?>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-primary btn-fill btn-xs" title="View/Edit Details"><i class="pe-7s-note fa-lg"></i></button>
                                    <button type="button" class="btn btn-success btn-fill btn-xs conReq" title="Confirm Request" <?php if ($rows['_draft'] == '1') {
                                                                                                                                            echo 'disabled';
                                                                                                                                        }  ?>><i class="pe-7s-check fa-lg"></i></button>
                                </td>
                                <td hidden><?php echo $rows['_eid']; ?></td>
                                <td hidden><?php echo $rows['_userID']; ?></td>
                                <td><?php echo $rows['_fullname']; ?></td>
                                <td><?php echo $rows['_title']; ?></td>
                                <td><?php echo $rows['_body']; ?></td>
                                <td><?php echo $rows['_startdate']; ?></td>
                                <td><?php echo $rows['_enddate']; ?></td>
                                <?php if ($rows['_draft'] == '1') { ?>
                                    <td><i class="fa fa-circle text-success"></i> <?php echo 'Confirmed'; ?></td>
                                <?php } else { ?>
                                    <td><i class="fa fa-circle text-warning"></i> <?php echo 'For Approval'; ?></td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.conReq').on('click', function() {

            $('#approveEvent').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#e_id').val(data[1]);
            $('#u_id').val(data[2]);
            $('#e_t').val(data[4]);
            $('#e_title').html(data[4]);
        });
    });
</script>
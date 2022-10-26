<div class="content">
    <div class="row" style="margin: 10px 0px 10px 0px;">
        <div class="col-sm-3"><input type="text" class="form-control" placeholder="Search" value=""></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
        <div class="col-sm-2"><input type="text" class="form-control" placeholder="No." value=""></div>
    </div>
    <div class="row animated fadeIn">
        <div class="table-responsive table-full-width col">
            <table class="table table-hover table-striped">
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
                $query = "SELECT * FROM `tb_events`";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    foreach ($query_run as $rows) {
                ?>    
                    <tr>
                        <td>
                            <button class="btn btn-primary btn-fill btn-sm"><i class="pe-7s-note fa-lg"></i></button>
                            <button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button>
                        </td>
                        <td><?php echo $rows['_userID']; ?></td>
                        <td><?php echo $rows['_title']; ?></td>
                        <td><?php echo $rows['_body']; ?></td>
                        <td><?php echo $rows['_startdate']; ?></td>
                        <td><?php echo $rows['_enddate']; ?></td>
                        <?php if ($rows['_draft'] == '1') { ?>
                        <td><i class="fa fa-circle text-success"></i> <?php  echo 'Confirmed';?></td>
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
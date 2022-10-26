<div class="content animated fadeIn">
    <div class="row" style="margin: 10px 0px 10px 0px;">
        <div class="col-sm-3"><input type="text" class="form-control" placeholder="Search" value=""></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
        <div class="col-sm-2"><input type="text" class="form-control" placeholder="No." value=""></div>
    </div>
    <div class="row">
        <div class="table-responsive table-full-width col">
            <table class="table table-hover table-striped">
                <thead>
                    <th>Donation ID</th>
                    <th>Donation Type</th>
                    <th>Date/Time Recieved</th>
                    <th>Status</th>
                    <th>Details</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `tb_donation` where _userID =" . $_SESSION['st_userid'];
                    $result = $conn->query($query);

                    while ($row = $result->fetch_array()) { ?>
                        <tr>
                            <td><?php echo $row['_id']; ?></td>
                            <td><?php echo $row['_mop']; ?></td>
                            <td><?php echo $row['_date']; ?></td>
                            <?php if ($row['_status'] == '1') { ?>
                                <td><i class="fa fa-circle text-success"></i> <?php echo 'Recieved'; ?></td>
                            <?php } else { ?>
                                <td><i class="fa fa-circle text-warning"></i> <?php echo 'For Approval'; ?></td>
                            <?php } ?>
                            <td><button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
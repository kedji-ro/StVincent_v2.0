<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Manage Donations</h4>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addDonation"><i class="pe-7s-plus fa-lg"></i></button>
                    </div>
                    <div class="content">
                        <div class="content">
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
                                            <th>Action</th>
                                            <th>Date/Time Recieved</th>
                                            <th>Donor Name</th>
                                            <th>Donation Type</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM `tb_donation`";
                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            foreach ($query_run as $rows) {
                                        ?>                                                
                                            <tr>
                                                <td>
                                                    <button class="btn btn-primary btn-fill btn-sm"><i class="pe-7s-note fa-lg"></i></button>
                                                    <button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button>
                                                </td>
                                                <td><?php echo $rows['_date']; ?></td>
                                                <td><?php echo $rows['_fullname']; ?></td>
                                                <td><?php if ($rows['_type'] == 'M') { echo 'Monetary'; } else { echo 'Goods'; } ?></td>
                                                <?php if ($rows['_status'] == '1') { ?>
                                                <td><i class="fa fa-circle text-success"></i> <?php  echo 'Recieved';?></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-circle text-warning"></i> <?php echo 'Pending'; ?></td>
                                                <?php } ?>
                                                </tr>                                                
                                        <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
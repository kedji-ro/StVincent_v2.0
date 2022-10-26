<?php unset($_SESSION['message']); ?>

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
                                                            <button class="btn btn-primary btn-fill btn-sm" title="View Details"><i class="pe-7s-look fa-lg"></i></button>
                                                            <?php if ($rows['_status'] == '1') { ?>
                                                                <button class="btn btn-secondary btn-fill btn-sm" title="Recieve" disabled><i class="pe-7s-check fa-lg"></i></button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success btn-fill btn-sm" title="Recieve" onclick="recieveDonation(<?php echo $rows['_id']; ?>,<?php echo $rows['_userID']; ?>)"><i class="pe-7s-check fa-lg"></i></button>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $rows['_date']; ?></td>
                                                        <td><?php echo $rows['_fullname']; ?></td>
                                                        <td><?php if ($rows['_type'] == 'M') {
                                                                echo 'Monetary';
                                                            } else {
                                                                echo 'Goods';
                                                            } ?></td>
                                                        <?php if ($rows['_status'] == '1') { ?>
                                                            <td><i class="fa fa-circle text-success"></i> <?php echo 'Recieved'; ?></td>
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

<script>
    function recieveDonation(d_id, user_id) {
        $.ajax({
            type: 'POST',
            url: '../admin/form-actions.php',
            data: {
                "d_id": d_id,
                "u_id" : user_id,
                "recieve_donation": 'true'
            },
            success: function(msg) {
                <?php
                $_SESSION['message'] = '<br> Donation received! <br><br>';
                $_SESSION['message_type'] = 'success';
                ?>
                location.href = '?donation';
                // $("#navB").load(location.href + " #navB");
            }
        });
    }

    <?php unset($_SESSION['message']); ?>
</script>
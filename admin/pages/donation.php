<?php $x = '"'; ?>

<div class="content animated fadeIn">
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>

    <!-- <div class="content animated fadeIn"> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Manage Donations</h4><br>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addDonation"><i class="pe-7s-plus fa-lg"></i> Add Donation</button>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="Search" id="search" onkeyup="searchTable()"></div>
                            <div class="col-sm-1"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
                            <div class="col-sm-1"><input type="text" class="form-control" placeholder="No." value=""></div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="table-responsive table-full-width col" id="tbDiv">
                                    <table class="table table-hover table-striped" id="dTable">
                                        <thead>
                                            <th>Action</th>
                                            <th>Date/Time Recieved</th>
                                            <th>Donor Name</th>
                                            <th>Donation Type</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM `tb_donation` ORDER BY _status, _date desc";
                                            $query_run = mysqli_query($conn, $query);

                                            if ($query_run) {
                                                foreach ($query_run as $rows) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-primary btn-fill btn-xs viewDonationBtn" title="View Details"><i class="pe-7s-search fa-lg"></i></button>
                                                            <?php if ($rows['_status'] == '1') { ?>
                                                                <button class="btn btn-secondary btn-fill btn-xs" title="Recieve" disabled><i class="pe-7s-check fa-lg"></i></button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success btn-fill btn-xs recBtn" title="Recieve"><i class="pe-7s-check fa-lg"></i></button>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php if ($rows['_date'] != '0000-00-00 00:00:00') {
                                                                echo $rows['_date'];
                                                            } ?></td>
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
                                                        <td hidden><?php echo $rows['_datecreated']; ?></td>
                                                        <td hidden><?php if ($rows['_upload'] == '') {
                                                                        echo '../uploads/donations/default.png';
                                                                    } else {
                                                                        echo "../uploads/donations/" . $rows['_upload'];
                                                                    } ?></td>
                                                        <td hidden><?php echo $rows['_bankname']; ?></td>
                                                        <td hidden><?php echo $rows['_checkno']; ?></td>
                                                        <td hidden><?php echo $rows['_amount']; ?></td>
                                                        <td hidden><?php echo $rows['_datecreated']; ?></td>
                                                        <td hidden><?php echo $rows['_remarks']; ?></td>
                                                        <td hidden><?php echo $rows['_itemRefID']; ?></td>
                                                        <td hidden><?php echo $rows['_datecreated']; ?></td>
                                                        <td hidden><?php echo $rows['_userID']; ?></td>
                                                        <td hidden><?php echo $rows['_id']; ?></td>
                                                        <td hidden><?php echo $rows['_mobile']; ?></td>
                                                        <td hidden><?php echo $rows['_address']; ?></td>

                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        $(document).ready(function() {
                                            $('.viewDonationBtn').on('click', function() {

                                                $('#viewDonation').modal('show');

                                                $tr = $(this).closest('tr');

                                                var data = $tr.children("td").map(function() {
                                                    return $(this).text();
                                                }).get();

                                                console.log(data);

                                                $('#donation_no').html(data[15]);
                                                $("#dm_pic").attr("src", data[6]);
                                                $('#dm_type').val(data[3]);
                                                $('#dm_bank').val(data[7]);
                                                $('#dm_checkno').val(data[8]);
                                                $('#dm_qtyam').val(data[9]);
                                                $('#dm_itemno').val(data[12]);
                                                $('#dm_dsent').val(data[5]);
                                                $('#dm_drec').val(data[1]);
                                                $('#dm_remarks').html(data[11]);
                                                $('#dm_name').val(data[2]);
                                                $('#dm_phone').val(data[16]);
                                                $('#dm_address').val(data[17]);

                                            });
                                        });

                                        $(document).ready(function() {

                                            $('.recBtn').on('click', function() {

                                                $('#recieveDonation').modal('show');

                                                $tr = $(this).closest('tr');

                                                var data = $tr.children("td").map(function() {
                                                    return $(this).text();
                                                }).get();

                                                $('#d_id').val(data[15]);
                                                $('#du_id').val(data[14]);
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
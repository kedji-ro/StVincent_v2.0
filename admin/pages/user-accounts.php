<?php unset($_SESSION['message']); ?>

<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Manage User Accounts</h4><br>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addUserAccount"><i class="pe-7s-plus fa-lg"></i> Create Account</button>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="Search" id="search" onkeyup="searchTable()"></div>
                            <div class="col-sm-1"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
                            <div class="col-sm-1"><input type="text" class="form-control" placeholder="No." value=""></div>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="table-responsive table-full-width col">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Action</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM `tb_useracct` ORDER BY `_active` DESC";
                                            $query_run = mysqli_query($conn, $query);

                                            if ($query_run) {
                                                foreach ($query_run as $rows) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-primary btn-fill btn-xs" title="View/Edit Account"><i class="pe-7s-search fa-lg"></i></button>
                                                            <button class="btn btn-<?php if ($rows['_active'] != '1') {echo 'success';} else { echo 'danger';}?> btn-fill btn-xs <?php if ($rows['_active'] != '1') {echo 'aAcc';} else { echo 'dAcc';}?>" title="<?php if ($rows['_active'] != '1') {echo 'Activate Account';} else { echo 'Deactivate Account';}?>"><i class="pe-7s-<?php if ($rows['_active'] != '1') {echo 'check';} else { echo 'close-circle';}?> fa-lg"></i></button>
                                                        </td>
                                                        <td hidden><?php echo $rows['_id']; ?></td>
                                                        <td><?php echo $rows['_fullname']; ?></td>
                                                        <td><?php echo $rows['_username']; ?></td>
                                                        <td><?php echo $rows['_mobile']; ?></td>
                                                        <td><?php echo $rows['_email']; ?></td>
                                                        <td><?php echo $rows['_address']; ?></td>
                                                        <td><i class="fa fa-circle text-<?php if ($rows['_active'] != '1') {echo 'muted';} else {echo 'success';}?>"></i> <?php if ($rows['_active'] == '1') {
                                                                                                            echo 'Active';
                                                                                                        } else {
                                                                                                            echo 'Inactive';
                                                                                                        } ?></td>
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
    $(document).ready(function() {

        $('.dAcc').on('click', function() {

            $('#deactUser').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#us_id').val(data[1]);
            $('#u_name').html(data[2]);
        });
    });

    $(document).ready(function() {

        $('.aAcc').on('click', function() {

            $('#reactUser').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#au_id').val(data[1]);
            $('#au_name').html(data[2]);
        });
    });
</script>
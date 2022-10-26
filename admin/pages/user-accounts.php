<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Manage User Accounts</h4>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addUserAccount"><i class="pe-7s-plus fa-lg"></i></button>
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
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM `tb_useracct`";
                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            foreach ($query_run as $rows) {
                                        ?>                                                
                                            <tr>
                                                <td>
                                                    <button class="btn btn-primary btn-fill btn-sm"><i class="pe-7s-note fa-lg"></i></button>
                                                    <button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button>
                                                </td>
                                                <td><?php echo $rows['_fullname']; ?></td>
                                                <td><?php echo $rows['_username']; ?></td>
                                                <td><?php echo $rows['_mobile']; ?></td>
                                                <td><?php echo $rows['_email']; ?></td>
                                                <td><?php echo $rows['_address']; ?></td>
                                                <td><i class="fa fa-circle text-success"></i> <?php if ($rows['_active'] == '1') { echo 'Active'; } else { echo 'Inactive'; } ?></td>
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
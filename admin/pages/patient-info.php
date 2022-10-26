
<?php unset($_SESSION['message']); ?>

<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Patient Information</h4>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addPatientModal"><i class="pe-7s-plus fa-lg"></i></button>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#printPatientInfo"><i class="pe-7s-print fa-lg"></i></button>
                    </div>
                    <div class="content">
                        <div class="content">
                            <div class="row" style="margin: 10px 0px 10px 0px;">
                                <div class="pull-left"><input type="text" class="form-control" placeholder="Search" value=""></div>
                                <div class="pull-right">
                                    <input type="text" class="form-control" placeholder="No." value="" style="width: 55px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive table-full-width col">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Action</th>
                                            <th>Date of Entry</th>
                                            <th>Full Name</th>
                                            <th>Age</th>
                                            <th>Birthdate</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = "SELECT * FROM `tb_patient`";
                                            $query_run = mysqli_query($conn, $query);
                                            
                                            if ($query_run) {
                                                foreach ($query_run as $rows) {
                                            ?>
                                        
                                            <tr>
                                                <td>
                                                    <button class="btn btn-primary btn-fill btn-sm"><i class="pe-7s-note fa-lg"></i></button>
                                                    <button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button>
                                                </td>
                                                <td><?php echo $rows['_dateentered']; ?></td>
                                                <td><?php echo $rows['_fullname']; ?></td>
                                                <td><?php echo $rows['_age']; ?></td>
                                                <td><?php echo $rows['_birthdate']; ?></td>
                                                <td><i class="fa fa-circle text-success"></i> <?php if($rows['_active'] == '1') { echo 'Active'; } else { echo 'Inactive'; } ?></td>
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
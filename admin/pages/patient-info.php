<?php unset($_SESSION['message']); ?>

<div class="content animated fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="margin-bottom: 10px;">
                        <h4 class="title">Patient Information</h4><br>
                        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addPatientModal"><i class="pe-7s-plus fa-lg"></i> Add Patient</button>
                        <button class="btn btn-secondary btn-fill btn-sm" data-toggle="modal" data-target="#printPatientInfo"><i class="pe-7s-print fa-lg"></i> Print</button>
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
                                            <th>Age</th>
                                            <th>Birthdate</th>
                                            <th>Date of Entry</th>
                                            <th>Date Left/Deceased</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM `tb_patient` ORDER BY `_datedied`, `_active` desc";
                                            $query_run = mysqli_query($conn, $query);

                                            if ($query_run) {
                                                foreach ($query_run as $rows) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-primary btn-fill btn-xs viewPatientInfoBtn" title="View/Edit Patient Info"><i class="pe-7s-search fa-lg"></i></button>
                                                            <button class="btn btn-danger btn-fill btn-xs archivePatientBtn" title="Archive Patient Info" <?php if ($rows['_active'] == '0') {
                                                                                                                                                                echo 'disabled';
                                                                                                                                                            } ?>><i class="pe-7s-box1 fa-lg"></i></button>
                                                        </td>
                                                        <td><?php echo $rows['_fullname'] ?></td>
                                                        <td><?php echo $rows['_age'] ?></td>
                                                        <td><?php echo date("Y-m-d",strtotime($rows['_birthdate'])); ?></td>
                                                        <td><?php echo date("Y-m-d",strtotime($rows['_dateentered'])); ?></td>
                                                        <td><?php echo $rows['_datedied']; ?></td>
                                                        <?php if ($rows['_active'] == '1') { ?>
                                                            <td><i class="fa fa-circle text-<?php echo 'success'; ?>"></i><?php echo 'Active';
                                                                                                                        } else {
                                                                                                                            if (strval($rows['_datedied']) != '') { ?>
                                                            <td><i class="fa fa-circle text-<?php echo 'secondary'; ?>"></i>
                                                            <?php echo 'Deceased';
                                                                                                                            } else { ?>
                                                            <td><i class="fa fa-circle text-<?php echo 'danger'; ?>"></i> <?php echo 'Inactive';
                                                                                                                            }
                                                                                                                        } ?></td>
                                                            <td hidden><?php echo $rows['_surname']; ?></td>
                                                            <td hidden><?php echo $rows['_givenname']; ?></td>
                                                            <td hidden><?php echo $rows['_midname']; ?></td>
                                                            <td hidden><?php echo $rows['_nickname']; ?></td>
                                                            <td hidden><?php echo date("Y-m-d",strtotime($rows['_birthdate'])); ?></td>
                                                            <td hidden><?php echo $rows['_birthplace']; ?></td>
                                                            <td hidden><?php echo $rows['_address']; ?></td>
                                                            <td hidden><?php echo $rows['_education']; ?></td>
                                                            <td hidden><?php echo $rows['_spouse']; ?></td>
                                                            <td hidden><?php echo $rows['_age']; ?></td>
                                                            <td hidden><?php echo $rows['_disable']; ?></td>
                                                            <td hidden><?php echo $rows['_skill']; ?></td>
                                                            <td hidden><?php echo $rows['_relative']; ?></td>
                                                            <td hidden><?php echo $rows['_referral']; ?></td>
                                                            <td hidden><?php echo $rows['_referraladdress']; ?></td>
                                                            <td hidden><?php echo $rows['_referralreason']; ?></td>
                                                            <td hidden><?php echo $rows['_datedied']; ?></td>
                                                            <td hidden><?php echo $rows['_causeofdeath']; ?></td>
                                                            <td hidden><?php echo $rows['_physician']; ?></td>
                                                            <td hidden><?php echo $rows['_dateentered']; ?></td>
                                                            <td hidden><?php echo $rows['_id']; ?></td>
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
                                $('.archivePatientBtn').on('click', function() {

                                    $('#archivePatient').modal('show');

                                    $tr = $(this).closest('tr');
                                    var data = $tr.children("td").map(function() {
                                        return $(this).text();
                                    }).get();

                                    $('#p_id').val(data[23]);
                                });
                            });

                            $(document).ready(function() {
                                $('.viewPatientInfoBtn').on('click', function() {

                                    $('#viewPatientInfo').modal('show');

                                    $tr = $(this).closest('tr');
                                    var data = $tr.children("td").map(function() {
                                        return $(this).text();
                                    }).get();

                                    $('#v_surname').val(data[7]);
                                    $('#v_givenname').val(data[8]);
                                    $('#v_midname').val(data[9]);
                                    $('#v_nickname').val(data[10]);
                                    $('#v_dob').val(data[11]);
                                    $('#v_pob').val(data[12]);
                                    $('#v_address').val(data[13]);
                                    $('#v_religion').val(data[13]);
                                    $('#v_edatt').val(data[14]);
                                    $('#v_spouse').val(data[15]);
                                    $('#v_age').val(data[16]);
                                    $('#v_disability').val(data[17]);
                                    $('#v_skills').val(data[18]);
                                    $('#v_nearest_rel').val(data[19]);
                                    $('#v_referral').val(data[20]);
                                    $('#v_ref_address').val(data[21]);
                                    $('#v_reasons').val(data[22]);
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
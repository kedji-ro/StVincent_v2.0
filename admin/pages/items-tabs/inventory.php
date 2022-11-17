<div class="row">
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Search" id="search" onkeyup="searchTable()"></div>
    <div class="col-sm-1"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
    <div class="col-sm-1"><input type="text" class="form-control" placeholder="No." value=""></div>
</div>
<div class="content animated fadeIn">
    <div class="row">
        <div class="table-responsive table-full-width col">
            <table class="table table-hover table-striped">
                <thead>
                    <th>Action</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Total Stock(s)</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `tb_item`";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        foreach ($query_run as $rows) {
                    ?>
                            <tr>
                                <td>
                                    <button class="btn btn-primary btn-fill btn-xs" title="View/Edit Item"><i class="pe-7s-search fa-lg"></i></button>
                                    <!-- <button class="btn btn-success btn-fill btn-xs"><i class="pe-7s-look fa-lg"></i></button> -->
                                </td>
                                <td><?php echo $rows['_name']; ?></td>
                                <td><?php echo $rows['_desc']; ?></td>
                                <td><?php echo $rows['_stock']; ?></td>
                                <?php if ($rows['_active'] == '1') { ?>
                                    <td><i class="fa fa-circle text-success"></i> <?php echo 'Received'; ?></td>
                                <?php } else { ?>
                                    <td><i class="fa fa-circle text-warning"></i> <?php echo 'To Receive'; ?></td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
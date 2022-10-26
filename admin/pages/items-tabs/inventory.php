<div class="content animated fadeIn">
    <div class="row">
        <button class="btn btn-info btn-fill btn-sm" data-toggle="modal" data-target="#addItem"><i class="pe-7s-plus fa-lg"></i></button>
    </div>
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
                                    <button class="btn btn-primary btn-fill btn-sm"><i class="pe-7s-note fa-lg"></i></button>
                                    <button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button>
                                </td>
                                <td><?php echo $rows['_name']; ?></td>
                                <td><?php echo $rows['_desc']; ?></td>
                                <td><?php echo $rows['_stock']; ?></td>
                                <?php if ($rows['_active'] == '1') { ?>
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
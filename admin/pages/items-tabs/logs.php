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
                    <th>Date</th>
                    <th>Item Name</th>
                    <th>Operation</th>
                    <th>Quantity</th>
                    <th>Event</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `tb_itemlogs`";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        foreach ($query_run as $rows) {
                    ?>
                            <tr>
                                <td>
                                    <button class="btn btn-primary btn-fill btn-sm"><i class="pe-7s-note fa-lg"></i></button>
                                    <button class="btn btn-success btn-fill btn-sm"><i class="pe-7s-look fa-lg"></i></button>
                                </td>
                                <td><?php echo $rows['_datecreated']; ?></td>
                                <td><?php echo $rows['_itemname']; ?></td>
                                <td><?php echo $rows['_operation']; ?></td>
                                <td><?php echo $rows['_qty']; ?></td>
                                <td><?php echo $rows['_eventname']; ?></td>
                                <td><?php echo $rows['_remark']; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
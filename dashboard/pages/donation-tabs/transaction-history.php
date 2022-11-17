<input type="text" class="form-control float-left" placeholder="Search" value="">
<div class="content animated fadeIn">
    <div class="row">
        <div class="table-responsive table-full-width col">
            <table class="table table-hover table-striped">
                <thead>
                    <th>Item Ref No. <br>/ Check No.</th>
                    <th>Type</th>
                    <th>Amount / QTY</th>
                    <th>Date/Time Sent</th>
                    <th>Date/Time Recieved /</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `tb_donation` where _userID ='" . $_SESSION['st_userid'] . "' AND _status = '1' ORDER BY _type desc";
                    $result = $conn->query($query);
                    $total = 0.00;
                    $totalg = 0;
                    while ($row = $result->fetch_array()) { ?>
                        <tr>
                            <td><?php if ($row['_type'] == 'M') {
                                    echo $row['_checkno'];
                                } else {
                                    echo $row['_itemRefID'];
                                } ?></td>
                            <td><?php if ($row['_type'] == 'M') {
                                    echo $row['_mop'];
                                } else {
                                    echo 'Goods';
                                } ?></td>
                            <td><?php if ($row['_type'] == 'M') {
                                    echo "PHP ";
                                }
                                echo $row['_amount']; ?></td>
                            <td><?php echo $row['_datecreated']; ?></td>
                            <td><?php echo $row['_date']; ?></td>
                            <td><?php echo $row['_remarks']; ?></td>
                        </tr>
                    <?php
                        if ($row['_type'] == 'M') {
                            $total += floatval($row['_amount']);
                        } 
                        
                        if ($row['_type'] == 'G') {
                            $totalg += intval($row['_amount']);
                        }
                    } ?>
                </tbody>
            </table>
            <div class="header pull-right">
                <p>Total Goods Sent:<br><span style="font-size: 22pt; font-weight: bold;"><?php $totalg; ?></span></p>
                <p>Total Donations Sent:<br><span style="font-size: 22pt; font-weight: bold;">PHP <?php echo number_format((float)$total, 2, '.', ''); ?></span></p>
            </div>
        </div>
    </div>
</div>
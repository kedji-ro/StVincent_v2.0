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
                    <th>Donation ID</th>
                    <th>Donation Type</th>
                    <th>Date/Time Recieved</th>
                    <th>Status</th>
                    <th>Details</th>
                </thead>
                <tbody>
                    <?php
                    include 'C:\xampp\htdocs\GitHub\StVincent_v2.0\includes\config.php';

                    $query = "SELECT * FROM `tb_donation_lists` INNER JOIN `tb_donation` ON (tb_donation_lists._userID = tb_donation._userID) where tb_donation_lists._userID =". $_SESSION['st_userid'];
                    $result = $conn->query($query);

                    while ($row = $result->fetch_array()) {
                        echo '<tr>
                                    <td>'.$row['_donationID'].'</td>
                                    <td>'.$row['_mop'].'</td>
                                    <td>'.$row['_date'].'</td>
                                    <td>'.$row['_status'].'</td>
                                    <td><button class="btn btn-primary btn-sm"><i class="pe-7s-gift"></i></button></td>
                            </tr>';
                    }
                    ?>
                    <!-- <tr>
                        <td>1</td>
                        <td>Dakota Rice</td>
                        <td>$36,738</td>
                        <td>Niger</td>
                        <td><button class="btn btn-primary btn-sm"><i class="pe-7s-gift"></i></button></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
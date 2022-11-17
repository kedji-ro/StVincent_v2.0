<div class="row">
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Search" id="search" onkeyup="searchTable()"></div>
    <div class="col-sm-1"><label style="font-size:small; text-align:right;">Entries per Page:</label></div>
    <div class="col-sm-1"><input type="text" class="form-control" placeholder="No." value=""></div>
</div>
<div class="content animated fadeIn">
    <div class="row">
        <div class="table-responsive table-full-width col">
            <table class="table table-hover table-striped" id="donations_list">
                <thead>
                    <th>Donation Type</th>
                    <th>Date/Time Sent</th>
                    <th>Date/Time Recieved</th>
                    <th>Status</th>
                    <th class="text-center">View<br>Details</th>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `tb_donation` where _userID ='" . $_SESSION['st_userid'] . "' ORDER BY _status, _datecreated desc";
                    $result = $conn->query($query);

                    while ($row = $result->fetch_array()) { ?>
                        <tr>
                            <td hidden><?php echo $row['_id']; ?></td>
                            <td><?php if ($row['_type'] == 'M') {
                                    echo 'Monetary';
                                } else {
                                    echo 'Goods';
                                } ?></td>
                            <td><?php echo $row['_datecreated']; ?></td>
                            <td><?php if ($row['_status'] == '1') {
                                    echo $row['_date'];
                                } ?></td>
                            <?php if ($row['_status'] == '1') { ?>
                                <td><i class="fa fa-circle text-success"></i> <?php echo 'Recieved'; ?></td>
                            <?php } else { ?>
                                <td><i class="fa fa-circle text-warning"></i> <?php echo 'Sent'; ?></td>
                            <?php } ?>
                            <td class="text-center"><button type="button" class="btn btn-info btn-fill btn-xs viewDonationBtn" title="View Details"><i class="pe-7s-look fa-lg"></i></button></td>
                            <td hidden><?php echo $row['_itemRefID']; ?></td>
                            <td hidden><?php if ($row['_upload'] == '') { echo '../uploads/donations/default.png'; } else {echo "../uploads/donations/". $row['_upload'];} ?></td>
                            <td hidden><?php echo $row['_remarks']; ?></td>
                            <td hidden><?php echo $row['_amount']; ?></td>    
                            <td hidden><?php echo $row['_checkno']; ?></td>
                            <td hidden><?php echo $row['_bankname']; ?></td>        
                        </tr>
                    <?php } ?>
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

                        $('#donation_no').html(data[0]);
                        $("#dm_pic").attr("src", data[7]);
                        $('#dm_type').val(data[1]);
                        $('#dm_bank').val(data[11]);
                        $('#dm_checkno').val(data[10]);
                        $('#dm_qtyam').val(data[9]);
                        $('#dm_itemno').val(data[6]);
                        $('#dm_dsent').val(data[2]);
                        $('#dm_drec').val(data[3]);
                        $('#dm_remarks').html(data[8]);

                    });
                });
            </script>
            
        </div>
    </div>
</div>

<script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("donations_list");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<!-- Request Event Modal -->
<div class="modal fade modal-mini modal-primary" id="requestEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4 class="text-center" style="font-weight: bold;">Create Event Request</h4>
            <hr>
            <div class="modal-body">
                <form action="../includes/actions/request-event.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date From<span style="color:red;"> *</span></label>
                                <input id="date_from" name="date_from" type="date" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date To</label>
                                <input id="date_to" name="date_to" type="date" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title<span style="color:red;"> *</span></label>
                                <input id="event_title" name="event_title" type="text" class="form-control" placeholder="Event Title" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Information<span style="color:red;"> *</span></label>
                                <textarea id="event_info" name="event_info" rows="5" class="form-control" placeholder="Event Information" value=""></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="req_event" name="req_event" class="btn btn-info btn-fill">Send Request</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Change Password Modal -->
<div class="modal fade modal-mini modal-primary" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form action="../includes/actions/change-password.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Old Password<span style="color:red;"> *</span></label>
                                <input type="password" name="cOldPass" id="cOldPass" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>New Password<span style="color:red;"> *</span></label>
                                <input type="password" name="cNewPass" id="cNewPass" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Re-type Password<span style="color:red;"> *</span></label>
                                <input type="password" name="cRePass" id="cRePass" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-fill">Confirm</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Requested Events List Modal -->
<div class="modal fade modal-mini modal-primary" id="requestedEvents" tabindex="-1" role="dialog" aria-labelledby="requestedEvents" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <h4 class="text-center" style="font-weight: bold;">Requested Events</h4>
            <hr>
            <div class="modal-body">
                <div class="container-fluid" style="margin: 10px;">
                    <div class="row">
                        <div class="table-responsive table-full-width col" id="reqEvTBDiv">
                            <table class="table table-hover table-striped" style="border: 0.01em solid; border-color:lightgray;" id="reqEventsTable">
                                <thead>
                                    <th>Title</th>
                                    <th>Information</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Date Requested</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM `tb_events` where _userID =" . $_SESSION['st_userid'] . " AND _draft != '1' ORDER BY _draft asc";
                                    $result = $conn->query($query);

                                    while ($row = $result->fetch_array()) { ?>
                                        <tr>
                                            <td><?php echo $row['_title']; ?></td>
                                            <td><?php echo $row['_body']; ?></td>
                                            <td><?php echo $row['_startdate']; ?></td>
                                            <td><?php echo $row['_enddate']; ?></td>
                                            <td><?php echo $row['_datecreated']; ?></td>
                                            <?php if ($row['_draft'] == '2') { ?>
                                                <td><i class="fa fa-circle text-danger"></i> <?php echo 'Cancelled'; ?></td>
                                            <?php } else { ?>
                                                <td><i class="fa fa-circle text-warning"></i> <?php echo 'For Approval'; ?></td>
                                            <?php } ?>
                                            <td><button type="button" class="btn btn-success btn-fill btn-sm" <?php if ($row['_draft'] != '0') {
                                                                                                                    echo 'disabled';
                                                                                                                } ?> title="Cancel" onclick="cancelRequest(<?php echo $row['_id']; ?>, <?php echo $_SESSION['st_userid']; ?>)"><i class="pe-7s-close fa-lg"></i></button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- View Donation Modal -->
<div class="modal fade modal-mini modal-primary" id="viewDonation" tabindex="-1" role="dialog" aria-labelledby="viewDonation" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Donation No. <span id="donation_no"></span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="" alt="" id="dm_pic" name="dm_pic" style="height: 100%; width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type</label>
                            <input id="dm_type" name="dm_type" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Bank Name</label>
                            <input id="dm_bank" name="dm_bank" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Check No.</label>
                            <input id="dm_checkno" name="dm_checkno" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label id="dml_itemno">Item Ref ID</label>
                            <input id="dm_itemno" name="dm_itemno" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>QTY/Amount</label>
                            <input id="dm_qtyam" name="dm_qtyam" type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Sent</label>
                            <input id="dm_dsent" name="dm_dsent" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Recieved</label>
                            <input id="dm_drec" name="dm_drec" type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea id="dm_remarks" name="dm_remarks" rows="3" class="form-control" readonly></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- <button type="button" id="dm_print" name="dm_print" class="btn btn-info btn-fill"><i class="pe-7s-print fa-lg"></i> Print</button> -->
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->
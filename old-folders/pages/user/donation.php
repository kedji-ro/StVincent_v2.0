<div class="page-title">
    <h4>My Donations</h4>
</div>
 
<div class="animatedParent animateOnce">
    <div class="card mb-0 animated fadeInUpShort"> 

        <div class="primary-tabs responsive-tab-accordion" data-accordion="576">
            <nav class="tab-heading" data-active-tab-center="true">
                <div class="nav nav-tabs" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#my-donationlists" role="tab">
                        My Donation
                    </a> 
                    <a class="nav-item nav-link" data-toggle="tab" href="#add-donation" role="tab">
                        Send Donation
                    </a> 
                    <a class="nav-item nav-link" data-toggle="tab" href="#volunteer" role="tab">
                        Be a Volunteer
                    </a> 
                </div>
            </nav>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="my-donationlists" role="tabpanel">
                    <div class="single-scroller">
                        <table id="table_myalldonation" class="table primary-table table-hover">
                            <thead>
                                <tr>  
                                    <th>Info</th>
                                    <th>Date/Time Received</th> 
                                    <th>Donation Type</th> 
                                    <th>Status</th> 
                                </tr>
                            </thead>
                            <tbody id="get_myalldonation"></tbody> 
                        </table>
                    </div>    
                </div>

                <div class="tab-pane fade" id="add-donation" role="tabpanel">
                    <div class="row">
                        <div class="col-md-8">
                            <input id="mydonation_id" type="text" value="<?php echo $_SESSION['st_userid']; ?>" hidden class="form-control" />
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Type <i style="color: red;">*</i></label>
                                    <select onchange="onchange_type(this.getAttribute('data-id1'))" data-id1="<?php echo $_SESSION['st_userid']; ?>" id="mydonation_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="M">Monetary</option>
                                        <option value="G">Goods</option>
                                    </select> 
                                </div>
                            </div>   
                            <div id="select_goods" class="col-md-12" style="display: none;"> 
                                <div id="get_myalldonation_items"></div>
                            </div>  
                            <div id="select_money" class="col-md-6" style="padding: 0px 18px 0px 18px; display: none;">
                                <div class="form-group">
                                    <label class="form-label">Payment <i style="color: red;">*</i></label>
                                    <select onchange="onchange_payment()" id="mydonation_payment" class="form-control">
                                        <option value="">Select</option>
                                        <option value="C">Cash</option>
                                        <option value="CHK">Check</option>
                                    </select> 
                                </div>
                            </div>     
                            <div id="amount_details" class="col-md-6" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">Amount <i>(Minimun: 100PHP)</i><i style="color: red;"> *</i></label>
                                    <input id="mydonation_amount_cash" type="number" min="100" class="form-control" />
                                </div>
                            </div>   
                            <div id="select_check" class="row" style="padding: 0px 18px 0px 18px; display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-orange">Bank Information</label>
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Amount <i>(Minimun: 100PHP)</i><i style="color: red;"> *</i></label>
                                        <input id="mydonation_amount_check" type="number" min="100" class="form-control" />
                                    </div>
                                </div>  
                                <div class="col-md-8"></div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Bank Name </label>
                                        <input id="mydonation_bankname" type="text" class="form-control" />
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Check Reference No. </label>
                                        <input id="mydonation_checkno" type="text" class="form-control" />
                                    </div>
                                </div>  
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <textarea id="mydonation_remarks" class="form-control" rows="3"></textarea>
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Upload File <i>(JPEG/JPG/PNG)</i></label>
                                    <input id="mydonation_upload" type="file" class="form-control" accept="image/png, image/jpeg, image/jpg" /> 
                                </div> 
                            </div>

                            <div class="col-md-12">
                                <button id="btn_addMyDonation" onclick="btn_addMyDonation()" title="Confirm Donation" type="button" class="btn btn-primary btn-small text-normal">
                                    Confirm Donation
                                </button>  
                            </div> 
                        </div>
                        <div class="col-md-4" style="margin-top: 30px;">
                            <div class="form-group">
                                <label class="form-label text-orange">Bank Details:</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bank Name: RCBC</label><br>
                                <label class="form-label">Account Number: 0123-4567-8910</label><br>  
                                <label class="form-label">Account Name:  St. Vincent Strambi C.P</label>  
                            </div> 
                            <div class="form-group">
                                <label class="form-label">Bank Name: Metrobank</label><br>
                                <label class="form-label">Account Number: 0123-4567-8910</label><br>
                                <label class="form-label">Account Name:  St. Vincent Strambi C.P</label>  
                            </div> 
                            <div class="form-group">
                                <label class="form-label text-orange">GCASH Payment:</label>
                            </div>
                            <div class="form-group"> 
                                <label class="form-label">Account Number: 0912-345-6789</label>  
                                <label class="form-label">Account Name:  St. Vincent Strambi C.P</label>  
                            </div> 
                            <div class="form-group">
                                <label class="form-label text-orange">List of Items/ Goods:</label>
                            </div>
                            <div class="form-group"> 
                                <label class="form-label">NAME - DESCRIPTION</label>    
                            </div> 
                            <div id="get_itemlists" class="form-group"></div> 
                        </div>
                    </div> 
                </div>

                <div class="tab-pane fade" id="volunteer" role="tabpanel">
                    <?php if ($_SESSION['st_volunteer']=='0'): ?>
                        <div id="volunteer-0">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-orange">Basic Information</label>
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" value="<?php echo htmlspecialchars($_SESSION['st_fullname']); ?>" class="form-control" style="background-color: #dddddd;" disabled />
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Age</label>
                                        <input id="uservolunteer_age" type="number" min="1" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Sex <i style="color: red;">*</i></label>
                                        <select id="uservolunteer_sex" class="form-control">
                                            <option value="">Select</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select> 
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Birthdate</label>
                                        <input id="uservolunteer_birthdate" type="date" class="form-control" />
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <textarea id="uservolunteer_address" class="form-control" rows="3"><?php echo htmlspecialchars($_SESSION['st_address']); ?></textarea>
                                    </div>
                                </div> 
                            </div> 
                            <div class="row">  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button id="btn_addUserVolunteer" onclick="btn_addUserVolunteer(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($_SESSION['st_userid']); ?>" title="Make Me as Volunteer" type="button" class="btn btn-primary btn-small text-normal">
                                            Make Me as Volunteer
                                        </button> 
                                    </div> 
                                </div> 
                            </div>
                        </div>
                        <div id="volunteer-1" style="text-align: center;display: none;">  
                            <div class="col-md-12">
                                <label class="form-label" style="color: #18af2b;text-align: center;">
                                    Congratulations! <br>Your account was already added as Volunteer!
                                </label>
                            </div> 
                        </div>
                    <?php else: ?>
                        <div style="text-align: center;">  
                            <div class="col-md-12">
                                <label class="form-label" style="color: #18af2b;text-align: center;">
                                    Congratulations! <br>Your account was already added as Volunteer!
                                </label>
                            </div> 
                        </div>
                    <?php endif; ?> 
                </div>
            </div> 
        </div>

    </div>
</div> 

<!-- Modal ShowMyDonateInfo_Modal -->
<div class="modal fade primary-modal" id="ShowMyDonateInfo_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Donation Information</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div id="get_mydonateinfo" class="row"></div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
        </div>
    </div>
    </div>
</div>
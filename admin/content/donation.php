<div class="page-title">
    <h4>Manage Donations</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">
        <div class="card-header py-2 px-3">
            <h6 class="card-title"></h6>
            <div>
            <button title="Add Donation" class="btn btn-icon small btn-outlined-primary" data-toggle="modal" data-target="#AddDonation_Modal">
                <img src="../old-folders/assets/images/add-primary.svg" alt="" />
            </button>
            </div>
        </div>
        <div class="single-scroller">
            <table id="table_alldonation" class="table primary-table table-hover">
            <thead>
                <tr> 
                    <th scope="col">Action</th>
                    <th scope="col">Date/Time Received</th>
                    <th scope="col">Donor Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Donation Type</th>
                    <th scope="col">Status</th> 
                </tr>
            </thead>
            <tbody id="get_alldonation"></tbody> 
            </table>
        </div>  
    </div>
</div> 

<!-- Modal AddDonation_Modal-->
<div class="modal fade primary-modal" id="AddDonation_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Donation</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../old-folders/assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3 h-80vh">
            <div class="row">  
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label text-orange">Donor's Information</label>
                    </div> 
                </div>  
                <div class="col-md-7">
                    <div class="form-group">
                        <label class="form-label">Donor's Full Name <i style="color: red;">*</i></label>
                        <input id="adddonor_fname" type="text" class="form-control" />
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Mobile</label>
                        <input id="adddonor_mobile" type="number" min="1" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea id="adddonor_address" class="form-control" rows="3"></textarea>
                    </div>
                </div>    
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Type <i style="color: red;">*</i></label>
                        <select onchange="onchange_type()" id="adddonor_type" class="form-control">
                            <option value="">Select</option>
                            <option value="M">Monetary</option>
                            <option value="G">Goods</option>
                        </select> 
                    </div>
                </div>  
                <div class="col-md-6"></div> 

                <div id="select_goods" class="col-md-12" style="display: none;">
                    <div class="alert alert-primary" style="font-style: italic;">
                        Note: You can add list of Items Later.
                    </div>
                </div>  
                <div id="select_money" class="col-md-6" style="padding: 0px 18px 0px 18px; display: none;">
                    <div class="form-group">
                        <label class="form-label">Payment <i style="color: red;">*</i></label>
                        <select onchange="onchange_payment()" id="adddonor_payment" class="form-control">
                            <option value="">Select</option>
                            <option value="C">Cash</option>
                            <option value="CHK">Check</option>
                        </select> 
                    </div>
                </div>   
                <div id="amount_details" class="col-md-6" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Amount <i style="color: red;">*</i></label>
                        <input id="adddonor_amount_cash" type="number" min="1" class="form-control" />
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
                            <label class="form-label">Bank Name <i style="color: red;">*</i></label>
                            <input id="adddonor_bankname" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Check Reference No. <i style="color: red;">*</i></label>
                            <input id="adddonor_checkno" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Amount <i style="color: red;">*</i></label>
                            <input id="adddonor_amount_check" type="number" min="1" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-6"></div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Remarks</label>
                        <textarea id="adddonor_remarks" class="form-control" rows="3"></textarea>
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button id="btn_addDonation" onclick="btn_addDonation()" title="Add Donation" type="button" class="btn btn-primary btn-small text-normal">
                Add Donation
            </button> 
        </div>
    </div>
    </div>
</div>

<!-- Modal CompletedDonor_Modal-->
<div class="modal fade primary-modal" id="CompletedDonor_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Donation</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../old-folders/assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">   
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="completeddonor_id" type="text" class="form-control" hidden/>
                        <label class="form-label text-orange">
                            Note: <br><br>
                            If you choose the "Confirm" button, the amount/goods will be added to inventory.<br><br>
                            Choose "Cancel" button to MOVE this info into Draft.<br><br>
                            You CAN'T redo this process. Do you want to continue?</label> 
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button onclick="btn_cancelDonation()" title="Cancel Donation" type="button" class="btn btn-warning btn-small text-normal">
                Cancel
            </button> 
            <button onclick="btn_confirmDonation()" title="Confirm Donation" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div>

<!-- Modal ShowDonor_Modal -->
<div class="modal fade primary-modal" id="ShowDonor_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Donor's Information</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../old-folders/assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3 h-80vh">
            <div id="get_infodonation" class="row"></div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
        </div>
    </div>
    </div>
</div>

<!-- Modal AddGoods_Modal -->
<div class="modal fade primary-modal" id="AddGoods_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Items/ Goods</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="../old-folders/assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3">
                <!-- <div id="get_infodonation" class="row"></div> -->
                <table class="table primary-table table-hover" style="border: 2px solid #ddd;">
                    <thead>
                        <tr>   
                            <th width=5% hidden>ID</th> 
                            <th width=5% hidden>ItemID</th> 
                            <th>Item Name</th> 
                            <th>Description</th>
                            <th width=15%>QTY</th>
                            <th width=10%>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="donation_id" hidden></td>
                            <td id="item_id" hidden></td>
                            <td id="select_item" contenteditable style="background-color: #f39e4791; font-size: 16px;"></th> 
                            <td id="itemdesc" style="font-size: 16px;"></th> 
                            <td id="select_qty" contenteditable style="background-color: #f39e4791; font-size: 16px;">0</th>  
                            <td>
                                <button id="btn_addItem" onclick="btn_addItem()" title="Add Item" class="btn btn-icon small btn-outlined-primary">
                                    <img src="../old-folders/assets/images/add-primary.svg" alt="">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div> 
        </div>
    </div>
</div> 
<div class="page-title">
    <h4>Manage User Account</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">
        <div class="card-header py-2 px-3">
            <h6 class="card-title"></h6>
            <div>
            <button title="Add User Account" class="btn btn-icon small btn-outlined-primary" data-toggle="modal" data-target="#AddUserAccount_Modal">
                <img src="../old-folders/assets/images/add-primary.svg" alt="" />
            </button>
            </div>
        </div>
        <div class="single-scroller">
            <table id="table_alluseracct" class="table primary-table table-hover">
            <thead>
                <tr> 
                    <th scope="col">Action</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Mobile</th>  
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th> 
                </tr>
            </thead>
            <tbody id="get_alluseracct"></tbody> 
            </table>
        </div>  
    </div>
</div> 

<!-- Modal AddUserAccount_Modal-->
<div class="modal fade primary-modal" id="AddUserAccount_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add User Account</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../old-folders/assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label text-orange">User Information</label>
                    </div> 
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Full Name <i style="color: red;">*</i></label>
                        <input id="adduseracct_fname" type="text" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mobile</label>
                        <input id="adduseracct_mobile" type="text" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email <i style="color: red;">*</i></label>
                        <input id="adduseracct_email" type="text" class="form-control" />
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea id="adduseracct_address" class="form-control" rows="3"></textarea>
                    </div>
                </div>  

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label text-orange">Create User Credential</label>
                    </div> 
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Username <i style="color: red;">*</i></label>
                        <input id="adduseracct_uname" type="text" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Password <i style="color: red;">*</i></label>
                        <input id="adduseracct_pass" type="text" class="form-control" />
                    </div>
                </div> 
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="btn_generatePass()" title="Generate Password" type="button" class="btn btn-warning btn-small text-normal" style="min-width: 50px;">
                <i class="nav-icon fa fa-refresh"></i>
            </button>
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button id="btn_addUserAccount" onclick="btn_addUserAccount()" title="Add User Account" type="button" class="btn btn-primary btn-small text-normal">
                Add User Account
            </button> 
        </div>
    </div>
    </div>
</div>

<!-- Modal EditUserAcct_Modal -->
<div class="modal fade primary-modal" id="EditUserAcct_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit User Account</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../old-folders/assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label text-orange">User Information</label>
                    </div> 
                </div> 
                <input id="edituseracct_id" type="text" class="form-control" hidden />
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Full Name <i style="color: red;">*</i></label>
                        <input id="edituseracct_fname" type="text" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mobile</label>
                        <input id="edituseracct_mobile" type="text" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email <i style="color: red;">*</i></label>
                        <input id="edituseracct_email" type="text" class="form-control" />
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea id="edituseracct_address" class="form-control" rows="3"></textarea>
                    </div>
                </div>   
            </div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button id="btn_editUserAccountConfirm" onclick="btn_editUserAccountConfirm()" title="Confirm" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div>
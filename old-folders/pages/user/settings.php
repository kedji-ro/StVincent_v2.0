<div class="page-title">
    <h4>Settings</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">
    
        <div class="primary-tabs responsive-tab-accordion" data-accordion="576">
            <nav class="tab-heading" data-active-tab-center="true">
                <div class="nav nav-tabs" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#edit-profile" role="tab">
                        Edit Profile
                    </a> 
                </div>
            </nav>

            <div class="tab-content" style="margin-top: 20px;"> 
                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel">  
                    <div class="row col-md-12">
                        <input id="editprofile_id" value="<?php echo htmlspecialchars($_SESSION['st_userid']); ?>" type="text" class="form-control" hidden />
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label class="form-label">Full Name <i style="color: red;">*</i></label>
                                <input id="editprofile_fname" value="<?php echo htmlspecialchars($_SESSION['st_fullname']); ?>" type="text" class="form-control" />
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Username </label>
                                <input value="<?php echo htmlspecialchars($_SESSION['st_username']); ?>" type="text" class="form-control" style="background-color: #dddddd;" disabled />
                            </div>
                        </div>  
                    </div> 
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Mobile</label>
                                <input id="editprofile_mobile" value="<?php echo htmlspecialchars($_SESSION['st_mobile']); ?>" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Email <i style="color: red;">*</i></label>
                                <input id="editprofile_email" value="<?php echo htmlspecialchars($_SESSION['st_email']); ?>" type="text" class="form-control" />
                            </div>
                        </div> 
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Address </label>
                            <textarea id="editprofile_address" rows="8" class="form-control"><?php echo htmlspecialchars($_SESSION['st_address']); ?></textarea>
                        </div>
                    </div>  

                    <div class="col-md-12">
                        <button id="btn_editProfile" onclick="btn_editProfile()" title="Confirm" type="button" class="btn btn-primary btn-small text-normal">
                            Confirm
                        </button>  
                    </div>  
                </div>
            </div> 
        </div>

    </div>
</div>
<header class="header">
    <div class="header-left"> 
        <a href="#" title="St. Vincent Strambi C.P of Home for the Aged" aria-label="Logo" class="horizontal-logo">  
            <p class="text-white text-uppercase">Admin Dashboard</p>
        </a>
    </div>

    <div class="row pe-lg-3">
        <div class="col align-items-center d-flex"></div>
        <div class="col-auto align-items-center d-flex justify-content-end">  
            <div>
              <button title="Assets Information" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="nav-icon fa fa-money" style="color: #333333de;font-size: 40px;"></i>
              </button>
              <div class="alert-dropdown dropdown-menu dropdown-menu-right">
                <p class="alert-header">Remaining Assets</p>
                <ul>   
                  <li>
                    <a href="#" class="dropdown-item"> 
                      <p class="notification">
                        <b>Cash On Hand:</b> <b id="cash_onhand" style="font-size: 15px;color: #e97027;">1,500 PHP</b><br>
                        <b>Cash On Bank:</b> <b id="cash_onbank" style="font-size: 15px;color: #e97027;">1,500 PHP</b>
                      </p>
                    </a>
                  </li>
                </ul> 
                <p class="alert-footer">
                  <a href="#">Total Amount: <b id="cash_total" style="font-size: 18px;color: #e97027;">3,500 PHP</b>
                  </a>
                </p>
              </div>
            </div> 

            <div>
                <button title="User Profile" class="btn btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="../assets/images/user-avatar4.jpg" alt="" /> 
                    <span id="account_name">Hello <?php echo $_SESSION['st_admin_fullname']; ?> !</span>
                </button>
                <div class="user-dropdown dropdown-menu dropdown-menu-right"> 
                    <a href="#ChangeAdminPassword_Modal" class="dropdown-item" data-toggle="modal" data-target="#ChangeAdminPassword_Modal">
                        <i class="user-icon"><img src="../assets/images/key-grey.svg" alt="" /></i>
                        Change Password
                    </a> 

                    <a onclick="btn_AdminLogout()" href="#!" class="dropdown-item">
                        <i class="user-icon">
                        <img src="../assets/images/logout-grey.svg" alt="" />
                        </i>
                        Log out
                    </a>
                </div>
            </div>

            <button title="Menu" type="menu" class="btn btn-icon btn-menu p-2 mr-2">
                <img src="../assets/images/hamburg-light-grey.svg" alt="" />
            </button>
        </div>
    </div>
</header>

<!-- Modal ChangeAdminPassword_Modal -->
<div class="modal fade primary-modal" id="ChangeAdminPassword_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
            <img src="../assets/images/close-white.svg" alt="" />
        </button>
        </div>
        <div class="modal-body mb-n3">
        <div class="row"> 
            <input id="get_sessionID" type="text" value="<?php echo $_SESSION["st_admin_userid"]; ?>" class="form-control" hidden/>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Old Password <i style="color: red;">*</i></label>
                    <input id="old_password" type="password" class="form-control" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">New Password <i style="color: red;">*</i></label>
                    <input id="new_password" type="password" class="form-control" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Re-type Password <i style="color: red;">*</i></label>
                    <input id="retype_password" type="password" class="form-control" />
                </div>
            </div> 
        </div>
        </div>
        <div class="modal-footer">
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>
            <button onclick="btn_adminSavePass()" title="Save" type="button" class="btn btn-primary btn-small text-normal">
                Save
            </button> 
        </div>
    </div>
    </div>
</div>
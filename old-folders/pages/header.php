<header class="header">
    <div class="header-left">
        <a href="#" title="St. Vincent Strambi C.P of Home for the Aged" aria-label="Logo" class="horizontal-logo">
            <p class="text-white text-uppercase">User Dashboard</p>
        </a>
    </div>

    <div class="row pe-sm-3">
        <div class="col align-items-center d-flex"></div>
        <div class="col-auto align-items-center d-flex justify-content-end">
            <div>
                <button title="Notifications" class="btn btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $query = "SELECT COUNT(*) FROM `tb_notifications` WHERE `_user_id`=" . $_SESSION['st_userid'];
                    $result = $conn->query($query);
                    $row_cnt = $result->num_rows;
                    if ($x == 0) {
                        echo '<img src="assets/images/bell-regular.svg" alt="" />';
                    } else {
                        echo '<img src="assets/images/bell-solid.svg" alt="" />';
                    }

                    echo '<span>' . $x . '</span>';
                    ?>
                </button>
                <div class="user-dropdown dropdown-menu dropdown-menu-right">
                    <!-- <?php
                    // include 'includes/config.php';
                    // include 'pages/notification.php';
                    ?> -->
                </div>
            </div>
            <div>
                <button title="User Profile" class="btn btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="assets/images/user-avatar4.jpg" alt="" />
                    <span id="account_name">Hello <?php echo $_SESSION['st_fullname']; ?> !</span>
                </button>
                <div class="user-dropdown dropdown-menu dropdown-menu-right">
                    <a href="#ChangePassword_Modal" class="dropdown-item" data-toggle="modal" data-target="#ChangePassword_Modal">
                        <i class="user-icon"><img src="assets/images/key-grey.svg" alt="" /></i>
                        Change Password
                    </a>

                    <a onclick="btn_logout()" href="#!" class="dropdown-item">
                        <i class="user-icon">
                            <img src="assets/images/logout-grey.svg" alt="" />
                        </i>
                        Log out
                    </a>
                </div>
            </div>

            <button title="Menu" type="menu" class="btn btn-icon btn-menu p-2 mr-2">
                <img src="assets/images/hamburg-light-grey.svg" alt="" />
            </button>
        </div>
    </div>
</header>

<!-- Modal ChangePassword_Modal -->
<div class="modal fade primary-modal" id="ChangePassword_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3">
                <div class="row">
                    <input id="get_sessionID" type="text" value="<?php echo $_SESSION["st_userid"]; ?>" class="form-control" hidden />
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
                <button onclick="btn_savePassword()" title="Save" type="button" class="btn btn-primary btn-small text-normal">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
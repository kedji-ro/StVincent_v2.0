<?php unset($_SESSION['message']); ?>

<div class="content animated fadeIn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form action="form-actions.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name<span style="color:red;"> *</span></label>
                                                <input name="fullname" type="text" class="form-control" placeholder="Full Name" value="<?php echo $_SESSION['st_fullname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" type="text" class="form-control" disabled placeholder="Username" value="<?php echo $_SESSION['st_username']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input name="mobile" type="text" class="form-control" placeholder="Mobile" value="<?php echo $_SESSION['st_mobile']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email<span style="color:red;"> *</span></label>
                                                <input name="email" type="text" class="form-control" placeholder="Email" value="<?php echo $_SESSION['st_email']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" rows="5" class="form-control" placeholder="Address" value=""><?php echo $_SESSION['st_address']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right" value="admin-save" name="admin_save">Save Changes</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
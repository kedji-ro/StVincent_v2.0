<!-- 
------------------------------ MODALS ------------------------------
To easily jump to modals, press CTRL + F (Find) on your text/code 
editor then use the following list of modal identifier as references:

* Change Password Modal
* Add Patient Modal
* Print Patient Info Modal
* Add User Account Modal
* Add Donation Modal
* Add Employee/Volunteer Modal
* Add Item to Inventory Modal

-->

<!-- Change Password Modal -->
<div class="modal fade modal-mini modal-primary" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form action="form-actions.php" method="POST" oninput='sRePass.setCustomValidity(cRePass.value != cNewPass.value ? "Passwords do not match." : "")'>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Old Password<span style="color:red;"> *</span></label>
                                <input type="password" name="cOldPass" id="cOldPass" class="form-control" placeholder="" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>New Password<span style="color:red;"> *</span></label>
                                <input type="password" name="cNewPass" id="cNewPass" class="form-control" placeholder="" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Re-type Password<span style="color:red;"> *</span></label>
                                <input type="password" name="cRePass" id="cRePass" class="form-control" placeholder="" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="change_pass" id="change_pass" class="btn btn-info btn-fill">Confirm</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Add Patient Modal -->
<div class="modal fade modal modal-primary" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="font-weight: bold;">
                Add Patient
            </div>
            <div class="modal-body">
                <div class="header text-center">
                    <p>ST. VINCENT STRAMBI HOME FOR THE AGED, INC.
                        <br>Prk. Mangga Brgy. City Heights
                        <br>General Santos City
                        <br>Tel. No. 552-7500
                    </p>
                    <div class="pull-right">
                        Date of Entry <span style="color: red;">*</span>
                        <input type="date" class="form-control" name="p_dateOfEntry" id="p_dateOfEntry">
                    </div>
                    <br><br><br><br>
                    <p style="font-size: 14pt;">GENERAL INTAKE SHEET</p><br>
                </div>
                <form action="form-actions.php" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Surname<span style="color:red;"> *</span></label>
                                <input type="text" name="p_surname" id="p_surname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Given Name <span style="color: red;">*</span></label>
                                <input type="text" name="p_givenname" id="p_givenname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="p_midname" id="p_midname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nickname</label>
                                <input type="text" name="p_nickname" id="p_nickname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth<span style="color:red;"> *</span></label>
                                <input type="date" name="p_dob" id="p_dob" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Place of Birth<span style="color:red;"> *</span></label>
                                <input type="text" name="p_pob" id="p_pob" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address<span style="color:red;"> *</span></label>
                                <textarea rows="3" name="p_address" id="p_address" class="form-control" placeholder="" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Religion</label>
                                <input type="text" name="p_religion" id="p_religion" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Educational Attainment</label>
                                <input type="text" name="p_edatt" id="p_edatt" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Name of Spouse</label>
                                <input type="text" name="p_spouse" id="p_spouse" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text" name="p_age" id="p_age" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>If Applicant is disabled, indicate nature of disability</label>
                                <input type="text" name="p_disability" id="p_disability" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Skills/Interests</label>
                                <input type="text" name="p_skills" id="p_skills" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name of Nearest Relative</label>
                                <input type="text" name="p_nearest_rel" id="p_nearest_rel" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Source of Referral</label>
                                <input type="text" name="p_referral" id="p_referral" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="p_ref_address" id="p_ref_address" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reason/s</label>
                                <input type="text" name="p_reasons" id="p_reasons" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div><br>
                    <p style="font-size: 14pt;">FAMILY COMPOSITION</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span style="color:red;"> *</span></label>
                                <input type="text" name="p_fam_name" id="p_fam_name" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text" name="p_fam_age" id="p_fam_age" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Sex</label>
                                <input type="text" name="p_fam_sex" id="p_fam_sex" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Relation to Client</label>
                                <input type="text" name="p_fam_rel" id="p_fam_rel" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Civil Status</label>
                                <input type="text" name="p_fam_civstat" id="p_fam_civstat" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Educational Attainment</label>
                                <input type="text" name="p_fam_edatt" id="p_fam_edatt" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" name="p_fam_occ" id="p_fam_occ" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" name="p_fam_comp" id="p_fam_comp" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" name="p_add_fam" id="p_add_fam" class="btn btn-warning btn-fill">Add as Family</button>
                        </div>
                    </div><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_patient" id="add_patient" class="btn btn-info btn-fill">Add Patient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Print Patient Info Modal -->
<div class="modal fade modal-mini modal-primary" id="printPatientInfo" tabindex="-1" role="dialog" aria-labelledby="printPatientInfo" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="font-weight: bold;">
                Print Patient Information
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Filter <span style="color:red;"> *</span></label>
                                <select type="" class="form-control" placeholder="" value="">
                                    <option value="">All Patient</option>
                                    <option value="">Active</option>
                                    <option value="">Inactive</option>
                                    <option value="">Deceased</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer row">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning btn-fill">Reset</button>
                        <button type="button" class="btn btn-info btn-fill">Print Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Add User Account Modal -->
<div class="modal fade modal-mini modal-primary" id="addUserAccount" tabindex="-1" role="dialog" aria-labelledby="addUserAccount" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="font-weight: bold;">
                Add User Account
            </div>
            <div class="modal-body">
                <form action="form-actions.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="font-weight: bold; color:cornflowerblue;">User Information</h5>
                            <div class="form-group">
                                <label>Full Name<span style="color:red;"> *</span></label>
                                <input type="" name="ua_fullname" id="ua_fullname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="" name="ua_mobile" id="ua_mobile" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email<span style="color:red;"> *</span></label>
                                <input type="email" name="ua_email" id="ua_email" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="ua_address" id="ua_address" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div><br>
                    <div clas="row">
                        <h5 style="font-weight: bold; color:cornflowerblue;">Create User Credential</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username<span style="color:red;"> *</span></label>
                                <input type="text" name="ua_user" id="ua_usesr" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password<span style="color:red;"> *</span></label>
                                <input type="password" name="ua_pass" id="ua_pass" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div><br>

                    <div class="modal-footer row">
                        <button type="button" class="btn btn-warning btn-fill"><i class="pe-7s-refresh-2 fa-lg"></i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="create_account" id="create_account" class="btn btn-info btn-fill">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Add Donation Modal -->
<div class="modal fade modal-mini modal-primary" id="addDonation" tabindex="-1" role="dialog" aria-labelledby="addUserAccount" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="font-weight: bold;">
                Add Donation
            </div>
            <div class="modal-body">
                <form action="form-actions.php" method="POST">
                    <div clas="row">
                        <h5 style="font-weight: bold; color:cornflowerblue;">Donor's Information</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Donor's Full Name<span style="color:red;"> *</span></label>
                                <input type="" name="d_fullname" id="d_fullname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="" name="d_mobile" id="d_mobile" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea type="" name="d_address" id="d_address" rows="3" class="form-control" placeholder="" value=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type<span style="color:red;"> *</span></label>
                                <select type="" name="d_type" id="d_type" class="form-control" placeholder="" value="">
                                    <option value="0">Select</option>
                                    <option value="M">Monetary</option>
                                    <option value="G">Goods</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="alert alert-info" hidden>
                                    <span>Note: You can add list of items later.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Payment<span style="color:red;"> *</span></label>
                                <select type="" name="d_payment" id="d_payment" class="form-control" placeholder="" value="">
                                    <option value="0">Select</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Check</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount<span style="color:red;"> *</span></label>
                                <input type="" name="d_amount" id="d_amount" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div clas="row" hidden>
                        <h5 style="font-weight: bold; color:cornflowerblue;">Bank Information</h5>
                    </div>
                    <div class="row" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Name<span style="color:red;"> *</span></label>
                                <input type="" name="d_bankname" id="d_bankname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Check Reference No.<span style="color:red;"> *</span></label>
                                <input type="" name="d_checkno" id="d_checkno" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount<span style="color:red;"> *</span></label>
                                <input type="" name="d_camount" id="d_camount" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea type="" name="d_remarks" id="d_remarks" rows="3" class="form-control" placeholder="" value=""></textarea>
                            </div>
                        </div>
                    </div><br>

                    <div class="modal-footer row">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_donation" id="add_donation" class="btn btn-info btn-fill">Add Donation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Add Employee/Volunteer Modal -->
<div class="modal fade modal-mini modal-primary" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="font-weight: bold;">
                Add Employee/Volunteer
            </div>
            <div class="modal-body">
                <form action="form-actions.php" method="POST">
                    <div clas="row">
                        <h5 style="font-weight: bold; color:cornflowerblue;">Basic Information</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Full Name<span style="color:red;"> *</span></label>
                                <input type="" name="e_fullname" id="e_fullname" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="" name="e_age" id="e_age" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sex</label>
                                <select type="" name="e_sex" id="e_sex" class="form-control" placeholder="" value="">
                                    <option value="0">Select</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" name="e_dob" id="e_dob" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea type="" name="e_address" id="e_address" rows="3" class="form-control" placeholder="" value=""></textarea>
                            </div>
                        </div>
                    </div><br>
                    <div clas="row">
                        <h5 style="font-weight: bold; color:cornflowerblue;">Other Information</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role<span style="color:red;"> *</span></label>
                                <select type="" name="e_role" id="e_role" class="form-control" placeholder="" value="">
                                    <option value="0">Select</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Volunteer">Volunteer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enlist Date<span style="color:red;"> *</span></label>
                                <input type="date" name="e_enlist_date" id="e_enlist_date" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div><br>

                    <div class="modal-footer row">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_employee" id="add_employee" class="btn btn-info btn-fill">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Add Item to Inventory Modal -->
<div class="modal fade modal-mini modal-primary" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="font-weight: bold;">
                Add Item to Inventory
            </div>
            <div class="modal-body">
                <form action="form-actions.php" method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Item Name<span style="color:red;"> *</span></label>
                                <input type="" name="i_name" id="i_name" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quantity<span style="color:red;"> *</span></label>
                                <input type="" name="i_qty" id="i_qty" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="" name="i_des" id="i_des" rows="3" class="form-control" placeholder="" value=""></textarea>
                            </div>
                        </div>
                    </div><br>

                    <div class="modal-footer row">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_item" id="add_item" class="btn btn-info btn-fill">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->
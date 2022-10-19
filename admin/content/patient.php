<div class="page-title">
    <h4>Patient Information</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">
        <div class="card-header py-2 px-3">
            <h6 class="card-title"></h6>
            <div style="display: flex;">
                <button title="Add Patient" class="btn btn-icon small btn-outlined-primary" data-toggle="modal" data-target="#AddPatient_Modal">
                    <img src="../assets/images/add-primary.svg" alt="" />
                </button>
                <button title="Print Patient Information" class="btn btn-icon small btn-outlined-primary" data-toggle="modal" data-target="#PrintPatient_Modal" style="margin-left: 15px;color: #3266a9;"">
                    <i class="nav-icon fa fa-print font-25"></i>
                </button>
            </div> 
        </div>
        <div class="single-scroller">
            <table id="table_allpatient" class="table primary-table table-hover">
            <thead>
                <tr> 
                    <th scope="col">Action</th>
                    <th scope="col">Date of Entry</th>  
                    <th scope="col">Fullname</th>
                    <th scope="col">Age</th> 
                    <th scope="col">Birthdate</th> 
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="get_allpatient"></tbody> 
            </table>
        </div>  
    </div>
</div> 


<!-- Modal AddPatient_Modal-->
<div class="modal fade primary-modal" id="AddPatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Patient</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="../assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3 h-80vh">
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <a class="form-label" style="font-weight: bold;">ST. VINCENT STRAMBI HOME FOR THE AGED, INC.</a><br>
                            <a class="form-label">Prk. Mangga Brgy. City Heights</a><br>
                            <a class="form-label">General Santos City</a><br>
                            <a class="form-label">Tel. No. 552-7500</a><br>
                        </div> 
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Date of Entry <i style="color: red;">*</i></label>
                            <input id="addpatient_dateentered" type="date" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <a class="form-label" style="font-weight: bold;font-size: 18px;">GENERAL INTAKE SHEET</a><br> 
                        </div> 
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Surname </label>
                            <input id="addpatient_surname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Given Name <i style="color: red;">*</i></label>
                            <input id="addpatient_givename" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Middle Name </label>
                            <input id="addpatient_midname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Nickname </label>
                            <input id="addpatient_nickname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input id="addpatient_birthdate" type="date" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Place of Birth</label>
                            <input id="addpatient_birthplace" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea id="addpatient_address" class="form-control" rows="3"></textarea>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Religion</label>
                            <input id="addpatient_religion" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Educational Attainment</label>
                            <input id="addpatient_educ" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Name of Spouse</label>
                            <input id="addpatient_spouse" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input id="addpatient_age" type="number" min="1" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">If Applicant is disabled, indicate nature of disability</label>
                            <input id="addpatient_disable" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Skill/ Interest</label>
                            <input id="addpatient_skill" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Name of Nearest Relative</label>
                            <input id="addpatient_relative" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Source of Referral</label>
                            <input id="addpatient_referral" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input id="addpatient_referraladdress" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Reason/s</label>
                            <input id="addpatient_referralreason" type="text" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group" style="margin-top: 20PX;">
                            <a class="form-label" style="font-weight: bold;font-size: 18px;">FAMILY COMPOSITION</a><br> 
                        </div> 
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Name <i style="color: red;">*</i></label>
                            <input id="addpatient_familyname" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input id="addpatient_familyage" type="number" min="1" class="form-control" />
                        </div>
                    </div>   
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Sex</label>
                            <select id="addpatient_familysex" class="form-control">
                                <option value="">Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Relation to Client</label>
                            <input id="addpatient_familyrelation" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Civil Status</label>
                            <input id="addpatient_familystatus" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Educational Attainment</label>
                            <input id="addpatient_familyeduc" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Occupation</label>
                            <input id="addpatient_familyoccu" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Company Connected</label>
                            <input id="addpatient_familycompany" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <button id="btn_addFamily" onclick="btn_addFamily()" title="Add as Family" type="button" class="btn btn-warning btn-small text-normal">
                                Add as Family
                            </button> 
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer"> 
                <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                    Close
                </button> 
                <button id="btn_addPatient" onclick="btn_addPatient()" title="Add Patient" type="button" class="btn btn-primary btn-small text-normal">
                    Add Patient
                </button> 
            </div>
        </div>
    </div>
</div>

<!-- Modal PrintPatient_Modal -->
<div class="modal fade primary-modal" id="PrintPatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Patient Information</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="../assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3" style="height: 25vh;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Filter <i style="color: red;">*</i></label>
                            <select id="print_filter" class="form-control">
                                <option value="">Select</option>
                                <option value="all">All Patient</option>
                                <option value="a">Active</option>
                                <option value="i">Inactive</option>
                                <option value="d">Deceased</option>
                            </select> 
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer"> 
                <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                    Close
                </button>  
                <button onclick="btn_printPatientReset()" title="Reset" type="button" class="btn btn-warning btn-small text-normal">
                    Reset
                </button> 
                <button id="btn_printPatient" onclick="btn_printPatient()" title="Print Data" type="button" class="btn btn-primary btn-small text-normal">
                    Print Data
                </button> 
            </div>
        </div>
    </div>
</div>


<!-- Modal ShowPatient_Modal -->
<div class="modal fade primary-modal" id="ShowPatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-xl modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Patient Information</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3 h-80vh">
            <div id="get_patientinfo"></div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
        </div>
    </div>
    </div>
</div>

 
<!-- Modal EditPatient_Modal -->
<div class="modal fade primary-modal" id="EditPatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patient</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="../assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3 h-80vh">
                <div class="row"> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Status:</label>
                            <span class="status success">Active</span> 
                            <input id="editpatient_id" type="text" class="form-control" hidden/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <a class="form-label" style="font-weight: bold;">ST. VINCENT STRAMBI HOME FOR THE AGED, INC.</a><br>
                            <a class="form-label">Prk. Mangga Brgy. City Heights</a><br>
                            <a class="form-label">General Santos City</a><br>
                            <a class="form-label">Tel. No. 552-7500</a><br>
                        </div> 
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-10"></div>   
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Date of Entry <i style="color: red;">*</i></label> 
                            <input id="editpatient_dateentered" type="date" class="form-control" />
                        </div>
                    </div>  
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <a class="form-label" style="font-weight: bold;font-size: 18px;">GENERAL INTAKE SHEET</a><br> 
                        </div> 
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Surname </label> 
                            <input id="editpatient_surname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Given Name <i style="color: red;">*</i></label>
                            <input id="editpatient_givenname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Middle Name </label>
                            <input id="editpatient_midname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Nickname </label>
                            <input id="editpatient_nickname" type="text" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input id="editpatient_birthdate" type="date" class="form-control" /> 
                        </div>
                    </div>  
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Place of Birth</label>
                            <input id="editpatient_birthplace" type="text" class="form-control" /> 
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea id="editpatient_address" class="form-control" rows="3"></textarea> 
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Religion</label>
                            <input id="editpatient_religion" type="text" class="form-control" /> 
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Educational Attainment</label>
                            <input id="editpatient_education" type="text" class="form-control" /> 
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Name of Spouse</label>
                            <input id="editpatient_spouse" type="text" class="form-control" />   
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input id="editpatient_age" type="number" class="form-control" /> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">If Applicant is disabled, indicate nature of disability</label>
                            <input id="editpatient_disable" type="text" class="form-control" />    
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Skill/ Interest</label>
                            <input id="editpatient_skill" type="text" class="form-control" />    
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Name of Nearest Relative</label>
                            <input id="editpatient_relative" type="text" class="form-control" />   
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Source of Referral</label>
                            <input id="editpatient_referral" type="text" class="form-control" />    
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input id="editpatient_referraladdress" type="text" class="form-control" />     
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Reason/s</label>
                            <input id="editpatient_referralreason" type="text" class="form-control" />     
                        </div>
                    </div> 
                </div>  
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-top: 20PX;">
                            <a class="form-label" style="font-weight: bold;font-size: 18px;">FAMILY COMPOSITION</a><br> 
                        </div> 
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Name <i style="color: red;">*</i></label>
                            <input id="editpatient_familyname" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input id="editpatient_familyage" type="number" min="1" class="form-control" />
                        </div>
                    </div>   
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Sex</label>
                            <select id="editpatient_familysex" class="form-control">
                                <option value="">Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Relation to Client</label>
                            <input id="editpatient_familyrelation" type="text" class="form-control" />
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Civil Status</label>
                            <input id="editpatient_familystatus" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Educational Attainment</label>
                            <input id="editpatient_familyeduc" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Occupation</label>
                            <input id="editpatient_familyoccu" type="text" class="form-control" />
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Company Connected</label>
                            <input id="editpatient_familycompany" type="text" class="form-control" />
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button id="btn_addFamilyOnEdit" onclick="btn_addFamilyOnEdit()" title="Add as Family" type="button" class="btn btn-warning btn-small text-normal">
                                Add as Family
                            </button> 
                        </div>
                    </div>  
                </div>  
            </div>
            <div class="modal-footer"> 
                <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                    Close
                </button> 
                <button id="btn_editPatientConfirm" onclick="btn_editPatientConfirm()" title="Confirm" type="button" class="btn btn-primary btn-small text-normal">
                    Confirm
                </button> 
            </div>
        </div>
    </div>
</div>


<!-- Modal RemovePatient_Modal-->
<div class="modal fade primary-modal" id="RemovePatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Remove Patient</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">   
                <div class="col-md-12">
                    <div class="form-group"> 
                        <label class="form-label text-orange">
                            Do you want to continue?</label> 
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer" style="padding: 0px 20px 18px;"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
            <button onclick="btn_removePatient()" title="Remove Patient" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div>


<!-- Modal DeceasedPatient_Modal -->
<div class="modal fade primary-modal" id="DeceasedPatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Medical Record / Deceased Patient Information</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">  
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Date </label>
                        <input id="patientaddmed_date" type="date" class="form-control" />
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Remarks <i style="color: red;">*</i></label>
                        <textarea id="patientaddmed_remarks" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group text-right">
                        <button onclick="btn_patientAddMed()" title="Add Medical Record" type="button" class="btn btn-primary btn-small text-normal">
                            Add Medical Record
                        </button> 
                    </div>
                </div>
            </div>
            <hr> 
            <div class="row">   
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Attending Physician </label>
                        <input id="deceased_physician" type="text" class="form-control" />
                    </div>
                </div>   
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Deceased Date <i style="color: red;">*</i></label>
                        <input id="deceased_datedied" type="date" class="form-control" />
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Cause of Death <i style="color: red;">*</i></label>
                        <textarea id="deceased_cause" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="padding: 0px 20px 18px;"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
            <button onclick="btn_deceasedPatient()" title="Deceased Patient" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div>


<!-- Modal RestorePatient_Modal -->
<div class="modal fade primary-modal" id="RestorePatient_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Restore Data from Draft</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">   
                <div class="col-md-12">
                    <div class="form-group"> 
                        <label class="form-label text-orange">
                            Do you want to continue?</label> 
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer" style="padding: 0px 20px 18px;"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
            <button onclick="btn_restorePatient()" title="Restore Data from Draft" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div>

<!-- Modal ShowPatientMedHistory_Modal -->
<div class="modal fade primary-modal" id="ShowPatientMedHistory_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Patient Medical History</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div id="get_patientmedhistory"></div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button>  
        </div>
    </div>
    </div>
</div>
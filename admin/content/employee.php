<div class="page-title">
    <h4>Employee / Volunteer Information</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">
        <div class="card-header py-2 px-3">
            <h6 class="card-title"></h6>
            <div>
            <button title="Add Employee / Volunteer" class="btn btn-icon small btn-outlined-primary" data-toggle="modal" data-target="#AddEmp_Modal">
                <img src="../assets/images/add-primary.svg" alt="" />
            </button>
            </div>
        </div>
        <div class="single-scroller">
            <table id="table_allemp" class="table primary-table table-hover">
                <thead>
                    <tr> 
                        <th scope="col">Action</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Age</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Birthdate</th>
                        <th scope="col">Enlist Date</th>  
                        <th scope="col">Role</th>  
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="get_allemp"></tbody> 
            </table>
        </div>  
    </div>
</div> 

<!-- Modal AddEmp_Modal-->
<div class="modal fade primary-modal" id="AddEmp_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee / Volunteer</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="../assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3 h-80vh">
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label text-orange">Basic Information</label>
                        </div> 
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Full Name <i style="color: red;">*</i></label>
                            <input id="addemp_fname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input id="addemp_age" type="number" min="1" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Sex <i style="color: red;">*</i></label>
                            <select id="addemp_sex" class="form-control">
                                <option value="">Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Birthdate</label>
                            <input id="addemp_birthdate" type="date" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea id="addemp_address" class="form-control" rows="3"></textarea>
                        </div>
                    </div>   

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label text-orange">Other Information</label>
                        </div> 
                    </div>   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Role <i style="color: red;">*</i></label>
                            <select id="addemp_role" class="form-control">
                                <option value="">Select</option>
                                <option value="employee">Employee</option>
                                <option value="volunteer">Volunteer</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enlist Date <i style="color: red;">*</i></label>
                            <input id="addemp_dateenlist" type="date" class="form-control" />
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer"> 
                <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                    Close
                </button> 
                <button id="btn_addEmp" onclick="btn_addEmp()" title="Add Employee / Volunteer" type="button" class="btn btn-primary btn-small text-normal">
                    Confirm
                </button> 
            </div>
        </div>
    </div>
</div>

<!-- Modal EditEmp_Modal -->
<div class="modal fade primary-modal" id="EditEmp_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee / Volunteer</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                    <img src="../assets/images/close-white.svg" alt="" />
                </button>
            </div>
            <div class="modal-body mb-n3 h-80vh">
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label text-orange">Basic Information</label>
                        </div> 
                    </div> 
                    <input id="editemp_id" type="text" class="form-control" hidden />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Full Name <i style="color: red;">*</i></label>
                            <input id="editemp_fname" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input id="editemp_age" type="number" min="1" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Sex <i style="color: red;">*</i></label>
                            <select id="editemp_sex" class="form-control">
                                <option value="">Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Birthdate</label>
                            <input id="editemp_birthdate" type="date" class="form-control" />
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea id="editemp_address" class="form-control" rows="3"></textarea>
                        </div>
                    </div>   

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label text-orange">Other Information</label>
                        </div> 
                    </div>   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Role <i style="color: red;">*</i></label>
                            <select id="editemp_role" class="form-control">
                                <option value="">Select</option>
                                <option value="employee">Employee</option>
                                <option value="volunteer">Volunteer</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enlist Date <i style="color: red;">*</i></label>
                            <input id="editemp_dateenlist" type="date" class="form-control" />
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer"> 
                <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                    Close
                </button> 
                <button id="btn_editEmpConfirm" onclick="btn_editEmpConfirm()" title="Edit Employee / Volunteer" type="button" class="btn btn-primary btn-small text-normal">
                    Confirm
                </button> 
            </div>
        </div>
    </div>
</div>
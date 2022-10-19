<div class="page-title">
    <h4>Manage Inventory</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">

        <div class="primary-tabs responsive-tab-accordion" data-accordion="576">
            <nav class="tab-heading" data-active-tab-center="true">
                <div class="nav nav-tabs" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#inventory" role="tab">
                        Inventory
                    </a> 
                    <a class="nav-item nav-link" data-toggle="tab" href="#logs" role="tab">
                        Logs
                    </a> 
                </div>
            </nav>

            <div class="tab-content" style="margin-top: 20px;">
                <div class="tab-pane fade show active" id="inventory" role="tabpanel">
                    <div class="card-header py-2 px-3">
                        <h6 class="card-title"></h6>
                        <div>
                        <button title="Add Item" class="btn btn-icon small btn-outlined-primary" data-toggle="modal" data-target="#AddItem_Modal">
                            <img src="../assets/images/add-primary.svg" alt="" />
                        </button>
                        </div>
                    </div>
                    <div class="single-scroller">
                        <table id="table_allinventory" class="table primary-table table-hover">
                            <thead>
                                <tr> 
                                    <th scope="col">Action</th> 
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Total Stock(s)</th>  
                                    <th scope="col">Status</th> 
                                </tr>
                            </thead>
                            <tbody id="get_allinventory"></tbody> 
                        </table>
                    </div>  
                </div>

                <div class="tab-pane fade" id="logs" role="tabpanel">
                    <div class="single-scroller">
                        <table class="table primary-table table-hover">
                            <thead>
                                <tr>  
                                    <th scope="col">Date</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Operation</th>
                                    <th scope="col">Quantity</th>   
                                    <th scope="col">Event</th> 
                                    <th scope="col">Remarks</th> 
                                </tr>
                            </thead>
                            <tbody id="get_allinventorylogs"></tbody> 
                        </table>
                    </div>  
                </div>
            </div>
        </div>
        
    </div>
</div> 

<!-- Modal AddItem_Modal -->
<div class="modal fade primary-modal" id="AddItem_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Item to Inventory</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">   
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Item Name <i style="color: red;">*</i></label>
                        <input id="additem_name" type="text" class="form-control" />
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Quantity <i style="color: red;">*</i></label>
                        <input id="additem_qty" type="number" value="0" class="form-control" />
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea id="additem_desc" class="form-control" rows="3"></textarea>
                    </div>
                </div>   
            </div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button id="btn_addItemConfirm" onclick="btn_addItemConfirm()" title="Confirm" type="button" class="btn btn-primary btn-small text-normal">
                Add Item
            </button>  
        </div>
    </div>
    </div>
</div> 

<!-- Modal EditItem_Modal -->
<div class="modal fade primary-modal" id="EditItem_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Item</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">  
                <input id="edititem_id" type="text" class="form-control" hidden />
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Item Name <i style="color: red;">*</i></label>
                        <input id="edititem_name" type="text" class="form-control" />
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea id="edititem_desc" class="form-control" rows="3"></textarea>
                    </div>
                </div>   
            </div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button id="btn_editItemConfirm" onclick="btn_editItemConfirm()" title="Confirm" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div> 

<!-- Modal EditItemQty_Modal -->
<div class="modal fade primary-modal" id="EditItemQty_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Item Quantity</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">   
                <div class="col-md-12">
                    <input id="editqty_id" type="text" class="form-control" hidden />
                    <div class="form-group">
                        <label class="form-label">Item Name </label>
                        <input id="editqty_name" type="text" class="form-control" style="background-color: #dddddd;" disabled />
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Select Operation <i style="color: red;">*</i></label>
                        <select id="editqty_operation" class="form-control">
                            <option value="">Select</option>
                            <option value="add">Add Quantity</option>
                            <option value="sub">Reduce Quantity</option>
                        </select> 
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Quantity <i style="color: red;">*</i></label>
                        <input id="editqty_qty" type="number" value="0" min="1" class="form-control" />
                    </div>
                </div>  
            </div>
            <?php $query = "SELECT * FROM `tb_events` WHERE `_draft`='0' AND `_startdate`>=CURDATE() ORDER BY DATE(`_datecreated`) ASC"; 
                $result = $conn->query($query); 
                $row_cnt = $result->num_rows;  
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Select Event <i style="font-style: italic;font-size: 12px;">(if applicable)</i></label>
                        <select id="editqty_event" class="form-control"> 
                            <?php if ($row_cnt > 0): ?>
                                <option value="">Select</option> 
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <option value="<?php echo htmlspecialchars($row['_id']); ?>"><?php echo htmlspecialchars($row['_title']); ?></option> 
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="">No Added Events</option>
                            <?php endif; ?>
                        </select> 
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Remarks</label> 
                        <textarea id="editqty_remarks" rows="5" class="form-control"></textarea> 
                    </div> 
                </div> 
            </div> 
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button id="btn_editQty" onclick="btn_editQty()" title="Confirm" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button>  
        </div>
    </div>
    </div>
</div> 
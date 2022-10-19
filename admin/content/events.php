<div class="page-title">
    <h4>Calendar of Events/ Activities</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">

        <div class="primary-tabs responsive-tab-accordion" data-accordion="576">
            <nav class="tab-heading" data-active-tab-center="true">
                <div class="nav nav-tabs" role="tablist">
                    <a onclick="btn_reloadEvent()" class="nav-item nav-link active" data-toggle="tab" href="#calendar" role="tab">
                        Calendar
                    </a> 
                    <a class="nav-item nav-link" data-toggle="tab" href="#add-event" role="tab">
                        Add Event
                    </a> 
                    <a class="nav-item nav-link" data-toggle="tab" href="#event-req" role="tab">
                        Event Requests
                    </a> 
                </div>
            </nav> 

            <div style="display: flex;margin-top: 20px;">
                <p style="margin: 10px 15px -10px 15px;">Legend:</p>
                <button class="btn btn-danger" style="font-size: 11px;padding: 10px;">Previous</button>
                <button class="btn btn-info" style="font-size: 11px;padding: 10px;">Ongoing</button>
                <button class="btn btn-success" style="font-size: 11px;padding: 10px;">Upcoming</button>
            </div>  
            <div class="tab-content" style="margin-top: 20px;"> 
                <div class="tab-pane fade show active" id="calendar" role="tabpanel">
                    <div class="col-md-12">
                        <!-- Calendar -->
                        <div class="card acard">
                            <div class="card-body p-lg-4">
                                <div id='calendar' class="text-blue-d1"></div>
                            </div>
                        </div>
                    </div>    
                </div>

                <div class="tab-pane fade" id="add-event" role="tabpanel">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Date From <i style="color: red;">*</i></label>
                                <input id="event_datefrom" type="date" class="form-control" />
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Date To</label>
                                <input id="event_dateto" type="date" class="form-control" />
                            </div>
                        </div> 
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Title <i style="color: red;">*</i></label>
                            <input id="event_title" type="text" class="form-control" />
                        </div>
                    </div>  

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Information <i style="color: red;">*</i></label>
                            <textarea id="event_info" rows="8" class="form-control"></textarea>
                        </div>
                    </div>  

                    <div class="col-md-12">
                        <button id="btn_addEvent" onclick="btn_addEvent()" title="Add Event" type="button" class="btn btn-primary btn-small text-normal">
                            Add Event
                        </button>  
                    </div>  
                </div>

                <div class="tab-pane fade" id="event-req" role="tabpanel">
                    <div class="single-scroller">
                        <table id="table_eventrequests" class="table primary-table table-hover">
                            <thead>
                                <tr> 
                                    <th scope="col">Action</th>
                                    <th scope="col">Requester</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>   
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="get_eventrequests"></tbody> 
                        </table>
                    </div>  
                </div>
            </div> 
        </div>
    
    </div>
</div>


<!-- Modal EventRequest_Modal -->
<div class="modal fade primary-modal" id="EventRequest_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Event Request Status</h5>
            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <img src="../assets/images/close-white.svg" alt="" />
            </button>
        </div>
        <div class="modal-body mb-n3">
            <div class="row">   
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="eventrequest_id" type="text" class="form-control" hidden />
                        <label class="form-label text-orange">
                            Note: <br><br>
                            If you choose the "Confirm" button, Event Request will automatically posted to Calendar of Events.<br><br>
                            Choose "Cancel" button to MOVE this request into Draft.<br><br>
                            You CAN'T redo this process. Do you want to continue?</label> 
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer"> 
            <button title="Close" type="button" class="btn btn-secondary btn-small text-normal" data-dismiss="modal">
                Close
            </button> 
            <button onclick="btn_cancelEventReq()" title="Cancel Event Request" type="button" class="btn btn-warning btn-small text-normal">
                Cancel
            </button> 
            <button onclick="btn_confirmEventReq()" title="Confirm Event Request" type="button" class="btn btn-primary btn-small text-normal">
                Confirm
            </button> 
        </div>
    </div>
    </div>
</div>
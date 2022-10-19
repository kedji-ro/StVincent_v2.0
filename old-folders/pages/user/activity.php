<div class="page-title">
    <h4>Calendar of Events/ Activities</h4>
</div>

<div class="animatedParent animateOnce">
    <div class="table-card card animated fadeInUpShort">

        <div class="primary-tabs responsive-tab-accordion" data-accordion="576">
            <nav class="tab-heading" data-active-tab-center="true">
                <div class="nav nav-tabs" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#calendar" role="tab">
                        Calendar
                    </a> 
                    <a class="nav-item nav-link" data-toggle="tab" href="#request-event" role="tab">
                        Request Event
                    </a> 
                </div>
            </nav>
            
            <div style="display: flex;margin-top: 20px;">
                <p style="margin: 10px 15px -10px 15px;">Legend:</p>
                <button class="btn btn-danger" style="font-size: 11px;padding: 10px;">Previous</button>
                <button class="btn btn-info" style="font-size: 11px;padding: 10px;">Ongoing</button>
                <button class="btn btn-success" style="font-size: 11px;padding: 10px;">Upcoming</button>
            </div> 
            <div class="tab-content">
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

                <div class="tab-pane fade" id="request-event" role="tabpanel">
                    <div class="row col-md-12">
                        <input id="event_userid" type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['st_userid']); ?>" hidden />
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
                        <button id="btn_reqEvent" onclick="btn_reqEvent()" title="Request Event" type="button" class="btn btn-primary btn-small text-normal">
                            Request Event
                        </button>  
                    </div>  
                </div>
            </div> 
        </div>
    
    </div>
</div>
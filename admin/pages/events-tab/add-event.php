<div class="content animated fadeIn">
    <div class="row">
        <form class="col-md-6" action="../admin/form-actions.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date From<span style="color:red;"> *</span></label>
                        <input type="date" name="date_from" id="date_from" class="form-control" placeholder="" value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date To</label>
                        <input type="date" name="date_to" id="date_to" class="form-control" placeholder="" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Title<span style="color:red;"> *</span></label>
                        <input type="text" name="event_title" id="event_title" class="form-control" placeholder="Event Title" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Information<span style="color:red;"> *</span></label>
                        <textarea rows="5" name="event_info" id="event_info" class="form-control" placeholder="Event Information" value=""></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" name="add_event" id="add_event" class="btn btn-info btn-fill pull-left">Add Event</button>
            </div>
        </form>
    </div>
</div>
<form>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>Full Name<span style="color:red;"> *</span></label>
                <input type="text" class="form-control" disabled placeholder="" value="<?php echo $_SESSION['st_fullname']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Sex<span style="color:red;"> *</span></label>
                <select class="form-control form-select">
                    <option selected>Select</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                    <option value="3">Prefer Not To Say</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Birthdate</label>
                <input type="date" class="form-control" placeholder="" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>Address</label>
                <textarea rows="5" class="form-control" placeholder="Address" value=""></textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-info btn-fill pull-left">Make Me a Volunteer</button>
    <div class="clearfix"></div>
</form>
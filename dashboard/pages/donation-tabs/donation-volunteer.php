<div class="content animated fadeIn">
    <?php
    $sql = mysqli_query($conn, "SELECT _volunteer FROM `tb_useracct` WHERE _id = '" . $_SESSION['st_userid'] . "'");
    $row = mysqli_fetch_assoc($sql);
    if ($row['_volunteer'] == '1') { ?>
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-info">This user is already a volunteer.</div>
            </div>
        </div>
    <?php } ?>
    <p>Basic Information</p>
    <form action="../includes/actions/add-volunteer.php" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Full Name<span style="color:red;"> *</span></label>
                    <input name="v_name" id="v_name" type="text" class="form-control" disabled placeholder="" value="<?php echo $_SESSION['st_fullname']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sex<span style="color:red;"> *</span></label>
                    <select name="sex" id="sex" class="form-control form-select" <?php if ($row['_volunteer'] == '1') {echo 'disabled';} ?>>
                        <option selected value="0">Select</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Birthdate</label>
                    <input name="dob" id="dob" type="date" class="form-control" placeholder="" value="" <?php if ($row['_volunteer'] == '1') {echo 'disabled';} ?>>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" id="address" rows="5" class="form-control" placeholder="Address" value="" <?php if ($row['_volunteer'] == '1') {echo 'disabled';} ?>></textarea>
                </div>
            </div>
        </div>

        <button type="submit" id="u_volunteer" name="u_volunteer" class="btn btn-info btn-fill pull-left" <?php if ($row['_volunteer'] == '1') {echo 'disabled';} ?>>Make Me a Volunteer</button>
        <div class="clearfix"></div>
    </form>
</div>
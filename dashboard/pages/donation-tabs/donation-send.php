<div class="content">
    <div class="row">
        <div class="col-md-7">
            <form action="../includes/actions/add-donation.php" method="POST">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Type<span style="color:red;"> *</span></label>
                            <select class="form-control form-select">
                                <option selected>Select</option>
                                <option value="1">Monetary</option>
                                <option value="2">Goods</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" rows="5" class="form-control" placeholder="Remarks" value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Upload Donation Proof/Reciept</label>
                            <input type="file" class="form-control" placeholder="Company" value="09xx">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info btn-fill pull-left">Confirm Donation</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5 pull-left">
            <h4 style="font-weight:bold;">Bank Details:</h4>
            <p>
                <span style="color:gray;">Bank Name:</span> RCBC <br>
                <span style="color:gray;">Account Number:</span> 0123-4567-8910 <br>
                <span style="color:gray;">Account Name:</span> St. Vincent Strambi C.P <br>
                - <br>
                <span style="color:gray;">Bank Name:</span> Metrobank <br>
                <span style="color:gray;">Account Number:</span> 0123-4567-8910 <br>
                <span style="color:gray;">Account Name:</span> St. Vincent Strambi C.P <br>
            </p>
            <h4 style="font-weight:bold;">GCASH Payment:</h4>
            <p>
                <span style="color:gray;">Account Number:</span> 0912-345-6789 <br>
                <span style="color:gray;">Account Name:</span> St. Vincent Strambi C.P <br>
            </p>
        </div>
    </div>
</div>
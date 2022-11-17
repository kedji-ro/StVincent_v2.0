<div class="content animated fadeIn">
    <div class="row">
        <div class="col-md-7">
            <form action="../includes/actions/add-donation.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Type<span style="color:red;"> *</span></label>
                            <select name="d_type" id="d_type" class="form-control form-select">
                                <option selected value="0">Select</option>
                                <option value="M">Monetary</option>
                                <option value="G">Goods</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="payment">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Payment<span style="color:red;"> *</span></label>
                            <select name="p_type" id="p_type" class="form-control form-select">
                                <option selected>Select</option>
                                <option value="Cash">Cash</option>
                                <option value="Check">Check</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="amount">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Amount (Minimun: 100PHP)<span style="color:red;"> *</span></label>
                            <input name="csh_amount" id="csh_amount" type="text" class="form-control" placeholder="" value="">
                        </div>
                    </div>
                </div>
                <div id="bankInfo">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <h5 style="font-weight: bold; color:cornflowerblue;">Bank Information</h5>
                                <label>Amount (Minimun: 100PHP)<span style="color:red;"> *</span></label>
                                <input name="chk_amount" id="chk_amount" type="text" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Bank Name<span style="color:red;"> *</span></label>
                                <input name="bnk" id="bnk" type="text" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Check Reference No.<span style="color:red;"> *</span></label>
                                <input name="check_no" id="check_no" type="text" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" id="remarks" rows="5" class="form-control" placeholder="Remarks" value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Upload</label>
                            <input type="file" name="d_img" id="d_img" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" id="u_donation" name="u_donation" class="btn btn-info btn-fill pull-left">Confirm Donation</button>
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

<script>
    var dtype = document.getElementById("d_type");
    var ptype = document.getElementById("p_type");

    var payment = document.getElementById("payment");
    var bankin = document.getElementById("bankInfo");
    var amount = document.getElementById("amount");

    payment.style.display = "none";
    bankin.style.display = "none";
    amount.style.display = "none";

    document.getElementById("d_type").addEventListener("change", function() {
        if (dtype.value == 'M') {
            payment.style.display = "block";
        } else {
            payment.style.display = "none";
            bankin.style.display = "none";
            amount.style.display = "none";
        }
    });

    document.getElementById("p_type").addEventListener("change", function() {
        if (ptype.value == 'Cash') {
            amount.style.display = "block";
            bankin.style.display = "none";
        } else if (ptype.value == 'Check') {
            amount.style.display = "none";
            bankin.style.display = "block";
        } else {
            amount.style.display = "none";
            bankin.style.display = "none";
        }
    });
</script>
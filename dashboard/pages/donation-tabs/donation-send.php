<div class="content animated fadeIn">
    <div class="row">
        <div class="col-md-7">
            <form action="../includes/actions/add-donation.php" method="POST">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Type<span style="color:red;"> *</span></label>
                            <select name="d_type" id="d_type" class="form-control form-select" onchange="togglePayment()">
                                <option selected value="0">Select</option>
                                <option value="M">Monetary</option>
                                <option value="G">Goods</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="payment" hidden>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Payment<span style="color:red;"> *</span></label>
                            <select name="p_type" id="p_type" class="form-control form-select" onchange="toggleBankInfo()">
                                <option selected>Select</option>
                                <option value="1">Cash</option>
                                <option value="2">Check</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="amount" hidden>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Amount (Minimun: 100PHP)<span style="color:red;"> *</span></label>
                            <input name="csh_amount" id="csh_amount" type="text" class="form-control" placeholder="" value="">
                        </div>
                    </div>
                </div>
                <div id="bankInfo" hidden>
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
                            <input name="d_img" id="d_img" type="file" class="form-control" placeholder="" value="09xx">
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

<script>
    function togglePayment() {
        var x = document.getElementById("payment");
        var y = document.getElementById("d_type");

        if (y.value == 'M') {
            x.style.display = "block";
        } else if (y.value == 'G') {
            x.style.display = "none";
        } else {
            x.style.display = "none";
        }
    }

    function toggleBankInfo() {
        var x = document.getElementById("bankInfo");
        var y = document.getElementById("amount");
        var z = document.getElementById("p_type");

        if (z.value == '2') {
            x.style.display = "block";
            y.style.display = "none";
        } else if (z.value == '1') {
            x.style.display = "none";
            y.style.display = "block";
        } else {
            x.style.display = "none";
            y.style.display = "none";
        }
    }
</script>
<?php require_once('../old-folders/old-folders/includes/config.php'); ?>
<?php if (isset($_SESSION['st_admin_id'])==null): ?> 
    <script>window.location.href = "login.html";</script>
<?php elseif (isset($_SESSION['st_admin_id'])!=null && $_SESSION['st_admin_role']=="admin"): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin Dashboard | St. Vincent Strambi C.P of Home for the Aged</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="St. Vincent Strambi C.P of Home for the Aged">
        <!-- <link rel="shortcut icon" href="../old-folders/assets/images/favicon.ico" /> -->

        <link rel="stylesheet" type="text/css" href="../old-folders/assets/css/main.css">
        <?php if (isset($_GET['activity'])!=null): ?>  
            <link rel="stylesheet" type="text/css" href="../old-folders/assets/css/main.min.css">   
        <?php endif; ?> 
        <!-- Font Awesome -->  
        <link rel="stylesheet" type="text/css" href="../old-folders/assets/vendor/font-awesome-4.7.0/css/font-awesome.min.css" >
        <!-- Pagination -->   
        <link rel="stylesheet" type="text/css" href="../old-folders/assets/css/jquery.bdt.css" >
        <link rel="stylesheet" type="text/css" href="../old-folders/assets/css/jquery.gritter.min.css"> 
        <link rel="stylesheet" type="text/css" href="../old-folders/assets/css/jquery-ui.min.css">  
        <link rel="stylesheet" type="text/css" href="../old-folders/assets/css/custom.css"> 
        <!-- js -->
        <script type="text/javascript" src="../old-folders/old-folders/assets/js/jquery.js"></script> 
        <!-- <script type="text/javascript" src="../old-folders/assets/js/jquery-ui.min.js"></script>  -->
    </head>
    <body>
        <div class="wrapper">
            <?php include_once '../old-folders/pages/header_admin.php'; ?>
            <aside class="sidebar scroller">
                <nav class="main-navigation scroll-wrap"> 
                    <?php include_once '../old-folders/pages/menu_admin.php'; ?>
                </nav>
            </aside> 

            <main class="main-content"> 
                <?php if (isset($_GET['patient'])!=null): include_once 'content/patient.php'; endif; ?>
                <?php if (isset($_GET['account'])!=null): include_once 'content/account.php'; endif; ?>
                <?php if (isset($_GET['donation'])!=null): include_once 'content/donation.php'; endif; ?>
                <?php if (isset($_GET['employee'])!=null): include_once 'content/employee.php'; endif; ?>
                <?php if (isset($_GET['inventory'])!=null): include_once 'content/inventory.php'; endif; ?>
                <?php if (isset($_GET['activity'])!=null): include_once 'content/events.php'; endif; ?>
                <?php if (isset($_GET['settings'])!=null): include_once 'content/settings.php'; endif; ?>
            </main> 
        </div>
        <?php include_once '../pages/footer_admin.php'; ?> 
 
        <script type="text/javascript" src="../old-folders/assets/js/jquery-migrate-3.0.0.min.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="../old-folders/assets/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/css3-animate-it.js"></script>
        <!-- Popper -->
        <script type="text/javascript" src="../old-folders/assets/js/jquery.gritter.min.js"></script> 
        <script type="text/javascript" src="../old-folders/assets/js/popper.min.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/buttons.js"></script>
        <!-- Pagination --> 
        <script type="text/javascript" src="../old-folders/assets/js/jquery.sortelements.js"></script>
        <script type="text/javascript" src="../old-folders/assets/js/jquery.bdt.min.js"></script> 

        <?php if (isset($_GET['activity'])!=null): ?> 
            <script type="text/javascript" src="../old-folders/assets/js/fullcalendar_bootstrap.min.js"></script> 
            <script type="text/javascript" src="../old-folders/assets/js/main.min.js"></script> 
        <?php endif; ?>

        <script type="text/javascript" src="../old-folders/old-folders/assets/js/custom.js"></script> 
 
        <script type="text/javascript"> 
            var getHost = window.location.origin + '/StVincent/';
            // var getHost = window.location.origin + '/';
            get_totalassets();
            get_pendingEvent();

            function get_totalassets(){
                fetch('../old-folders/includes/execute.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/x-www-form-urlencoded'
                    },
                    body: 'data=get_totalassets'
                }).then(function (response) {
                    return response.json();
                }).then(function (data) {   
                    // console.log(data);  
                    document.getElementById("cash_onhand").innerText = data.onhand;
                    document.getElementById("cash_onbank").innerText = data.onbank;
                    document.getElementById("cash_total").innerText = data.total;
                })["catch"](function (error) {
                    console.log(error);  
                    getToast_admin('danger','Internal Error!','Cannot Connect to Server.'); 
                });  
            }

            function btn_adminSavePass(){ 
                var oldpass = document.getElementById("old_password").value.trim();
                var newpass = document.getElementById("new_password").value.trim(); 
                var retypepass = document.getElementById("retype_password").value.trim(); 
                var getSessionID = document.getElementById("get_sessionID").value.trim();
                
                if (oldpass.length > 0 && newpass.length > 0 && retypepass.length > 0) {
                    document.getElementById("old_password").style.borderColor = "";
                    document.getElementById("new_password").style.borderColor = "";
                    document.getElementById("retype_password").style.borderColor = "";

                    if (newpass == retypepass){
                        execute_changepass(oldpass, newpass, getSessionID);  
                    }
                    else{
                        document.getElementById("new_password").style.borderColor = "#e45454";
                        document.getElementById("retype_password").style.borderColor = "#e45454";  
                        getToast_admin('warning','Password Mismatched!','Insert the Password Again.'); 
                    }   
                }
                else{
                    document.getElementById("old_password").style.borderColor = (oldpass.length < 1)? "#e45454" : "";
                    document.getElementById("new_password").style.borderColor = (newpass.length < 1)? "#e45454" : "";
                    document.getElementById("retype_password").style.borderColor = (retypepass.length < 1)? "#e45454" : "";
                    getToast_admin('warning','No Input!','Insert Data on Required Fields.'); 
                } 
            }

            function execute_changepass(oldpass, newpass, getSessionID){
                fetch('../old-folders/includes/execute.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/x-www-form-urlencoded'
                    },
                    body: 'data=admin_changepass'
                    + '&id=' + getSessionID  
                    + '&oldpass=' + oldpass 
                    + '&pass=' + newpass 
                }).then(function (response) {
                    return response.json();
                }).then(function (data) { 
                    // console.log(data) 
                    if (data.status == 1){   
                        document.getElementById("old_password").value = "";
                        document.getElementById("new_password").value = "";
                        document.getElementById("retype_password").value = "";
                        $('#ChangeAdminPassword_Modal').modal('hide');  
                        getToast_admin('success','Success!','Password Successfully Changed.');  
                    }
                    else if (data.status == 2){    
                        document.getElementById("old_password").style.borderColor = "#e45454";
                        document.getElementById("new_password").style.borderColor = "";
                        document.getElementById("retype_password").style.borderColor = "";  
                        getToast_admin('warning','Invalid Password!','Insert the Correct Password.'); 
                    }
                    else{   
                        getToast_admin('danger','Error!','Cannot Connect to Database.'); 
                    }
                })["catch"](function (error) {
                    console.log(error);  
                    getToast_admin('danger','Internal Error!','Cannot Connect to Server.'); 
                });   
            }

            function btn_AdminLogout(){
                fetch('../old-folders/includes/execute.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/x-www-form-urlencoded'
                    },
                    body: 'data=admin_logout'
                }).then(function (response) {
                    return response.json();
                }).then(function (data) { 
                    // console.log(data)  
                    if (data.status == 1){   
                        window.location.reload();    
                    } 
                    else{     
                        getToast_admin('danger','Error!','Please Try Again.'); 
                    }
                })["catch"](function (error) {
                    console.log(error);  
                    getToast_admin('danger','Internal Error!','Cannot Connect to Server.'); 
                });   
            }

            // Get Total Event Requests 
            function get_pendingEvent(){
                var data = $('#form').serializeArray();
                data.push({name: "data", value: "get_pendingevent"});
                
                $.ajax({
                    url: getHost + '/old-folders/old-folders/includes/execute.php',  
                    type : "POST", 
                    data: data,
                }).done(function(data) {  
                    var value = JSON.parse(data);
                    if (value.status!=="0"){
                        document.getElementById("pending_event").innerText = JSON.parse(data).status;
                    } 
                    else{
                        document.getElementById("pending_event").innerText = "";
                    }
                })
            }

            // Generate Password
            function generateCode(passlength = 8){
                var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789{}[]!@#$%^&*()';
                var generated = ""
                var charactersLength = characters.length;

                for ( var i = 0; i < passlength ; i++ ) {
                    generated += characters.charAt(Math.floor(Math.random() * charactersLength));
                } 
                return generated;
            }  
        </script>

        <?php if (isset($_GET['patient'])!=null): ?>
            <script type="text/javascript">
                $(document).ready( function () {
                    $('#table_allpatient').bdt(); 
                }); 

                get_allpatient();

                function get_allpatient(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_allpatient"});
                    
                    $.ajax({
                        url: getHost + '/old-folders/old-folders/includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_allpatient").html(response);
                    })
                }

                function btn_getpatientid(id){
                    localStorage.get_patientid = id; 
                }

                function btn_editPatient(id){ 
                    clear_inputs_familyonedit();
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "modal_geteditpatient",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            document.getElementById("editpatient_id").value = id;  
                            document.getElementById("editpatient_dateentered").value = data.dateentered;  
                            document.getElementById("editpatient_surname").value = data.surname;   
                            document.getElementById("editpatient_givenname").value = data.givenname; 
                            document.getElementById("editpatient_midname").value = data.midname;
                            document.getElementById("editpatient_nickname").value = data.nickname;
                            document.getElementById("editpatient_birthdate").value = data.birthdate; 
                            document.getElementById("editpatient_birthplace").value = data.birthplace;
                            document.getElementById("editpatient_address").value = data.address;
                            document.getElementById("editpatient_religion").value = data.religion;
                            document.getElementById("editpatient_education").value = data.education;
                            document.getElementById("editpatient_spouse").value = data.spouse;
                            document.getElementById("editpatient_age").value = data.age;
                            document.getElementById("editpatient_disable").value = data.disable;
                            document.getElementById("editpatient_skill").value = data.skill;
                            document.getElementById("editpatient_relative").value = data.relative; 
                            document.getElementById("editpatient_referral").value = data.referral; 
                            document.getElementById("editpatient_referraladdress").value = data.referraladdress; 
                            document.getElementById("editpatient_referralreason").value = data.referralreason;   
                        } 
                        else{ 
                            clear_inputs_edit();
                            getToast_admin("warning", "Warning!", "User Account Not Found.");  
                        }   
                    })["catch"](function (error) {
                        console.log(error); 
                        clear_inputs_edit();
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                } 

                function btn_removePatient(){
                    var id = localStorage.get_patientid;  
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_removepatient",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Patient is Inactive."); 
                            get_allpatient();
                            $('#RemovePatient_Modal').modal('hide'); 
                            localStorage.get_patientid = '';
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                } 

                function btn_patientAddMed(){
                   var id = localStorage.get_patientid;
                   var date = document.getElementById("patientaddmed_date").value;
                   var remarks = document.getElementById("patientaddmed_remarks").value; 
                   
                   var PatientAddMed = (function () {
                       function PatientAddMed() {
                           this.id = id; 
                           this.date = date;
                           this.remarks = remarks;
                        }
                        return PatientAddMed;
                    }());
                    var input_patientAddMed= new PatientAddMed();
                    
                    if (id.length > 0 && remarks.length > 0){ 
                        execute_patientaddmed(input_patientAddMed); 
                    } 
                    else{
                        document.getElementById("patientaddmed_remarks").style.borderColor = (remarks.length < 1)? "#e45454" : "";   
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                }

                function execute_patientaddmed(input){
                    document.getElementById("patientaddmed_remarks").style.borderColor = "";   
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_patientaddmed'
                        + '&id=' + input.id    
                        + '&date=' + input.date 
                        + '&remarks=' + input.remarks  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Medical Record Successfully Added.");   
                            document.getElementById("patientaddmed_date").value = "";
                            document.getElementById("patientaddmed_remarks").value = ""; 
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });   
                }

                function btn_deceasedPatient(){
                    var id = localStorage.get_patientid;
                    var physician = document.getElementById("deceased_physician").value;
                    var date = document.getElementById("deceased_datedied").value;
                    var cause = document.getElementById("deceased_cause").value;

                    var DeceasedPatient = (function () {
                        function DeceasedPatient() {
                            this.id = id;
                            this.physician = physician; 
                            this.date = date;
                            this.cause = cause;
                        }
                        return DeceasedPatient;
                    }());
                    var input_DeceasedPatient= new DeceasedPatient();
 
                    if (id.length > 0 && date.length > 0 && cause.length > 0){ 
                        execute_deceasedpatient(input_DeceasedPatient); 
                    } 
                    else{
                        document.getElementById("deceased_datedied").style.borderColor = (date.length < 1)? "#e45454" : "";  
                        document.getElementById("deceased_cause").style.borderColor = (cause.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }  
                }

                function execute_deceasedpatient(input){
                    document.getElementById("deceased_datedied").style.borderColor = "";  
                    document.getElementById("deceased_cause").style.borderColor = ""; 

                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_deceasedpatient'
                        + '&id=' + input.id   
                        + '&physician=' + input.physician  
                        + '&date=' + input.date 
                        + '&cause=' + input.cause  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "RIP!", "Information Has Been Modified."); 
                            get_allpatient();
                            $('#DeceasedPatient_Modal').modal('hide'); 
                            localStorage.get_patientid = '';
                            document.getElementById("deceased_physician").value = "";
                            document.getElementById("deceased_datedied").value = "";
                            document.getElementById("deceased_cause").value = "";
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });   
                }

                function btn_restorePatient(){
                    var id = localStorage.get_patientid;  
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_restorepatient",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Patient Data Restored from Draft."); 
                            get_allpatient();
                            $('#RestorePatient_Modal').modal('hide'); 
                            localStorage.get_patientid = '';
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                }

                function clear_inputs_family(){
                    document.getElementById("addpatient_familyname").value = "";
                    document.getElementById("addpatient_familyage").value = ""; 
                    document.getElementById("addpatient_familysex").value = ""; 
                    document.getElementsByClassName("filter-option-inner-inner")[0].innerText = 'Select' 
                    document.getElementById("addpatient_familyrelation").value = ""; 
                    document.getElementById("addpatient_familystatus").value = "";
                    document.getElementById("addpatient_familyeduc").value = "";   
                    document.getElementById("addpatient_familyoccu").value = ""; 
                    document.getElementById("addpatient_familycompany").value = "";   
                }

                function clear_inputs_familyonedit(){ 
                    document.getElementById("editpatient_familyname").value = "";
                    document.getElementById("editpatient_familyage").value = ""; 
                    document.getElementById("editpatient_familysex").value = ""; 
                    document.getElementsByClassName("filter-option-inner-inner")[2].innerText = 'Select' 
                    document.getElementById("editpatient_familyrelation").value = ""; 
                    document.getElementById("editpatient_familystatus").value = "";
                    document.getElementById("editpatient_familyeduc").value = "";   
                    document.getElementById("editpatient_familyoccu").value = ""; 
                    document.getElementById("editpatient_familycompany").value = "";   
                } 

                function btn_addFamily(){ 
                    var name = document.getElementById("addpatient_familyname").value;
                    var age = document.getElementById("addpatient_familyage").value; 
                    var sex = document.getElementById("addpatient_familysex").value;
                    var relation = document.getElementById("addpatient_familyrelation").value; 
                    var status = document.getElementById("addpatient_familystatus").value;
                    var educ = document.getElementById("addpatient_familyeduc").value;   
                    var occu = document.getElementById("addpatient_familyoccu").value; 
                    var company = document.getElementById("addpatient_familycompany").value; 

                    var AddFamily = (function () {
                        function AddFamily() {
                            this.name = name; 
                            this.age = age;
                            this.sex = sex;
                            this.relation = relation;
                            this.status = status;
                            this.educ = educ; 
                            this.occu = occu;
                            this.company = company; 
                        }
                        return AddFamily;
                    }());
                    var input_AddFamily= new AddFamily();

                    if (name.length > 0){ 
                        execute_addfamily(input_AddFamily); 
                    } 
                    else{
                        document.getElementById("addpatient_familyname").style.borderColor = (name.length < 1)? "#e45454" : "";  
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                } 

                function execute_addfamily(input){
                    document.getElementById("btn_addFamily").disabled = true;
                    document.getElementById("addpatient_familyname").style.borderColor = ""; 
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_addpatientfamily'
                        + '&name=' + input.name   
                        + '&age=' + input.age  
                        + '&sex=' + input.sex 
                        + '&relation=' + input.relation 
                        + '&status=' + input.status  
                        + '&educ=' + input.educ 
                        + '&occu=' + input.occu 
                        + '&company=' + input.company 
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            getToast_admin("success", "Success!", "Patient Family Composition Successfully Added.");
                            clear_inputs_family();   
                        }
                        else if(data.status == 2){
                            getToast_admin("warning", " Duplicate Entry!", "You Have Already Added this Information.");    
                        }
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addFamily").disabled = false; 
                } 

                function btn_addFamilyOnEdit(){
                    var id = document.getElementById("editpatient_id").value;
                    var name = document.getElementById("editpatient_familyname").value;
                    var age = document.getElementById("editpatient_familyage").value; 
                    var sex = document.getElementById("editpatient_familysex").value;
                    var relation = document.getElementById("editpatient_familyrelation").value; 
                    var status = document.getElementById("editpatient_familystatus").value;
                    var educ = document.getElementById("editpatient_familyeduc").value;   
                    var occu = document.getElementById("editpatient_familyoccu").value; 
                    var company = document.getElementById("editpatient_familycompany").value; 

                    var AddFamilyOnEdit = (function () {
                        function AddFamilyOnEdit() {
                            this.id = id;
                            this.name = name; 
                            this.age = age;
                            this.sex = sex;
                            this.relation = relation;
                            this.status = status;
                            this.educ = educ; 
                            this.occu = occu;
                            this.company = company; 
                        }
                        return AddFamilyOnEdit;
                    }());
                    var input_AddFamilyOnEdit= new AddFamilyOnEdit();

                    if (id.length > 0 && name.length > 0){ 
                        execute_addfamilyonedit(input_AddFamilyOnEdit); 
                    } 
                    else{
                        document.getElementById("editpatient_familyname").style.borderColor = (name.length < 1)? "#e45454" : "";  
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                }

                function execute_addfamilyonedit(input){
                    document.getElementById("btn_addFamilyOnEdit").disabled = true;
                    document.getElementById("editpatient_familyname").style.borderColor = ""; 
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_addpatientfamilyonedit'
                        + '&id=' + input.id  
                        + '&name=' + input.name   
                        + '&age=' + input.age  
                        + '&sex=' + input.sex 
                        + '&relation=' + input.relation 
                        + '&status=' + input.status  
                        + '&educ=' + input.educ 
                        + '&occu=' + input.occu 
                        + '&company=' + input.company 
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            getToast_admin("success", "Success!", "Patient Family Composition Successfully Added.");
                            clear_inputs_familyonedit();   
                        }
                        else if(data.status == 2){
                            getToast_admin("warning", " Duplicate Entry!", "You Have Already Added this Information.");    
                        }
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addFamilyOnEdit").disabled = false; 
                }
                
                function btn_addPatient(){  
                    var dateentered = document.getElementById("addpatient_dateentered").value; 
                    var surname = document.getElementById("addpatient_surname").value;
                    var givenname = document.getElementById("addpatient_givename").value;
                    var midname = document.getElementById("addpatient_midname").value;
                    var nickname = document.getElementById("addpatient_nickname").value;
                    var birthdate = document.getElementById("addpatient_birthdate").value;
                    var birthplace = document.getElementById("addpatient_birthplace").value;
                    var address = document.getElementById("addpatient_address").value; 
                    var religion = document.getElementById("addpatient_religion").value;
                    var education = document.getElementById("addpatient_educ").value;
                    var spouse = document.getElementById("addpatient_spouse").value; 
                    var age = document.getElementById("addpatient_age").value; 
                    var disable = document.getElementById("addpatient_disable").value;   
                    var skill = document.getElementById("addpatient_skill").value;   
                    var relative = document.getElementById("addpatient_relative").value; 
                    var referral = document.getElementById("addpatient_referral").value;   
                    var referraladdress = document.getElementById("addpatient_referraladdress").value;   
                    var referralreason = document.getElementById("addpatient_referralreason").value; 

                    var AddPatient = (function () {
                        function AddPatient() {
                            this.dateentered = dateentered; 
                            this.surname = surname; 
                            this.givenname = givenname;
                            this.midname = midname;
                            this.nickname = nickname;
                            this.birthdate = birthdate;
                            this.birthplace = birthplace;  
                            this.address = address;  
                            this.religion = religion; 
                            this.education = education; 
                            this.spouse = spouse;
                            this.age = age;
                            this.disable = disable;
                            this.skill = skill;
                            this.relative = relative;  
                            this.referral = referral;  
                            this.referraladdress = referraladdress;  
                            this.referralreason = referralreason;
                        }
                        return AddPatient;
                    }());
                    var input_AddPatient= new AddPatient();

                    if (dateentered.length > 0 && givenname.length > 0){ 
                        execute_addpatient(input_AddPatient);
                    } 
                    else{
                        document.getElementById("addpatient_dateentered").style.borderColor = (dateentered.length < 1)? "#e45454" : "";   
                        document.getElementById("addpatient_givename").style.borderColor = (givenname.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                } 

                function clear_inputs_add(){
                    document.getElementById("addpatient_dateentered").value = ""; 
                    document.getElementById("addpatient_surname").value = "";
                    document.getElementById("addpatient_givename").value = ""; 
                    document.getElementById("addpatient_midname").value = ""; 
                    document.getElementById("addpatient_nickname").value = "";
                    document.getElementById("addpatient_birthdate").value = "";  
                    document.getElementById("addpatient_birthplace").value = ""; 
                    document.getElementById("addpatient_address").value = "";
                    document.getElementById("addpatient_religion").value = ""; 
                    document.getElementById("addpatient_educ").value = ""; 
                    document.getElementById("addpatient_spouse").value = "";
                    document.getElementById("addpatient_age").value = ""; 
                    document.getElementById("addpatient_disable").value = "";
                    document.getElementById("addpatient_skill").value = ""; 
                    document.getElementById("addpatient_relative").value = ""; 
                    document.getElementById("addpatient_referral").value = "";
                    document.getElementById("addpatient_referraladdress").value = ""; 
                    document.getElementById("addpatient_referralreason").value = "";  
                }

                function clear_inputs_edit(){
                    document.getElementById("editpatient_id").value = "";  
                    document.getElementById("editpatient_dateentered").value = "";  
                    document.getElementById("editpatient_surname").value = "";  
                    document.getElementById("editpatient_givenname").value = "";  
                    document.getElementById("editpatient_midname").value = "";  
                    document.getElementById("editpatient_nickname").value = "";  
                    document.getElementById("editpatient_birthdate").value = "";  
                    document.getElementById("editpatient_birthplace").value = "";  
                    document.getElementById("editpatient_address").value = "";  
                    document.getElementById("editpatient_religion").value = "";  
                    document.getElementById("editpatient_education").value = "";  
                    document.getElementById("editpatient_spouse").value = "";  
                    document.getElementById("editpatient_age").value = "";  
                    document.getElementById("editpatient_disable").value = "";  
                    document.getElementById("editpatient_skill").value = "";  
                    document.getElementById("editpatient_relative").value = "";  
                    document.getElementById("editpatient_referral").value = "";  
                    document.getElementById("editpatient_referraladdress").value = "";  
                    document.getElementById("editpatient_referralreason").value = "";  
                }

                function execute_addpatient(input){
                    document.getElementById("btn_addPatient").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_addpatient'
                        + '&dateentered=' + input.dateentered  
                        + '&surname=' + input.surname   
                        + '&givenname=' + input.givenname  
                        + '&midname=' + input.midname 
                        + '&nickname=' + input.nickname 
                        + '&birthdate=' + input.birthdate  
                        + '&birthplace=' + input.birthplace  
                        + '&address=' + input.address  
                        + '&religion=' + input.religion  
                        + '&education=' + input.education   
                        + '&spouse=' + input.spouse  
                        + '&age=' + input.age 
                        + '&disable=' + input.disable 
                        + '&skill=' + input.skill  
                        + '&relative=' + input.relative  
                        + '&referral=' + input.referral  
                        + '&referraladdress=' + input.referraladdress  
                        + '&referralreason=' + input.referralreason  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        console.log(data); 
                        if (data.status == 1){ 
                            getToast_admin("success", "Success!", "Patient Information Successfully Added."); 
                            clear_inputs_add(); 
                            get_allpatient();
                        }
                        else if(data.status == 2){
                            getToast_admin("warning", " Duplicate Entry!", "You Have Already Added this Patient Information.");    
                        }
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addPatient").disabled = false;
                }  
 
                function btn_editPatientConfirm(){
                    var id = document.getElementById("editpatient_id").value;
                    var dateentered = document.getElementById("editpatient_dateentered").value;
                    var surname = document.getElementById("editpatient_surname").value;
                    var givenname = document.getElementById("editpatient_givenname").value;
                    var midname = document.getElementById("editpatient_midname").value;
                    var nickname = document.getElementById("editpatient_nickname").value;
                    var birthdate = document.getElementById("editpatient_birthdate").value;
                    var birthplace = document.getElementById("editpatient_birthplace").value;
                    var address = document.getElementById("editpatient_address").value;
                    var religion = document.getElementById("editpatient_religion").value;
                    var education = document.getElementById("editpatient_education").value;
                    var spouse = document.getElementById("editpatient_spouse").value;
                    var age = document.getElementById("editpatient_age").value;
                    var disable = document.getElementById("editpatient_disable").value;
                    var skill = document.getElementById("editpatient_skill").value;
                    var relative = document.getElementById("editpatient_relative").value; 
                    var referral = document.getElementById("editpatient_referral").value;
                    var referraladdress = document.getElementById("editpatient_referraladdress").value;
                    var referralreason = document.getElementById("editpatient_referralreason").value; 
                    
                    var EditPatient = (function () {
                        function EditPatient() {
                            this.id = id;
                            this.dateentered = dateentered; 
                            this.surname = surname;
                            this.givenname = givenname;
                            this.midname = midname; 
                            this.nickname = nickname;
                            this.birthdate = birthdate; 
                            this.birthplace = birthplace;
                            this.address = address;  
                            this.religion = religion; 
                            this.education = education;
                            this.spouse = spouse;
                            this.age = age; 
                            this.disable = disable;
                            this.skill = skill; 
                            this.relative = relative;
                            this.referral = referral; 
                            this.referraladdress = referraladdress;
                            this.referralreason = referralreason; 
                        }
                        return EditPatient;
                    }());
                    var input_EditPatient= new EditPatient();
 
                    if (id.length > 0 && dateentered.length > 0 && givenname.length > 0){ 
                        execute_editpatient(input_EditPatient); 
                    } 
                    else{
                        document.getElementById("editpatient_dateentered").style.borderColor = (dateentered.length < 1)? "#e45454" : "";  
                        document.getElementById("editpatient_givenname").style.borderColor = (givenname.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                } 

                function execute_editpatient(input){
                    document.getElementById("btn_editPatientConfirm").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_editpatient'
                        + '&id=' + input.id
                        + '&dateentered=' + input.dateentered   
                        + '&surname=' + input.surname  
                        + '&givenname=' + input.givenname 
                        + '&midname=' + input.midname 
                        + '&nickname=' + input.nickname  
                        + '&birthdate=' + input.birthdate  
                        + '&birthplace=' + input.birthplace 
                        + '&address=' + input.address   
                        + '&religion=' + input.religion
                        + '&education=' + input.education   
                        + '&spouse=' + input.spouse  
                        + '&age=' + input.age 
                        + '&disable=' + input.disable 
                        + '&skill=' + input.skill  
                        + '&relative=' + input.relative  
                        + '&referral=' + input.referral 
                        + '&referraladdress=' + input.referraladdress   
                        + '&referralreason=' + input.referralreason
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Patient Information Successfully Modified.");
                            clear_inputs_edit();
                            $('#EditPatient_Modal').modal('hide'); 
                            get_allpatient();
                        } 
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_editPatientConfirm").disabled = false; 
                } 

                function btn_infoPatient(id){
                    var data = $('#form').serializeArray();
                    data.push(
                        {name: "data", value: "get_patientinfo"},
                        {name: "id", value: id});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) {  
                        $("#get_patientinfo").html(response);
                    })
                }

                function btn_infoPatientMedHistory(id){
                    var data = $('#form').serializeArray();
                    data.push(
                        {name: "data", value: "get_patientmedhistory"},
                        {name: "id", value: id});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) {  
                        $("#get_patientmedhistory").html(response);
                    })
                }

                function btn_printPatientReset(){
                    document.getElementById("print_filter").value = ""; 
                    document.getElementsByClassName("filter-option-inner-inner")[1].innerText = 'Select'; 
                    document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = ""; 
                }

                function btn_printPatient(){
                    var select = document.getElementById("print_filter").value;

                    if (select!=""){
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "";
                        window.open(getHost + 'admin/print.php?s=' + select, '_blank');
                    }
                    else{
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "#e45454";
                        getToast_admin("danger", "Error!", "Select on Required Field.");   
                    } 
                }
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['account'])!=null): ?>
            <script type="text/javascript">  
                $(document).ready( function () {
                    $('#table_alluseracct').bdt(); 
                });
 
                get_alluseracct();

                function get_alluseracct(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_alluseracct"});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_alluseracct").html(response);
                    })
                }

                function btn_generatePass(){ 
                    document.getElementById("adduseracct_pass").value = generateCode();
                }  

                function btn_editUserAcct(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "modal_getedituseracct",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            document.getElementById("edituseracct_id").value = id; 
                            document.getElementById("edituseracct_fname").value = data.fname;
                            document.getElementById("edituseracct_mobile").value = data.mobile;
                            document.getElementById("edituseracct_email").value = data.email;
                            document.getElementById("edituseracct_address").value = data.address;  
                        } 
                        else{ 
                            document.getElementById("edituseracct_id").value = ''; 
                            document.getElementById("edituseracct_fname").value = '';
                            document.getElementById("edituseracct_mobile").value = '';
                            document.getElementById("edituseracct_email").value = '';
                            document.getElementById("edituseracct_address").value = '';  
                            getToast_admin("warning", "Warning!", "User Account Not Found.");  
                        }   
                    })["catch"](function (error) {
                        console.log(error); 
                        document.getElementById("edituseracct_id").value = ''; 
                        document.getElementById("edituseracct_fname").value = '';
                        document.getElementById("edituseracct_mobile").value = '';
                        document.getElementById("edituseracct_email").value = '';
                        document.getElementById("edituseracct_address").value = '';  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }

                function btn_editUserAccountConfirm(){
                    var id = document.getElementById("edituseracct_id").value;
                    var fullname = document.getElementById("edituseracct_fname").value;
                    var mobile = document.getElementById("edituseracct_mobile").value; 
                    var email = document.getElementById("edituseracct_email").value;
                    var address = document.getElementById("edituseracct_address").value;
                    
                    var UserEditAcct = (function () {
                        function UserEditAcct() {
                            this.id = id;
                            this.fullname = fullname; 
                            this.mobile = mobile;
                            this.email = email;
                            this.address = address;
                        }
                        return UserEditAcct;
                    }());
                    var input_UserEditAcct= new UserEditAcct();

                    if (id.length > 0 && fullname.length > 0 && email.length > 0){
                        document.getElementById("btn_editUserAccountConfirm").disabled = true;
                        execute_edituseracct(input_UserEditAcct); 
                    } 
                    else{
                        document.getElementById("edituseracct_fname").style.borderColor = (fullname.length < 1)? "#e45454" : "";
                        document.getElementById("edituseracct_email").style.borderColor = (email.length < 1)? "#e45454" : "";
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }  
                }

                function execute_edituseracct(input){
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_editacct'
                        + '&id=' + input.id
                        + '&fullname=' + input.fullname   
                        + '&mobile=' + input.mobile  
                        + '&email=' + input.email 
                        + '&address=' + input.address  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "User Account Successfully Modified."); 
                            document.getElementById("edituseracct_id").value = '';
                            document.getElementById("edituseracct_fname").value = ''; 
                            document.getElementById("edituseracct_mobile").value = '';
                            document.getElementById("edituseracct_email").value = ''; 
                            document.getElementById("edituseracct_address").value = ''; 
                            $('#EditUserAcct_Modal').modal('hide'); 
                            get_alluseracct();
                        } 
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_editUserAccountConfirm").disabled = false; 
                }

                function btn_addUserAccount(){  
                    var fullname = document.getElementById("adduseracct_fname").value;
                    var mobile = document.getElementById("adduseracct_mobile").value; 
                    var email = document.getElementById("adduseracct_email").value;
                    var address = document.getElementById("adduseracct_address").value; 
                    var username = document.getElementById("adduseracct_uname").value;
                    var password = document.getElementById("adduseracct_pass").value;  

                    var UserAddAcct = (function () {
                        function UserAddAcct() {
                            this.fullname = fullname; 
                            this.mobile = mobile;
                            this.email = email;
                            this.address = address;
                            this.username = username;
                            this.password = password; 
                        }
                        return UserAddAcct;
                    }());
                    var input_UserAddAcct= new UserAddAcct();

                    if (fullname.length > 0 && email.length > 0 && username.length > 0 && password.length > 0){
                        document.getElementById("btn_addUserAccount").disabled = true;
                        execute_adduseracct(input_UserAddAcct);
                    } 
                    else{
                        document.getElementById("adduseracct_fname").style.borderColor = (fullname.length < 1)? "#e45454" : ""; 
                        document.getElementById("adduseracct_email").style.borderColor = (email.length < 1)? "#e45454" : ""; 
                        document.getElementById("adduseracct_uname").style.borderColor = (username.length < 1)? "#e45454" : "";
                        document.getElementById("adduseracct_pass").style.borderColor = (password.length < 1)? "#e45454" : "";
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                }

                function execute_adduseracct(input){
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_addacct'
                        + '&fullname=' + input.fullname   
                        + '&mobile=' + input.mobile  
                        + '&email=' + input.email 
                        + '&address=' + input.address 
                        + '&username=' + input.username  
                        + '&password=' + input.password 
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            // Send Email Verification 
                            fetch('../old-folders/includes/email.php?' + new URLSearchParams({
                                "data": "admincreateuseracct_verification_email",
                                "email": input.email,
                                "token": data.token,
                                "u": data.u,
                                "p": data.p
                            }), {
                                method: 'GET',
                                headers: {
                                    'Accept': 'application/json, text/plain, */*',
                                    'Content-Type': 'application/json'
                                }
                            }).then(function (response) {
                                return response.json();
                            }).then(function (data) { 
                                // console.log(data);
                                if (data.status == 1){
                                    getToast_admin("success", "Success!", "Please check your email to activate your account."); 
                                    document.getElementById("adduseracct_fname").value = '';
                                    document.getElementById("adduseracct_mobile").value = ''; 
                                    document.getElementById("adduseracct_email").value = '';
                                    document.getElementById("adduseracct_address").value = ''; 
                                    document.getElementById("adduseracct_uname").value = '';
                                    document.getElementById("adduseracct_pass").value = '';  
                                    // $('#AddUserAccount_Modal').modal('hide'); 
                                    get_alluseracct();
                                }
                                else if (data.status == 2){ 
                                    getToast_admin("warning", "Warning!", "Token Created but Email Address Not Found.");           
                                } 
                                else{
                                    getToast_admin("danger", "Error!", "Cannot Send Email.");   
                                }   
                            })["catch"](function (error) {
                                console.log(error);
                                getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                            });  
                        }
                        else if(data.status == 2){
                            getToast_admin("warning", "Warning!", "Username/ Email Address Already Taken.");    
                        }
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addUserAccount").disabled = false;
                } 

                function btn_removeUserAcct(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_removeuseracct",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "User Account Disabled."); 
                            get_alluseracct();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                } 

                function btn_restoreUserAcct(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_restoreuseracct",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "User Account Enabled."); 
                            get_alluseracct();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                }
            </script> 
        <?php endif; ?>
 
        <?php if (isset($_GET['donation'])!=null): ?>
            <script type="text/javascript">
                // Item Name and Description AutoComplete
                var ItemName = [];
                var ItemLists_json = '../old-folders/old-folders/assets/json/ItemLists.json';

                $.getJSON(ItemLists_json, function (data) {
                    const obj_data = data;

                    if (obj_data.length > 0) {
                        for (var i = 0; i < obj_data[0].countRow; i++) {
                            var get_itemName= obj_data[i].itemname; 
                            ItemName.push(get_itemName); 
                        }
                    }
                });

                $('#select_item').autocomplete({
                    delay: 0,
                    source: ItemName,
                    appendTo: "#AddGoods_Modal"
                });

                $('#select_item').on('autocompletechange change', function (e) {
                    var inputName = document.getElementById('select_item').innerText;

                    if (inputName.length > 0) {
                        $.getJSON(ItemLists_json, function (item) {
                            const info = item;
                            for (var i = 0; i < info[0].countRow; i++) {
                                if (info[i].itemname === inputName) {
                                    document.getElementById("item_id").innerText = info[i].id;
                                    document.getElementById("itemdesc").innerText = info[i].itemdesc;
                                } 
                            }
                        });
                    }
                    else {
                        document.getElementById("item_id").innerText = -1;
                        document.getElementById("itemdesc").innerText = "";
                        document.getElementById("select_qty").innerText = 0;
                    }
                }).change();
                ///////////////////////////////////////////////////////////////////////

                $(document).ready( function () {
                    $('#table_alldonation').bdt(); 
                }); 

                get_alldonor();

                function get_alldonor(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_alldonor"});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_alldonation").html(response);
                    })
                }

                // Clear Inputs
                function clear_inputs_donation_select(){
                    document.getElementById("adddonor_amount_cash").value = ""; 
                    document.getElementById("adddonor_bankname").value = ""; 
                    document.getElementById("adddonor_checkno").value = "";
                    document.getElementById("adddonor_amount_check").value = ""; 
                }
                function clear_inputs_donation(){ 
                    document.getElementById("adddonor_fname").value = ""; 
                    document.getElementById("adddonor_fname").style.borderColor = "";
                    document.getElementById("adddonor_mobile").value = "";   
                    document.getElementById("adddonor_address").value = "";  
                    document.getElementById("adddonor_type").value = "";  
                    document.getElementById("adddonor_payment").value = ""; 
                    document.getElementById("adddonor_remarks").value = "";  
                    // Cash
                    document.getElementById("adddonor_amount_cash").value = ""; 
                    // Check - Bank Details
                    document.getElementById("adddonor_bankname").value = "";  
                    document.getElementById("adddonor_checkno").value = ""; 
                    document.getElementById("adddonor_amount_check").value = "";  
 
                    document.getElementsByClassName("filter-option-inner-inner")[0].innerText = 'Select';
                    document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
                    document.getElementsByClassName("filter-option-inner-inner")[1].innerText = 'Select';
                    document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "";
                    document.getElementById("select_goods").style.display = "none"; 
                    document.getElementById("select_money").style.display = "none";
                    document.getElementById("select_check").style.display = "none";
                    document.getElementById("amount_details").style.display = "none"; 
                }
                //SELECT TYPE [Money/Goods] ONCHANGE
                function onchange_type() { 
                    clear_inputs_donation_select();
                    var get_type = document.getElementById("adddonor_type").value;   
                    if (get_type != "") {
                        if (get_type == "M") { // Money
                            document.getElementById("select_money").style.display = "";
                            document.getElementById("select_goods").style.display = "none";
                            document.getElementById("amount_details").style.display = "none";
                            document.getElementById("adddonor_payment").value = '';
                            document.getElementsByClassName("filter-option-inner-inner")[1].innerText = 'Select';
                        }
                        else { // Goods
                            document.getElementById("select_money").style.display = "none";
                            document.getElementById("select_goods").style.display = "";
                            document.getElementById("select_check").style.display = "none"; 
                            document.getElementById("amount_details").style.display = "none"; 
                        } 
                    }
                    else { 
                        document.getElementById("select_goods").style.display = "none";
                        document.getElementById("select_money").style.display = "none";
                        document.getElementById("select_check").style.display = "none"; 
                        document.getElementById("amount_details").style.display = "none"; 
                    } 
                } 
                //SELECT PAYMENT [Cash/Check] ONCHANGE
                function onchange_payment(){
                    clear_inputs_donation_select();
                    var get_payment = document.getElementById("adddonor_payment").value; 
                    if (get_payment != "") {
                        if (get_payment == "C") { // Cash
                            document.getElementById("amount_details").style.display = "";
                            document.getElementById("select_check").style.display = "none"; 
                        }
                        else{ // Check
                            document.getElementById("amount_details").style.display = "none";
                            document.getElementById("select_check").style.display = "";  
                        }
                    }
                    else{
                        document.getElementById("amount_details").style.display = "none";
                        document.getElementById("select_check").style.display = "none"; 
                    }
                }

                function btn_addDonation(){  
                    var fullname = document.getElementById("adddonor_fname").value;
                    var mobile = document.getElementById("adddonor_mobile").value;  
                    var address = document.getElementById("adddonor_address").value; 
                    var type = document.getElementById("adddonor_type").value;   
                    var payment = document.getElementById("adddonor_payment").value; 
                    var remarks = document.getElementById("adddonor_remarks").value; 
                    // Cash
                    var amount_cash = document.getElementById("adddonor_amount_cash").value; 
                    // Check - Bank Details
                    var bankname = document.getElementById("adddonor_bankname").value;  
                    var checkno = document.getElementById("adddonor_checkno").value; 
                    var amount_check = document.getElementById("adddonor_amount_check").value;   
                     
                    var AddDonation = (function () {
                        function AddDonation() {
                            this.fullname = fullname;
                            this.mobile = mobile; 
                            this.address = address;
                            this.type = type; 
                            this.payment = payment;
                            this.remarks = remarks;  
                            this.amount_cash = amount_cash;
                            this.bankname = bankname; 
                            this.checkno = checkno;
                            this.amount_check = amount_check; 
                        }
                        return AddDonation;
                    }());
                    var input_AddDonation = new AddDonation();

                    if (fullname.length > 0 && type.length > 0){ 
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
                        if (type == "M"){ // Money
                            if (payment.length > 0) {
                                document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "";
                                if (payment == "C") { // Cash
                                    if (amount_cash.length > 0){
                                        document.getElementById("adddonor_amount_cash").style.borderColor = "";
                                        execute_adddonation(input_AddDonation);
                                    }
                                    else{
                                        document.getElementById("adddonor_amount_cash").style.borderColor = (amount_cash.length < 1)? "#e45454" : "";
                                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                                    }
                                }
                                else{ // Check
                                    if (bankname.length > 0 && checkno.length > 0 && amount_check.length > 0){
                                        document.getElementById("adddonor_bankname").style.borderColor = "";
                                        document.getElementById("adddonor_checkno").style.borderColor = "";
                                        document.getElementById("adddonor_amount_check").style.borderColor = "";
                                        execute_adddonation(input_AddDonation);
                                    }
                                    else{
                                        document.getElementById("adddonor_bankname").style.borderColor = (bankname.length < 1)? "#e45454" : "";
                                        document.getElementById("adddonor_checkno").style.borderColor = (checkno.length < 1)? "#e45454" : "";
                                        document.getElementById("adddonor_amount_check").style.borderColor = (amount_check.length < 1)? "#e45454" : "";
                                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                                    } 
                                } 
                            }
                            else{
                                document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = (payment.length < 1)? "#e45454" : "";
                                getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                            }
                        }
                        else{ // Goods
                            execute_adddonation(input_AddDonation);
                        } 
                    } 
                    else{
                        document.getElementById("adddonor_fname").style.borderColor = (fullname.length < 1)? "#e45454" : "";
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = (type.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                }  

                function execute_adddonation(input){
                    document.getElementById("btn_addDonation").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_adddonation' 
                        + '&fullname=' + input.fullname   
                        + '&mobile=' + input.mobile  
                        + '&address=' + input.address 
                        + '&type=' + input.type 
                        + '&payment=' + input.payment  
                        + '&remarks=' + input.remarks 
                        + '&amount_cash=' + input.amount_cash 
                        + '&bankname=' + input.bankname  
                        + '&checkno=' + input.checkno 
                        + '&amount_check=' + input.amount_check 
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            getToast_admin("success", "Success!", "Donor Successfully Added."); 
                            clear_inputs_donation(); 
                            get_alldonor();
                        } 
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addDonation").disabled = false;
                } 
                
                function btn_infoDonor(id){
                    var data = $('#form').serializeArray();
                    data.push(
                        {name: "data", value: "get_infodonor"},
                        {name: "id", value: id});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) {  
                        $("#get_infodonation").html(response);
                    })
                }

                function btn_addGoods(id){
                    document.getElementById("donation_id").innerText = id; 
                    // Quantity Filter - Only Numeric
                    $('#select_qty').keypress(function (e) {
                        var x = event.charCode || event.keyCode;
                        if (isNaN(String.fromCharCode(e.which)) && x != 46 || x === 32 || x === 13 || (x === 46 && event.currentTarget.innerText.includes('.'))) {
                            e.preventDefault();
                        } 
                    });
                }

                function btn_completedDonor(id){
                    document.getElementById("completeddonor_id").value = id;  
                }

                function btn_cancelDonation(){
                    var id = document.getElementById("completeddonor_id").value;

                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_canceldonation",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Donation Has Been Cancelled."); 
                            $('#CompletedDonor_Modal').modal('hide'); 
                            get_alldonor();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }

                function btn_confirmDonation(){
                    var id = document.getElementById("completeddonor_id").value;
                    
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_confirmdonation",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Donation Has Been Received."); 
                            $('#CompletedDonor_Modal').modal('hide'); 
                            get_alldonor();
                            get_totalassets();
                        }
                        else if (data.status == 2){
                            getToast_admin("danger", "Error!", "Donation Not Found.");    
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }

                function btn_addItem(){
                    var donationid = document.getElementById("donation_id").innerText;
                    var itemid = document.getElementById("item_id").innerText;
                    var itemname = document.getElementById("select_item").innerText;
                    var qty = document.getElementById("select_qty").innerText;
                    
                    var AddItem = (function () {
                        function AddItem() {
                            this.donationid = donationid; 
                            this.itemid = itemid;
                            this.itemname = itemname; 
                            this.qty = qty;
                        }
                        return AddItem;
                    }());
                    var input_AddItem = new AddItem();

                    if (donationid > 0 && itemid > 0 && itemname.length > 0 && qty > 0){
                        execute_additem(input_AddItem);
                    }
                    else{
                        document.getElementById("select_item").style.backgroundColor = (itemname.length < 1)? "rgb(255 212 212)" : "#f39e4791";
                        document.getElementById("select_qty").style.backgroundColor = (qty < 1)? "rgb(255 212 212)" : "#f39e4791";
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }
                }
                
                function execute_additem(input){
                    document.getElementById("select_item").style.backgroundColor = "#f39e4791";
                    document.getElementById("select_qty").style.backgroundColor = "#f39e4791";
                    document.getElementById("btn_addItem").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_additem'
                        + '&id=' + input.donationid
                        + '&itemid=' + input.itemid   
                        + '&itemname=' + input.itemname  
                        + '&qty=' + input.qty 
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            document.getElementById("item_id").innerText = -1;
                            document.getElementById("select_item").innerText = "";
                            document.getElementById("itemdesc").innerText = "";
                            document.getElementById("select_qty").innerText = 0;
                            getToast_admin("success", "Success!", "Item Successfully Added.");
                        } 
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addItem").disabled = false;
                }
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['employee'])!=null): ?>
            <script type="text/javascript">
                 $(document).ready( function () {
                    $('#table_allemp').bdt(); 
                }); 

                get_allemp();

                function get_allemp(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_allemp"});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_allemp").html(response);
                    })
                }

                function clear_inputs_addEmp(){
                    document.getElementById("addemp_fname").value = "";
                    document.getElementById("addemp_age").value = ""; 
                    document.getElementById("addemp_sex").value = "";
                    document.getElementsByClassName("filter-option-inner-inner")[0].innerText = '';
                    document.getElementById("addemp_birthdate").value = ""; 
                    document.getElementById("addemp_address").value = "";
                    document.getElementById("addemp_role").value = "";   
                    document.getElementsByClassName("filter-option-inner-inner")[1].innerText = '';
                    document.getElementById("addemp_dateenlist").value = "";   
                    document.getElementById("addemp_fname").style.borderColor = "";
                    document.getElementById("addemp_age").style.borderColor = "";
                    document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
                    document.getElementById("addemp_birthdate").style.borderColor = "";
                    document.getElementById("addemp_address").style.borderColor = "";
                    document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "";
                    document.getElementById("addemp_dateenlist").style.borderColor = ""; 
                }

                function btn_addEmp(){  
                    var fullname = document.getElementById("addemp_fname").value;
                    var age = document.getElementById("addemp_age").value; 
                    var sex = document.getElementById("addemp_sex").value;
                    var birthdate = document.getElementById("addemp_birthdate").value; 
                    var address = document.getElementById("addemp_address").value;  
                    var role = document.getElementById("addemp_role").value; 
                    var dateenlist = document.getElementById("addemp_dateenlist").value;  
                    
                    var AddEmp = (function () {
                        function AddEmp() {
                            this.fullname = fullname; 
                            this.age = age;
                            this.sex = sex;
                            this.birthdate = birthdate;
                            this.address = address;
                            this.role = role; 
                            this.dateenlist = dateenlist; 
                        }
                        return AddEmp;
                    }());
                    var input_AddEmp = new AddEmp();

                    if (fullname.length > 0 && sex.length > 0 && role.length > 0  && dateenlist.length > 0){
                        execute_addemp(input_AddEmp);
                    } 
                    else{
                        document.getElementById("addemp_fname").style.borderColor = (fullname.length < 1)? "#e45454" : ""; 
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = (sex.length < 1)? "#e45454" : "";
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = (role.length < 1)? "#e45454" : ""; 
                        document.getElementById("addemp_dateenlist").style.borderColor = (dateenlist.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                } 
                
                function execute_addemp(input){
                    document.getElementById("btn_addEmp").disabled = true; 
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_addemp'
                        + '&fullname=' + input.fullname   
                        + '&age=' + input.age  
                        + '&sex=' + input.sex 
                        + '&birthdate=' + input.birthdate 
                        + '&address=' + input.address  
                        + '&role=' + input.role 
                        + '&dateenlist=' + input.dateenlist  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            getToast_admin("success", "Success!", "Employee/ Volunteer Successfully Added."); 
                            clear_inputs_addEmp(); 
                            get_allemp();
                        }
                        else if(data.status == 2){
                            getToast_admin("warning", " Duplicate Entry!", "You Have Already Added this Information.");    
                        }
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addEmp").disabled = false;
                }  

                function btn_removeEmp(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_removeemp",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Employee/ Volunteer Data Successfully Move to Draft."); 
                            get_allemp();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                } 

                function btn_restoreEmp(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_restoreemp",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Employee/ Volunteer Data Successfully Restore from Draft."); 
                            get_allemp();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                } 

                function btn_editEmp(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "modal_geteditemp",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            document.getElementById("editemp_id").value = id; 
                            document.getElementById("editemp_fname").value = data.fullname;
                            document.getElementById("editemp_age").value = data.age;
                            document.getElementById("editemp_sex").value = data.sex;
                            document.getElementsByClassName("filter-option-inner-inner")[2].innerText = (data.sex=="M")? "Male": "Female";
                            document.getElementById("editemp_birthdate").value = data.birthdate;   
                            document.getElementById("editemp_address").value = data.address;
                            document.getElementById("editemp_role").value = data.role;
                            document.getElementsByClassName("filter-option-inner-inner")[3].innerText = (data.role=="employee")? "Employee": "Volunteer";
                            document.getElementById("editemp_dateenlist").value = data.datehired;   
                        } 
                        else{ 
                            getToast_admin("warning", "Warning!", "Account Information Not Found.");  
                        }   
                    })["catch"](function (error) {
                        console.log(error); 
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }

                function btn_editEmpConfirm(){
                    var id = document.getElementById("editemp_id").value;
                    var fullname = document.getElementById("editemp_fname").value;
                    var age = document.getElementById("editemp_age").value; 
                    var sex = document.getElementById("editemp_sex").value;
                    var birthdate = document.getElementById("editemp_birthdate").value; 
                    var address = document.getElementById("editemp_address").value;  
                    var role = document.getElementById("editemp_role").value; 
                    var dateenlist = document.getElementById("editemp_dateenlist").value;  
                    
                    var EditEmp = (function () {
                        function EditEmp() {
                            this.id = id;
                            this.fullname = fullname; 
                            this.age = age;
                            this.sex = sex;
                            this.birthdate = birthdate;
                            this.address = address;
                            this.role = role; 
                            this.dateenlist = dateenlist; 
                        }
                        return EditEmp;
                    }());
                    var input_EditEmp = new EditEmp(); 

                    if (id.length > 0 && fullname.length > 0 && sex.length > 0 && role.length > 0  && dateenlist.length > 0){
                        execute_editemp(input_EditEmp);
                    } 
                    else{
                        document.getElementById("editemp_fname").style.borderColor = (fullname.length < 1)? "#e45454" : ""; 
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[2].style.borderColor = (sex.length < 1)? "#e45454" : "";
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[3].style.borderColor = (role.length < 1)? "#e45454" : ""; 
                        document.getElementById("editemp_dateenlist").style.borderColor = (dateenlist.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                }

                function execute_editemp(input){
                    document.getElementById("btn_editEmpConfirm").disabled = true; 
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_editemp'
                        + '&id=' + input.id  
                        + '&fullname=' + input.fullname   
                        + '&age=' + input.age  
                        + '&sex=' + input.sex 
                        + '&birthdate=' + input.birthdate 
                        + '&address=' + input.address  
                        + '&role=' + input.role 
                        + '&dateenlist=' + input.dateenlist  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){ 
                            getToast_admin("success", "Success!", "Employee/ Volunteer Successfully Modified."); 
                            $('#EditEmp_Modal').modal('hide'); 
                            get_allemp();
                        }
                        else if(data.status == 2){
                            getToast_admin("warning", " Duplicate Entry!", "You Have Already Added this Information.");    
                        }
                        else{ 
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_editEmpConfirm").disabled = false;
                }
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['inventory'])!=null): ?>
            <script type="text/javascript">
                $(document).ready( function () {
                    $('#table_allinventory').bdt();  
                }); 
 
                get_allinventory();
                get_allinventorylogs();

                function get_allinventory(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_allinventory"});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_allinventory").html(response);
                    })
                }

                function get_allinventorylogs(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_allinventorylogs"});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_allinventorylogs").html(response);
                    })
                }

                function btn_editItemQty(id,name){
                    document.getElementById("editqty_id").value = id;  
                    document.getElementById("editqty_name").value = name; 
                    document.getElementById("editqty_operation").value = "";
                    document.getElementsByClassName("filter-option-inner-inner")[0].innerText = 'Select';
                    document.getElementById("editqty_qty").value = 0; 
                    document.getElementById("editqty_event").value = "";
                    document.getElementsByClassName("filter-option-inner-inner")[1].innerText = 'Select';
                    document.getElementById("editqty_remarks").value= "";
                }

                function btn_editQty(){
                    var id = document.getElementById("editqty_id").value;
                    var name = document.getElementById("editqty_name").value;
                    var operation = document.getElementById("editqty_operation").value;
                    var qty = document.getElementById("editqty_qty").value;
                    var event = document.getElementById("editqty_event").value;
                    var remarks = document.getElementById("editqty_remarks").value;

                    var EditQty = (function () {
                        function EditQty() {
                            this.id = id;
                            this.name = name;
                            this.operation = operation; 
                            this.qty = qty; 
                            this.event = event; 
                            this.remarks = remarks; 
                        }
                        return EditQty;
                    }());
                    var input_EditQty= new EditQty(); 

                    if (id.length > 0 && operation.length > 0 && qty.length > 0){ 
                        execute_editqty(input_EditQty);  
                    } 
                    else{
                        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = (operation.length < 1)? "#e45454" : ""; 
                        document.getElementById("editqty_qty").style.borderColor = (qty.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }  
                }

                function execute_editqty(input){
                    document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = ""; 
                    document.getElementById("editqty_qty").style.borderColor = ""; 
                    document.getElementById("btn_editQty").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_editqty'
                        + '&id=' + input.id
                        + '&name=' + input.name
                        + '&operation=' + input.operation   
                        + '&qty=' + input.qty   
                        + '&event=' + input.event   
                        + '&remarks=' + input.remarks   
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Operation Successful.");  
                            $('#EditItemQty_Modal').modal('hide'); 
                            get_allinventory();
                            get_allinventorylogs();
                        } 
                        else if (data.status == 2){
                            getToast_admin("warning", "Invalid Quantity!", "Quantity was Greater than the amount on Inventory.");   
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_editQty").disabled = false; 
                }

                function btn_removeItem(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_removeitem",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Item Successfully Move to Draft."); 
                            get_allinventory();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                } 

                function btn_restoreItem(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_restoreitem",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Item Successfully Restore from Draft."); 
                            get_allinventory();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    }); 
                }

                function btn_editItem(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "modal_getedititem",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            document.getElementById("edititem_id").value = id; 
                            document.getElementById("edititem_name").value = data.name;
                            document.getElementById("edititem_desc").value = data.desc;  
                        } 
                        else{ 
                            document.getElementById("edititem_id").value = ''; 
                            document.getElementById("edititem_name").value = '';
                            document.getElementById("edititem_desc").value = '';  
                            getToast_admin("warning", "Warning!", "Item Not Found.");  
                        }   
                    })["catch"](function (error) {
                        console.log(error); 
                        document.getElementById("edititem_id").value = ''; 
                        document.getElementById("edititem_name").value = '';
                        document.getElementById("edititem_desc").value = ''; 
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }

                function btn_editItemConfirm(){
                    var id = document.getElementById("edititem_id").value;
                    var name = document.getElementById("edititem_name").value;
                    var desc = document.getElementById("edititem_desc").value;  
  
                    var EditItem = (function () {
                        function EditItem() {
                            this.id = id;
                            this.name = name; 
                            this.desc = desc; 
                        }
                        return EditItem;
                    }());
                    var input_EditItem= new EditItem();

                    if (id.length > 0 && name.length > 0){ 
                        execute_edititem(input_EditItem);  
                    } 
                    else{
                        document.getElementById("edititem_name").style.borderColor = (name.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }  
                }

                function execute_edititem(input){
                    document.getElementById("btn_editItemConfirm").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_edititem'
                        + '&id=' + input.id
                        + '&name=' + input.name   
                        + '&desc=' + input.desc   
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Item Successfully Modified."); 
                            document.getElementById("edititem_id").value = '';
                            document.getElementById("edititem_name").value = ''; 
                            document.getElementById("edititem_desc").value = ''; 
                            document.getElementById("edititem_name").style.borderColor = ""; 
                            $('#EditItem_Modal').modal('hide'); 
                            get_allinventory();
                        } 
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_editItemConfirm").disabled = false; 
                } 

                function btn_addItemConfirm(){ 
                    var name = document.getElementById("additem_name").value;
                    var desc = document.getElementById("additem_desc").value; 
                    var qty = document.getElementById("additem_qty").value; 
  
                    var AddItem = (function () {
                        function AddItem() { 
                            this.name = name; 
                            this.desc = desc; 
                            this.qty = qty;
                        }
                        return AddItem;
                    }());
                    var input_AddItem= new AddItem();

                    if (name.length > 0 && qty.length > 0){ 
                        execute_additem(input_AddItem);  
                    } 
                    else{
                        document.getElementById("additem_name").style.borderColor = (name.length < 1)? "#e45454" : "";
                        document.getElementById("additem_qty").style.borderColor = (qty.length < 1)? "#e45454" : ""; 
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }  
                }

                function execute_additem(input){
                    document.getElementById("btn_addItemConfirm").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_additeminv'
                        + '&name=' + input.name
                        + '&desc=' + input.desc   
                        + '&qty=' + input.qty   
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Item Successfully Added."); 
                            document.getElementById("additem_name").value = ''; 
                            document.getElementById("additem_desc").value = ''; 
                            document.getElementById("additem_qty").value = '0';  
                            document.getElementById("additem_name").style.borderColor = "";
                            get_allinventory();
                        } 
                        else if (data.status == 2){
                            getToast_admin("warning", " Duplicate Entry!", "Item Was Already Added.");    
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addItemConfirm").disabled = false; 
                } 
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['activity'])!=null): ?> 
            <script type="text/javascript">  
                <?php if (isset($_GET['success'])!=null): ?>
                    getToast_admin("success", "Success!", "Event Successfully Removed.");  
                <?php endif; ?> 
                
                jQuery(function($) {   
                    // change styling options and icons
                    FullCalendar.BootstrapTheme.prototype.classes = {
                    root: 'fc-theme-bootstrap',
                    table: 'table-bordered table-bordered brc-default-l2 text-secondary-d1 h-95',
                    tableCellShaded: 'bgc-secondary-l3',
                    buttonGroup: 'btn-group',
                    button: 'btn btn-white btn-h-lighter-blue btn-a-blue',
                    buttonActive: 'active',
                    popover: 'card card-primary',
                    popoverHeader: 'card-header',
                    popoverContent: 'card-body',
                    };
                    FullCalendar.BootstrapTheme.prototype.baseIconClass = 'fa';
                    FullCalendar.BootstrapTheme.prototype.iconClasses = {
                    close: 'fa-times',
                    prev: 'fa-chevron-left',
                    next: 'fa-chevron-right',
                    prevYear: 'fa-angle-double-left',
                    nextYear: 'fa-angle-double-right'
                    };
                    FullCalendar.BootstrapTheme.prototype.iconOverrideOption = 'FontAwesome';
                    FullCalendar.BootstrapTheme.prototype.iconOverrideCustomButtonOption = 'FontAwesome';
                    FullCalendar.BootstrapTheme.prototype.iconOverridePrefix = 'fa-';
            
                    // initialize the calendar
                    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    themeSystem: 'bootstrap',

                    headerToolbar: {
                        start: 'prev,next today',
                        center: 'title',
                        end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
 
                    events: [
                        <?php $getEvents = $conn->query("SELECT * FROM `tb_events` WHERE `_draft`='0'");
                            while($rowEvents = $getEvents->fetch_assoc()): ?>
                            {
                                getid     : '<?php echo htmlentities($rowEvents['_id']); ?>',
                                title     : '<?php echo htmlentities($rowEvents['_title']); ?>',
                                info      : '<?php echo nl2br($rowEvents['_body']); ?>',
                                start     : '<?php echo date('Y-m-d', strtotime($rowEvents['_startdate'])); ?>',   
                                end       : '<?php echo date('Y-m-d', strtotime("+1 day", strtotime($rowEvents['_enddate']))); ?>',
                                allDay    : true,
                                className : '<?php if (date('Y-m-d', strtotime($rowEvents['_startdate']))==date("Y-m-d")){ echo 'bgc-blue-d2 text-white text-95'; }
                                elseif (date('Y-m-d', strtotime($rowEvents['_startdate']))<date("Y-m-d")){ echo 'bgc-red-d1 text-white text-95'; }
                                else { echo 'bgc-green-d2 text-white text-95'; } ?>'
                            },
                        <?php endwhile; ?>    
                        // {
                        // title: 'Some Event',
                        // start: new Date(y, m, 1, Math.random() * 23 + 1),
                        // allDay: true,
                        // className: 'bgc-red-d1 text-white text-95'
                        // },
                        // {
                        // title: 'Long Event',
                        // start: new Date(y, m, day1, Math.random() * 23 + 1),
                        // end: new Date(y, m, day1 + 4, Math.random() * 23 + 1),
                        // allDay: true,
                        // className: 'bgc-green-d2 text-white text-95'
                        // },
                        // {
                        // title: 'Other Event',
                        // start: new Date(y, m, day2, Math.random() * 23 + 1),
                        // allDay: true,
                        // className: 'bgc-blue-d2 text-white text-95'
                        // }
                    ], 

                    selectable: true,
                    selectLongPressDelay: 200, 
                    editable: true,
                    droppable: true, 

                    eventClick: function(info) {
                        // console.log(info);
                        const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                        let conv_start = new Date(info.event.start);
                        let conv_end = (info.event.end!==null)? new Date(info.event.end): 'N/A';
                        let date_start = month[conv_start.getMonth()]+' '+ conv_start.getDate()+', '+conv_start.getFullYear();
                        let date_end = (conv_end!=='N/A')? 
                            // month[conv_end.getMonth()]+' '+conv_end.getDate()+', '+conv_end.getFullYear() // If localhost
                            month[conv_end.getMonth()]+' '+parseInt(conv_end.getDate()-1)+', '+conv_end.getFullYear() 
                            : conv_end;
                        //display a modal 
                        var modal =
                        '<div class="modal fade primary-modal">\
                            <div class="modal-dialog modal-dialog-centered">\
                                <div class="modal-content">\
                                    <div class="modal-header">\
                                        <h5 class="modal-title">Event Information</h5>\
                                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">\
                                            <img src="../old-folders/old-folders/assets/images/close-white.svg" alt="" />\
                                        </button>\
                                    </div>\
                                    <div class="modal-body mb-n3">\
                                        <div class="row">\
                                            <div class="col-md-6">\
                                                <label class="form-label">Date From: </label>\
                                                <label class="form-label text-orange">'+ date_start +'</label>\
                                            </div>\
                                            <div class="col-md-6">\
                                                <label class="form-label">Date To: </label>\
                                                <label class="form-label text-orange">'+ date_end +'</label>\
                                            </div>\
                                            <div class="col-md-12" style="margin-top: 15px;">\
                                                <label class="form-label">Event: </label>\
                                                <label class="form-label text-orange">' + info.event.title + '</label>\
                                            </div>\
                                            <div class="col-md-12" style="margin-top: 15px;">\
                                                <label class="form-label">Information: </label>\
                                            </div>\
                                            <div class="col-md-12" style="margin: 15px 0px 25px 5px;text-align: justify;">\
                                                <label class="form-label text-orange">'+ info.event.extendedProps.info +'</label>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="modal-footer">\
                                        <button id="btn_removeEvent" onclick="btn_removeEvent(this.getAttribute(\'data-id1\'))" data-id1="'+ info.event.extendedProps.getid +'" title="Remove Event" type="button" class="btn btn-danger btn-small text-normal" style="min-width: 0%; padding: 5px 10px;">\
                                            <i class="nav-icon fa fa-trash font-25"></i>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>';


                        var modal = $(modal).appendTo('body');
                        modal.find('form').on('submit', function(ev) {
                            ev.preventDefault();
                            info.event.setProp('title', $(this).find("input[type=text]").val());
                            modal.modal("hide");
                        });
                        modal.find('button[data-action=delete]').on('click', function() {
                            info.event.remove();
                            modal.modal("hide");
                        });
                        modal.modal('show').on('hidden.bs.modal', function() {
                            modal.remove();
                        });
                    } 
                    });  
                    calendar.render(); 
                });

                $(document).ready( function () {
                    $('#table_eventrequests').bdt(); 
                }); 

                get_eventrequests();

                function get_eventrequests(){
                    var data = $('#form').serializeArray();
                    data.push({name: "data", value: "get_eventrequests"});
                    
                    $.ajax({
                        url: getHost + 'includes/execute.php',  
                        type : "POST", 
                        data: data,
                    }).done(function(response) { 
                        $("#get_eventrequests").html(response);
                    })
                }

                function btn_removeEvent(id){
                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_removeevent",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            window.location.href = '?activity&success';
                        } 
                        else{  
                            getToast_admin("warning", "Warning!", "Cannot Connect to Database.");  
                        }   
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });   
                }

                function btn_reloadEvent(){
                    window.location.reload();
                }

                function btn_addEvent(){   
                    var datefrom = document.getElementById("event_datefrom").value; 
                    var dateto = document.getElementById("event_dateto").value; 
                    var title = document.getElementById("event_title").value;   
                    var info = document.getElementById("event_info").value; 
                  
                    var AddEvent = (function () {
                        function AddEvent() {
                            this.datefrom = datefrom;
                            this.dateto = dateto;  
                            this.title = title; 
                            this.info = info; 
                        }
                        return AddEvent;
                    }());
                    var input_AddEvent = new AddEvent(); 

                    if (datefrom.length > 0 && title.length > 0 && info.length > 0){  
                        document.getElementById("event_datefrom").style.borderColor = "";
                        document.getElementById("event_title").style.borderColor = "";
                        document.getElementById("event_info").style.borderColor = "";
                        execute_addevent(input_AddEvent);
                    } 
                    else{
                        document.getElementById("event_datefrom").style.borderColor = (datefrom.length < 1)? "#e45454" : ""; "";
                        document.getElementById("event_title").style.borderColor = (title.length < 1)? "#e45454" : ""; "";
                        document.getElementById("event_info").style.borderColor = (info.length < 1)? "#e45454" : ""; "";
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    } 
                }  

                function execute_addevent(input){
                    document.getElementById("btn_addEvent").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_addevent'
                        + '&datefrom=' + input.datefrom
                        + '&dateto=' + input.dateto   
                        + '&title=' + input.title   
                        + '&info=' + input.info   
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data); 
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Event Successfully Added."); 
                            document.getElementById("event_datefrom").value = '';
                            document.getElementById("event_dateto").value = ''; 
                            document.getElementById("event_title").value = ''; 
                            document.getElementById("event_info").value = '';    
                        } 
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_addEvent").disabled = false; 
                }  

                function btn_editEventReq(id){
                    document.getElementById("eventrequest_id").value = id;  
                }

                function btn_cancelEventReq(){
                    var id = document.getElementById("eventrequest_id").value;

                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_canceleventrequest",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Event Request Has Been Cancelled."); 
                            $('#EventRequest_Modal').modal('hide'); 
                            get_eventrequests();
                            get_pendingEvent();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }

                function btn_confirmEventReq(){
                    var id = document.getElementById("eventrequest_id").value;

                    fetch('../old-folders/includes/execute.php?' + new URLSearchParams({
                        "data": "admin_confirmeventrequest",
                        "id": id
                    }), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        }
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        // console.log(data);
                        if (data.status == 1){
                            getToast_admin("success", "Success!", "Event Successfully Added to Calendar."); 
                            $('#EventRequest_Modal').modal('hide'); 
                            get_eventrequests();
                            get_pendingEvent();
                        }
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);  
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                }
            </script>
        <?php endif; ?> 

        <?php if (isset($_GET['settings'])!=null): ?>
            <script type="text/javascript">
                function btn_editProfile(){
                    var id = document.getElementById("editprofile_id").value;
                    var fullname = document.getElementById("editprofile_fname").value;
                    var mobile = document.getElementById("editprofile_mobile").value; 
                    var email = document.getElementById("editprofile_email").value;
                    var address = document.getElementById("editprofile_address").value;
                    
                    var AdminEditProfile = (function () {
                        function AdminEditProfile() {
                            this.id = id;
                            this.fullname = fullname; 
                            this.mobile = mobile;
                            this.email = email;
                            this.address = address;
                        }
                        return AdminEditProfile;
                    }());
                    var input_AdminEditProfile= new AdminEditProfile();

                    if (id.length > 0 && fullname.length > 0 && email.length > 0){ 
                        execute_editprofile(input_AdminEditProfile); 
                    } 
                    else{
                        document.getElementById("editprofile_fname").style.borderColor = (fullname.length < 1)? "#e45454" : "";
                        document.getElementById("editprofile_email").style.borderColor = (email.length < 1)? "#e45454" : "";
                        getToast_admin("warning", "Error on Inputs!", "Insert Data on Required Fields!.");   
                    }  
                }

                function execute_editprofile(input){
                    document.getElementById("btn_editProfile").disabled = true;
                    fetch('../old-folders/includes/execute.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        body: 'data=admin_editprofile'
                        + '&id=' + input.id
                        + '&fullname=' + input.fullname   
                        + '&mobile=' + input.mobile  
                        + '&email=' + input.email 
                        + '&address=' + input.address  
                    }).then(function (response) {
                        return response.json();
                    }).then(function (data) { 
                        console.log(data); 
                        if (data.status == 1){
                            document.getElementById("account_name").innerText = 'Hello '+input.fullname+' !';
                            getToast_admin("success", "Success!", "Account Profile Successfully Modified."); 
                        } 
                        else{
                            getToast_admin("danger", "Error!", "Cannot connect to Database.");   
                        }  
                    })["catch"](function (error) {
                        console.log(error);   
                        getToast_admin("danger", "Internal Error!", "Cannot connect to server.");  
                    });  
                    document.getElementById("btn_editProfile").disabled = false; 
                }
            </script>
        <?php endif; ?>
    </body>
</html>
<?php else: ?>  
    <script>window.location.href = "../dashboard.php?patient";</script>
<?php endif; ?>
<?php require_once('../includes/config.php'); ?>
<?php if (isset($_SESSION['st_admin_id'])==null): ?> 
    <script>window.location.href = "login.html";</script> 
<?php elseif (isset($_SESSION['st_admin_id'])!=null && $_SESSION['st_admin_role']=="admin"): ?>
<!DOCTYPE html>
<html>
<head>
    <title>.</title> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> -->
    <!-- <meta name="description" content="St. Vincent Strambi C.P of Home for the Aged"> --> 

    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">  
    <!-- Pagination -->   
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/jquery.bdt.css" > -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/jquery.gritter.min.css">  -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui.min.css">   -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">  -->
    <style type="text/css" media="print">
        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 0px;
                padding-bottom: 0px;
            }
        }
    </style>

    <style type="text/css">
        hr.m0 {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 2px;
        }

        body:not(.page-loaded) { 
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="page-content">
        <div class="row">
            <div class="col-md-12" style="padding: 30px;">
                <div style="text-align: end;margin-bottom: 20px;">
                    <span>Date:</span>
                    <span><?php echo date("M d, Y", strtotime($date)); ?></span> 
                </div> 
            </div> 

            <div class="col-md-12" style="padding: 30px;">
                <table class="table table-striped">
                    <?php $get_id = (isset($_GET['id']))? mysqli_real_escape_string($conn, $_GET['id']): ""; 
                        $query_getid = "SELECT a.*, 
                            CONCAT(a.`_surname`,', ',a.`_givenname`,' ',a.`_midname`) AS `concat_name`, 
                            IFNULL(GROUP_CONCAT(IF(b._date!='0000-00-00',CONCAT(' (',b._date,') '),''),b._remarks,' '),'') as `concat_remarks`
                            FROM `tb_patient` a 
                            LEFT JOIN `tb_patientmedical` b
                            ON a._id=b._patientID
                            WHERE a._id='".$get_id."'"; 
                        $result_getid = $conn->query($query_getid); 
                        $row = mysqli_fetch_assoc($result_getid);  
                    ?>
                    <thead>
                        <tr>
                            <th>Date of Entry</th>
                            <th>Fullname</th>
                            <th>Age</th> 
                            <th>Birthdate</th> 
                            <th>Medical History</th> 
                            <?php if ($row['_active']=="2"): ?>
                                <th>Deceased Date</th>
                                <th>Attending Physician</th>
                                <th>Cause of Death</th>  
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($row['_id'] != null): $result_getid2 = $conn->query($query_getid);  ?>
                            <?php while($row2 = mysqli_fetch_assoc($result_getid2)): ?>
                                <tr>
                                    <td><?php echo ($row['_dateentered']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_dateentered'])): "N/A";?></td>
                                    <td><?php echo htmlspecialchars($row['concat_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['_age']); ?></td> 
                                    <td><?php echo ($row['_birthdate']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_birthdate'])): "N/A";?></td>
                                    <td><?php echo htmlspecialchars($row['concat_remarks']); ?></td> 
                                    <?php if ($row2['_active']=="2"): ?>
                                        <td><?php echo ($row['_datedied']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_datedied'])): "N/A";?></td>
                                        <td><?php echo (htmlspecialchars($row['_physician'])!="")? htmlspecialchars($row['_physician']): "N/A"; ?></td>
                                        <td><?php echo (htmlspecialchars($row['_causeofdeath'])!="")? htmlspecialchars($row['_causeofdeath']): "N/A"; ?></td>
                                    <?php endif; ?>
                                    </tr>
                            <?php endwhile; ?>
                        <?php else: header("Location: index.php?patient"); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>

    <script type="text/javascript" src="../assets/js/jquery.js"></script>  
    <script>
        window.onafterprint = function (e) {
            $(window).off('mousemove', window.onafterprint);
            //console.log('Print Dialog Closed..');
            window.close('', '_parent', '');
        };

        window.print();

        setTimeout(function () {
            $(window).one('mousemove', window.onafterprint);
        }, 1);
    </script>
</body>
</html>
<?php else: ?>  
    <script>window.location.href = "index.php?patient";</script>
<?php endif; ?>
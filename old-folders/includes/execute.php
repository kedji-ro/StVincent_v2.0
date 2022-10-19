<?php 

include 'config.php'; 

header("Access-Control-Allow-Origin: *"); 

if (isset($_SERVER['HTTP_ORIGIN'])){
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

function generateToken($length = 35) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/////////////////////////////////////////
/////////////// NO ACCOUNT ///////////////////
/////////////////////////////////////////
if(isset($_POST['data']) && $_POST['data']=="anon_addmydonation"){ 
	$payment = mysqli_real_escape_string($conn, $_POST['payment']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);  
	$amount_cash = mysqli_real_escape_string($conn, $_POST['amount_cash']); 
	$bankname = strtoupper(mysqli_real_escape_string($conn, $_POST['bankname'])); 
	$checkno = strtoupper(mysqli_real_escape_string($conn, $_POST['checkno'])); 
	$amount_check = mysqli_real_escape_string($conn, $_POST['amount_check']); 
	$getamount = ($payment == "C")? $amount_cash: $amount_check;  
	$hasFile = (isset($_FILES['file']))? true: false;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $extension = "";
    $new_name = "";
    $location = "../assets/uploadfile/";

	if ($hasFile){ 
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $new_name = $name.'_'.time().'.'.$extension; 
        move_uploaded_file($_FILES["file"]["tmp_name"], $location.''.$new_name);
    } 

	$query_addMyDonate = "INSERT INTO `tb_donation`(`_fullname`, `_mop`, `_amount`, 
	`_bankname`, `_checkno`, `_remarks`, `_upload`, `_date`) 
	VALUES ('Anonymous','".$payment."','".$getamount."','".$bankname."','".$checkno."','".$remarks."','".$new_name."','0000-01-01 00:00:00')";

	if (mysqli_query($conn, $query_addMyDonate)){  
		echo json_encode(array('status'=>1));
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();   
}

/************************ User login validation start ************************/
if(isset($_POST['data']) && $_POST['data']=="user_login"){
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);  

	$query = "SELECT * FROM `tb_useracct` 
	WHERE (`_username`='".$email."' OR `_email`='".$email."') AND `_password`=MD5('".$pass."') AND `_role`!='admin' AND `_active`='1'";
    $result = $conn->query($query); 
    $row_cnt = $result->num_rows; 

    if ($row_cnt > 0){ // Has Account
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['st_id'] = session_id();
            $_SESSION['st_userid'] = $row['_id'];
            $_SESSION['st_username'] = $row['_username'];
            $_SESSION['st_fullname'] = $row['_fullname'];  
			$_SESSION['st_mobile'] = $row['_mobile'];
            $_SESSION['st_email'] = $row['_email']; 
            $_SESSION['st_address'] = $row['_address']; 
            $_SESSION['st_role'] = $row['_role'];
			$_SESSION['st_volunteer'] = $row['_volunteer'];
        } 
        echo json_encode(array('status'=>1));
    }
    else{ 
        echo json_encode(array('status'=>0));  
    }  
    $conn->close(); 
} 
/************************ User login validation end ************************/

if (isset($_POST["data"]) && $_POST["data"] == "user_changepass"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']); 

	$query = "SELECT * FROM `tb_useracct` WHERE `_id`='".$id."' AND `_password`=MD5('".$oldpass."')";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_UpdatePass= "UPDATE `tb_useracct` SET `_password`=MD5('".$pass."') WHERE `_id`='".$id."'"; 
	
	if ($row_cnt > 0){ 
		if (mysqli_query($conn, $query_UpdatePass)){  
			echo json_encode(array('status'=>1));
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}
	else{
		echo json_encode(array('status'=>2));
	}  
	$conn->close(); 
}

if (isset($_POST["data"]) && $_POST["data"] == "user_logout"){
	try {
		unset($_SESSION['st_id']); 
		unset($_SESSION['st_userid']);
		unset($_SESSION['st_username']);
		unset($_SESSION['st_fullname']); 
		unset($_SESSION['st_mobile']);
		unset($_SESSION['st_email']);
		unset($_SESSION['st_address']);
		unset($_SESSION['st_role']);
		unset($_SESSION['st_volunteer']);
		echo json_encode(array('status'=>1));
	} catch (\Throwable $th) {
		echo json_encode(array('status'=>0));
	} 
	// if (session_destroy()){
	// 	echo json_encode(array('status'=>1));
	// }
	// else{
	// 	echo json_encode(array('status'=>0));
	// } 
} 

if(isset($_POST['data']) && $_POST['data']=="user_signup"){
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']); 
	$token = generateToken();

	$url = "http://localhost/StVincent/registration/?token=".$token;

	$query = "SELECT * FROM `tb_useracct` WHERE `_email`='".$email."' OR `_username`='".$username."'";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_createUser= "INSERT INTO `tb_useracct`(`_username`, `_password`, `_fullname`, `_mobile`, `_email`, `_address`, `_role`, `_tokenactivation`, `_active`) 
	VALUES ('".$username."',MD5('".$password."'),'".$fullname."','".$mobile."','".$email."','".$address."','user','".$token."','0')"; 
	
	

	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_createUser)){  
			echo json_encode(array('status'=>1,'token'=>$token)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}  

	$conn->close(); 
	// email_RegistrationForm($email,$token,$url);
}

/////////////// USER - MY DONATION  ///////////////////
if (isset($_POST["data"]) && $_POST["data"] == "get_myalldonation"){ 
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	
	$query = "SELECT * FROM `tb_donation` WHERE `_userID`='".$userid."' ORDER BY `_date` DESC"; 
	$result = $conn->query($query); 
	$row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">    
				<button onclick="btn_myDonateInfo(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="My Donation Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#ShowMyDonateInfo_Modal">
					<i class="nav-icon fa fa-info font-18 color-grey"></i>
				</button>
			</td> 
			<td>
				<?php if ($row['_date']!="0000-01-01 00:00:00"): ?>
					<?php echo date("M d, Y", strtotime($row['_date'])).'<br>'.date("h:i A", strtotime($row['_date'])); ?>
				<?php else: ?>
					N/A
				<?php endif; ?> 
			</td>    
			<td> 
				<span class="status info">
					<?php echo ($row['_type']=="M")? "Monetary": "Goods"; ?>
					<?php if ($row['_type']=="M" && $row['_mop']=="C"): echo "- Cash" ?>
					<?php elseif ($row['_type']=="M" && $row['_mop']=="CHK"): echo "- Check" ?>
					<?php else: ?> 
					<?php endif; ?>   
				</span>
			</td> 
			<td>
				<?php if ($row['_status']=='1'): ?>
					<span class="status success">Received</span>
				<?php elseif ($row['_status']=='2'): ?>
					<span class="status danger">Cancelled</span> 
				<?php else: ?>
					<span class="status warning">Pending</span>
				<?php endif; ?>  
			</td>
		</tr> 
		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="5" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if (isset($_POST["data"]) && $_POST["data"] == "get_mydonateinfo"){ 
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);  
	
	$query_info = "SELECT * FROM `tb_donation` WHERE `_id`='".$id."' AND `_userID`='".$userid."'"; 
	$result = $conn->query($query_info);
	$row = mysqli_fetch_assoc($result); 

	$query_getItem = "SELECT a.* FROM `tb_donation_lists` a
	LEFT JOIN `tb_donation` b ON a._donationID=b._id
	WHERE a.`_donationID`='".$id."' AND b.`_userID`='".$userid."' AND `_draft`='0'";

	$result2 = $conn->query($query_getItem); 
    $row_cnt = $result2->num_rows;  
	?> 
	<div class="col-md-4">
		<div class="form-group">
			<label class="form-label">Status:</label>
			<?php if ($row['_status']=='1'): ?>
				<span class="status success">Received</span>
			<?php elseif ($row['_status']=='2'): ?>
				<span class="status danger">Cancelled</span> 
			<?php else: ?>
				<span class="status warning">Pending</span>
			<?php endif; ?>  
		</div>
	</div>  
	<div class="col-md-4">
		<div class="form-group">
			<label class="form-label">Type: 
				<span class="status info">
					<?php if ($row['_type']=="M"): ?>
						<?php echo ($row['_mop']=="C")? "Monetary - Cash": "Monetary - Check"; ?>
					<?php else: ?>
						Goods
					<?php endif; ?>
					<?php //echo ($row['_type']=="M")? "Monetary": "Goods"; ?>
				</span>
			</label> 
		</div>
	</div>   
	<div class="col-md-4">
		<div class="form-group">
			<label class="form-label">Date: 
				<span class="status info"><?php echo ($row['_date']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_date'])): "N/A"; ?></span>
			</label> 
		</div> 
	</div>     
	

	<?php if ($row['_type']=="G"): ?>
		<div class="col-md-12">
			<table class="table primary-table table-hover" style="margin-bottom: 30px;">
				<thead>
					<tr>  
						<th>#</th>
						<th>Item Name</th> 
						<th>Description</th>
						<th>QTY</th>
						<th>Status</th> 
					</tr>
				</thead>
				<tbody>
					<?php if ($row_cnt > 0): 
						$count=1; ?>
						<?php while($row2 = mysqli_fetch_assoc($result2)): ?>
							<tr>  
								<td><?php echo $count; ?></td>
								<td><?php echo htmlspecialchars($row2['_itemName']); ?></th>
								<td><?php echo htmlspecialchars($row2['_itemDesc']); ?></th>
								<td><?php echo number_format($row2['_qty'],2); ?></th>
								<td>
									<span class="status <?php echo ($row2['_rcvd']=="1")? "success": "warning"; ?>">
										<?php echo ($row2['_rcvd']=="1")? "Received": "Pending"; ?>
									</span>
								</th> 
							</tr> 
						<?php $count++; endwhile; ?>
					<?php else: ?>
						<tr> 
							<td colspan="5" style="text-align: center;">No matching records found</th> 
						</tr>
					<?php endif; ?> 
				</tbody> 
			</table>
		</div> 
	<?php endif; ?>    
	 
	<?php if ($row['_type']=="M" && $row['_mop']=="C"): ?>
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Amount</label>
				<input type="text" class="form-control" value="<?php echo number_format($row['_amount'],2).' PHP'; ?>" disabled>
			</div> 
		</div> 
	<?php elseif ($row['_type']=="M" && $row['_mop']=="CHK"): ?>
		<div class="row" style="padding: 0px 18px 0px 18px;">
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label text-orange">Bank Information</label>
				</div> 
			</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Bank Name</label>
					<input type="text" class="form-control" value="<?php echo htmlspecialchars($row['_bankname']); ?>" disabled>
				</div>
			</div>  
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Check Reference No.</label>
					<input type="text" class="form-control" value="<?php echo htmlspecialchars($row['_checkno']); ?>" disabled>
				</div>
			</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Amount</label>
					<input type="text" class="form-control" value="<?php echo number_format($row['_amount'],2).' PHP'; ?>" disabled>
				</div>
			</div>  
			<div class="col-md-6"></div>
		</div> 
	<?php else: ?>
	<?php endif; ?>    

	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label">Remarks</label>
			<textarea class="form-control" rows="3" disabled><?php echo htmlspecialchars($row['_remarks']); ?></textarea>
		</div>
	</div>   

	<?php if ($row['_upload']!=""): ?>
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Uploaded Image</label>
				<img src="<?php echo htmlspecialchars('assets/uploadfile/'.$row['_upload']); ?>" style="width: 100%;" />
			</div>
		</div> 
	<?php endif; ?>
<?php } 

if(isset($_POST['data']) && $_POST['data']=="user_addmydonation"){
	$userid = mysqli_real_escape_string($conn, $_POST['userid']); 
	$type = mysqli_real_escape_string($conn, $_POST['type']); 
	$payment = mysqli_real_escape_string($conn, $_POST['payment']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);  
	$amount_cash = mysqli_real_escape_string($conn, $_POST['amount_cash']); 
	$bankname = strtoupper(mysqli_real_escape_string($conn, $_POST['bankname'])); 
	$checkno = strtoupper(mysqli_real_escape_string($conn, $_POST['checkno'])); 
	$amount_check = mysqli_real_escape_string($conn, $_POST['amount_check']); 
	
	if ($type=="M"){
		$getamount = ($payment == "C")? $amount_cash: $amount_check; 
	}
	else{
		$getamount = "0";
	}
	

	$hasFile = (isset($_FILES['file']))? true: false;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $extension = "";
    $new_name = "";
    $location = "../assets/uploadfile/";

	if ($hasFile){ 
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $new_name = $name.'_'.time().'.'.$extension; 
        move_uploaded_file($_FILES["file"]["tmp_name"], $location.''.$new_name);
    } 

	$query_countItem = "SELECT * FROM `tb_donation_lists` 
	WHERE `_userID`='".$userid."' AND `_donationID`='0' AND `_draft`='1' AND `_rcvd`='0'";
	$result = $conn->query($query_countItem); 
    $row_cnt = $result->num_rows;  
 
	$query_addMyDonate = "INSERT INTO `tb_donation`(`_userID`, `_fullname`, `_mobile`, `_address`, 
	`_type`, `_mop`, `_amount`, `_bankname`, `_checkno`, `_remarks`, `_upload`, `_date`) 
	SELECT `_id`,`_fullname`,`_mobile`,`_address`,
	'".$type."','".$payment."','".$getamount."','".$bankname."','".$checkno."','".$remarks."','".$new_name."', '0000-01-01 00:00:00'
	FROM `tb_useracct` WHERE `_id`='".$userid."' AND `_active`='1'";

	$query_updateDonationLists = "UPDATE `tb_donation_lists` 
	SET `_donationID`=(
		SELECT `_id` FROM `tb_donation` WHERE `_userID`='".$userid."' AND `_type`='G' AND `_status`='0' 
		ORDER BY `_id` DESC LIMIT 1), `_draft`='0' 
	WHERE `_userID`='".$userid."' AND `_donationID`='0' AND `_draft`='1' AND `_rcvd`='0'";

	if ($type == "G"){
		if ($row_cnt > 0){
			if (mysqli_query($conn, $query_addMyDonate)){
				if (mysqli_query($conn, $query_updateDonationLists)){
					echo json_encode(array('status'=>1));
				}
				else{
					echo json_encode(array('status'=>0));
				}
			}
			else{
				echo json_encode(array('status'=>0));
			}
		}
		else{
			echo json_encode(array('status'=>2));
		}
	}
	else{
		if (mysqli_query($conn, $query_addMyDonate)){
			echo json_encode(array('status'=>1));
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}

	// if ($row_cnt > 0){
	// 	if (mysqli_query($conn, $query_addMyDonate)){  
	// 		if ($type == "G"){
	// 			$query_updateDonationLists = "UPDATE `tb_donation_lists` 
	// 			SET `_donationID`=(
	// 				SELECT `_id` FROM `tb_donation` WHERE `_userID`='".$userid."' AND `_type`='G' AND `_status`='0' 
	// 				ORDER BY `_id` DESC LIMIT 1), `_draft`='0' 
	// 			WHERE `_userID`='".$userid."' AND `_donationID`='0' AND `_draft`='1' AND `_rcvd`='0'";
	
	// 			if (mysqli_query($conn, $query_updateDonationLists)){
	// 				echo json_encode(array('status'=>1));
	// 			}
	// 			else{
	// 				echo json_encode(array('status'=>0));
	// 			}
	// 		}
	// 		else{
	// 			echo json_encode(array('status'=>1));
	// 		} 
	// 	}
	// 	else{
	// 		echo json_encode(array('status'=>0));
	// 	}  
	// }
	// else{
	// 	echo json_encode(array('status'=>2));
	// }  
	$conn->close(); 
}

if (isset($_POST["data"]) && $_POST["data"] == "get_myalldonation_items"){ 
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);  
	
	$query_getItem = "SELECT * FROM `tb_donation_lists` 
	WHERE `_userID`='".$userid."' AND `_donationID`='0' AND `_draft`='1'";

	$result = $conn->query($query_getItem); 
    $row_cnt = $result->num_rows; ?>

	<table class="table primary-table table-hover" style="margin-bottom: 30px;">
		<thead>
			<tr>  
				<th width=5%>#</th>  
				<th width=5% hidden>ItemID</th>  
				<th>Item Name</th> 
				<th>Description</th>
				<th width=15%>QTY</th>
				<th width=10%>Action</th> 
			</tr>
		</thead>
		<tbody> 
			<?php if ($row_cnt > 0): 
				$count=1; ?>
				<?php while($row = mysqli_fetch_assoc($result)): ?>
					<tr style="background-color: #cde3ff;">  
						<td><?php echo $count; ?></td> 
						<td hidden></td> 
						<td><?php echo htmlspecialchars($row['_itemName']); ?></th>
						<td><?php echo htmlspecialchars($row['_itemDesc']); ?></th>
						<td><?php echo number_format($row['_qty'],2); ?></th>
						<td>
							<button onclick="btn_removeMyItem(this.getAttribute('data-id1'),this.getAttribute('data-id2'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" data-id2="<?php echo $_SESSION['st_userid']; ?>" title="Remove Item" class="btn btn-icon small btn-outlined-primary" style="background-color: aliceblue;">
								<img src="assets/images/remove-grey.svg" alt="">
							</button>
						</th> 
					</tr> 
				<?php $count++; endwhile; ?>
			<?php else: ?>
				<tr style="background-color: #cde3ff;"> 
					<td colspan="5" style="text-align: center;">No matching records found</th> 
				</tr>
			<?php endif; ?>  
			<tr> 
				<td></td>
				<td id="my_item_id" hidden></td>
				<td id="my_select_item" contenteditable style="background-color: #f39e4791; font-size: 16px;"></th> 
				<td id="my_itemdesc" style="font-size: 16px;"></th> 
				<td id="my_select_qty" contenteditable style="background-color: #f39e4791; font-size: 16px;">0</th>  
				<td>
					<button id="btn_addMyItem" onclick="btn_addMyItem()" title="Add Item" class="btn btn-icon small btn-outlined-primary">
						<img src="assets/images/add-primary.svg" alt="">
					</button>
				</td>
			</tr> 
		</tbody>
	</table>

	<script type="text/javascript">
		// ONLY Numeric Value
		$('#my_select_qty').keypress(function (e) {
			var x = event.charCode || event.keyCode;
			if (isNaN(String.fromCharCode(e.which)) && x != 46 || x === 32 || x === 13 || (x === 46 && event.currentTarget.innerText.includes('.'))) {
				e.preventDefault();
			} 
		});

		// Item Name and Description AutoComplete
		var ItemName = [];
		var ItemLists_json = 'assets/json/ItemLists.json';

		$.getJSON(ItemLists_json, function (data) {
			const obj_data = data;

			if (obj_data.length > 0) {
				for (var i = 0; i < obj_data[0].countRow; i++) {
					var get_itemName= obj_data[i].itemname; 
					ItemName.push(get_itemName); 
				}
			}
		});

		$('#my_select_item').autocomplete({
			delay: 0,
			source: ItemName
			// appendTo: "#AddGoods_Modal"
		});

		$('#my_select_item').on('autocompletechange change', function (e) {
			var inputName = document.getElementById('my_select_item').innerText;

			if (inputName.length > 0) {
				$.getJSON(ItemLists_json, function (item) {
					const info = item;
					for (var i = 0; i < info[0].countRow; i++) {
						if (info[i].itemname === inputName) {
							document.getElementById("my_item_id").innerText = info[i].id;
							document.getElementById("my_itemdesc").innerText = info[i].itemdesc;
						} 
					}
				});
			}
			else {
				document.getElementById("my_item_id").innerText = -1;
				document.getElementById("my_itemdesc").innerText = "";
				document.getElementById("my_select_qty").innerText = 0;
			}
		}).change();  
	</script>
<?php }

if(isset($_POST['data']) && $_POST['data']=="user_addmyitem"){
	$userid = mysqli_real_escape_string($conn, $_POST['userid']); 
	$itemid = mysqli_real_escape_string($conn, $_POST['itemid']); 
	$itemname = mysqli_real_escape_string($conn, $_POST['itemname']); 
	$qty = mysqli_real_escape_string($conn, $_POST['qty']);  

	$query_checkItem = "SELECT * FROM `tb_donation_lists` 
	WHERE `_userID`='".$userid."' AND `_donationID`='0' AND `_itemID`='".$itemid."' AND `_itemName`='".$itemname."' AND `_rcvd`='0' AND `_draft`='1'";
	$result = $conn->query($query_checkItem); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		$query = "UPDATE `tb_donation_lists` SET `_qty`=`_qty`+'".$qty."' 
		WHERE `_userID`='".$userid."' AND `_donationID`='0' AND `_itemID`='".$itemid."' AND `_itemName`='".$itemname."' AND `_rcvd`='0' AND `_draft`='1'";
	}
	else{
		$query = "INSERT INTO `tb_donation_lists`(`_userID`, `_itemID`, `_itemName`, `_itemDesc`, `_qty`) 
		SELECT '".$userid."','".$itemid."','".$itemname."',`_desc`,'".$qty."' 
		FROM `tb_item` WHERE `_id`='".$itemid."' AND `_name`='".$itemname."'"; 
	} 

	if (mysqli_query($conn, $query)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();  
}

if(isset($_GET['data']) && $_GET['data']=="user_removemyitem"){
	$id = mysqli_real_escape_string($conn, $_GET['id']); 
	$userid = mysqli_real_escape_string($conn, $_GET['userid']);

	$query_rmvMyItem= "DELETE FROM `tb_donation_lists` 
	WHERE `_id`='".$id."' AND `_userID`='".$userid."' AND `_donationID`='0' AND `_draft`='1'"; 
	
	if (mysqli_query($conn, $query_rmvMyItem)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();   
}

if (isset($_POST["data"]) && $_POST["data"] == "get_itemlists"){  
	$query = "SELECT * FROM `tb_item` WHERE `_active`='1'"; 
	$result = $conn->query($query); 
	$row_cnt = $result->num_rows;  
	$count = 1;

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<label class="form-label"><?php echo $count.'. '.htmlspecialchars($row['_name'].' - '.$row['_desc']); ?></label><br>
		<?php $count++; } 
	}
	else{ ?>
		<label class="form-label">No matching records found</label>    
	<?php } 
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="user_makevolunteer"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$age = ($_POST['age']!="")? mysqli_real_escape_string($conn, $_POST['age']): "0";
	$sex = mysqli_real_escape_string($conn, $_POST['sex']); 
	$birthdate = ($_POST['birthdate']!="")? mysqli_real_escape_string($conn, $_POST['birthdate']): "0000-01-01 00:00:00"; 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));  

	$query_makeVolunteer= "INSERT INTO `tb_employee`(`_useracctID`, `_fullname`, `_age`, `_sex`, `_birthdate`, `_address`, `_datehired`, `_role`) 
	SELECT `_id`,`_fullname`,'".$age."','".$sex."','".$birthdate."','".$address."','".date("Y-m-d H:i:s")."','VOLUNTEER' FROM `tb_useracct` WHERE `_id`='".$id ."'"; 
	$query_updateUserAcct = "UPDATE `tb_useracct` SET `_volunteer`='1' WHERE `_active`='1' AND `_id`='".$id."'";

	if (mysqli_query($conn, $query_makeVolunteer)){   
		if (mysqli_query($conn, $query_updateUserAcct)){  
			$_SESSION['st_volunteer'] = '1';
			echo json_encode(array('status'=>1)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}  
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();  
} 


/////////////////// USER - SETTINGS /////////////////////////
if(isset($_POST['data']) && $_POST['data']=="user_editprofile"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address'])); 
 
	$query_editProfile= "UPDATE `tb_useracct` SET 
	`_fullname`='".$fullname."',`_mobile`='".$mobile."',
	`_email`='".$email."',`_address`='".$address."' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_editProfile)){   
		$_SESSION['st_fullname'] = $fullname;  
		$_SESSION['st_mobile'] = $mobile;
		$_SESSION['st_email'] = $email; 
		$_SESSION['st_address'] = $address;  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="user_reqevent"){
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);  
	$datefrom = mysqli_real_escape_string($conn, $_POST['datefrom']);  
	$dateto = ($_POST['dateto']!="")? mysqli_real_escape_string($conn, $_POST['dateto']): "0000-01-01 00:00:00"; 
	$title = strtoupper(mysqli_real_escape_string($conn, $_POST['title'])); 
	$info = mysqli_real_escape_string($conn, $_POST['info']);  
 
	$query_reqEvent= "INSERT INTO `tb_events`(`_userID`, `_title`, `_body`, `_startdate`, `_enddate`, _draft) 
	VALUES ('".$userid."','".$title."','".$info."','".$datefrom."','".$dateto."','2')"; 
	
	if (mysqli_query($conn, $query_reqEvent)){  
		echo json_encode(array('status'=>1));  
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
} 


























 

/////////////////////////////////////////
/////////////// ADMIN ///////////////////
/////////////////////////////////////////
if(isset($_POST['data']) && $_POST['data']=="admin_login"){
	$uname = mysqli_real_escape_string($conn, $_POST['uname']); 
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);   

	$query = "SELECT * FROM `tb_useracct` WHERE (`_username`='".$uname."' OR `_email`='".$uname	."') 
	AND `_password`=MD5('".$pass."') AND `_role`='admin' AND `_active`='1'";
    $result = $conn->query($query); 
    $row_cnt = $result->num_rows; 

    if ($row_cnt > 0){ // Has Admin Account
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['st_admin_id'] = session_id();
            $_SESSION['st_admin_userid'] = $row['_id'];
            $_SESSION['st_admin_username'] = $row['_username'];
            $_SESSION['st_admin_fullname'] = $row['_fullname'];  
			$_SESSION['st_admin_mobile'] = $row['_mobile'];
            $_SESSION['st_admin_email'] = $row['_email']; 
            $_SESSION['st_admin_address'] = $row['_address']; 
            $_SESSION['st_admin_role'] = $row['_role'];
        } 
        echo json_encode(array('status'=>1));
    }
    else{ 
        echo json_encode(array('status'=>0));  
    }   
    $conn->close();  
} 

if (isset($_POST["data"]) && $_POST["data"] == "admin_logout"){
	try {
		unset($_SESSION['st_admin_id']);
		unset($_SESSION['st_admin_userid']);
		unset($_SESSION['st_admin_username']);
		unset($_SESSION['st_admin_fullname']); 
		unset($_SESSION['st_admin_mobile']);
		unset($_SESSION['st_admin_email']);
		unset($_SESSION['st_admin_address']);
		unset($_SESSION['st_admin_role']); 
		echo json_encode(array('status'=>1));
	} catch (\Throwable $th) {
		echo json_encode(array('status'=>0));
	}
	// if (session_destroy()){
	// 	echo json_encode(array('status'=>1));
	// }
	// else{
	// 	echo json_encode(array('status'=>0));
	// } 
}

if (isset($_POST["data"]) && $_POST["data"] == "admin_changepass"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']); 

	$query = "SELECT * FROM `tb_useracct` WHERE `_id`='".$id."' AND `_password`=MD5('".$oldpass."')";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_UpdatePass= "UPDATE `tb_useracct` SET `_password`=MD5('".$pass."') WHERE `_id`='".$id."'"; 
	
	if ($row_cnt > 0){ 
		if (mysqli_query($conn, $query_UpdatePass)){  
			echo json_encode(array('status'=>1));
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}
	else{
		echo json_encode(array('status'=>2));
	}  
	$conn->close(); 
}

if(isset($_POST['data']) && $_POST['data']=="admin_editprofile"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address'])); 
 
	$query_edtProfile= "UPDATE `tb_useracct` SET 
	`_fullname`='".$fullname."',`_mobile`='".$mobile."',
	`_email`='".$email."',`_address`='".$address."' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_edtProfile)){   
		$_SESSION['st_admin_fullname'] = $fullname;  
		$_SESSION['st_admin_mobile'] = $mobile;
		$_SESSION['st_admin_email'] = $email; 
		$_SESSION['st_admin_address'] = $address;  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
} 

if (isset($_POST["data"]) && $_POST["data"] == "get_totalassets"){ 
	$query = "SELECT * FROM `tb_monetary` WHERE 1"; 
	$result = $conn->query($query);
	
	while ($row = mysqli_fetch_assoc($result)){
		echo json_encode(array(
			'onhand'=>number_format($row['_amount_onhand'],2).' PHP'
			,'onbank'=>number_format($row['_amount_onbank'],2).' PHP'
			,'total'=>number_format($row['_total_amount'],2).' PHP'
			,'d'=>$date));
	} 
	$conn->close(); 
} 

if (isset($_POST["data"]) && $_POST["data"] == "get_pendingevent"){ 
	$query = "SELECT COUNT(*) AS `count` FROM `tb_events` WHERE `_draft`='2';"; 
	$result = $conn->query($query); 
    $row = mysqli_fetch_assoc($result);
	echo json_encode(array('status'=>$row['count']));
	$conn->close(); 
}











/////////////////// USER ACCOUNT //////////////////////
if(isset($_POST['data']) && $_POST['data']=="admin_addacct"){
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']); 
	$token = generateToken();

	$query = "SELECT * FROM `tb_useracct` WHERE `_email`='".$email."' OR `_username`='".$username."'";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_createUser= "INSERT INTO `tb_useracct`(`_username`, `_password`, `_fullname`, `_mobile`, `_email`, `_address`, `_role`, `_tokenactivation`) 
	VALUES ('".$username."',MD5('".$password."'),'".$fullname."','".$mobile."','".$email."','".$address."','user','".$token."')"; 
	
	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_createUser)){  
			echo json_encode(array('status'=>1,'token'=>$token,'u'=>$username,'p'=>$password)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}   
	$conn->close(); 
} 

if (isset($_POST["data"]) && $_POST["data"] == "get_alluseracct"){ 
	$query = "SELECT * FROM `tb_useracct` WHERE `_role`='user' ORDER BY `_fullname` ASC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">    
				 <?php if ($row['_active']=='1'): ?>
					<button onclick="btn_editUserAcct(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Edit User Account" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#EditUserAcct_Modal">
						<img src="../assets/images/edit-grey.svg" alt="" />
					</button> 
					<button onclick="btn_removeUserAcct(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Remove User Account" type="button" class="btn btn-icon small">
	 					<img src="../assets/images/remove-grey.svg" alt="" />
	 				</button>
				<?php else: ?>
					<button onclick="btn_restoreUserAcct(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Restore User Account" type="button" class="btn btn-icon small">
						<i class="nav-icon fa fa-refresh font-18 color-grey"></i>
					</button>
				<?php endif; ?> 
	 		</td> 
			<td><?php echo htmlspecialchars($row['_fullname']); ?></td> 
			<td><?php echo htmlspecialchars($row['_username']); ?></td>  
			<td><?php echo htmlspecialchars($row['_mobile']); ?></td> 
			<td><?php echo htmlspecialchars($row['_email']); ?></td> 
			<td><?php echo htmlspecialchars($row['_address']); ?></td> 
			<td>
				<?php echo ($row['_active']=='1')
					? '<span class="status success">Active</span>'
					: '<span class="status warning">Inactive</span>'; ?>
			</td>
		</tr>


		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="7" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if (isset($_GET["data"]) && $_GET["data"] == "modal_getedituseracct"){
	$id = mysqli_real_escape_string($conn, $_GET['id']); 

	$query = "SELECT * FROM `tb_useracct` WHERE `_id`='".$id."'"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo json_encode(array('status'=>1,'fname'=>$row['_fullname'],'mobile'=>$row['_mobile'],'email'=>$row['_email'],'address'=>$row['_address'])); 
		} 
	}
	else{
		echo json_encode(array('status'=>0)); 
	}
}

if(isset($_POST['data']) && $_POST['data']=="admin_editacct"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
	$email = mysqli_real_escape_string($conn, $_POST['email']); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address'])); 
 
	$query_edtUserAcct= "UPDATE `tb_useracct` SET 
	`_fullname`='".$fullname."',`_mobile`='".$mobile."',
	`_email`='".$email."',`_address`='".$address."' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_edtUserAcct)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
} 

if(isset($_GET['data']) && $_GET['data']=="admin_removeuseracct"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_removeUserAcct= "UPDATE `tb_useracct` SET `_tokenactivation`='', `_active`='0' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_removeUserAcct)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_GET['data']) && $_GET['data']=="admin_restoreuseracct"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_restoreUserAcct= "UPDATE `tb_useracct` SET `_active`='1' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_restoreUserAcct)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}



/////////////////// MANAGE PATIENT //////////////////////
if (isset($_POST["data"]) && $_POST["data"] == "get_allpatient"){ 
	$query = "SELECT *,CONCAT(`_surname`,', ',`_givenname`,' ',`_midname`) AS `concat_name` 
	FROM `tb_patient` WHERE 1 ORDER BY `_surname` ASC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">  
				<a target="_blank" href="printdata.php?id=<?php echo htmlspecialchars($row['_id']); ?>" title="Print Patient Information" type="button" class="btn btn-icon small">
					<i class="nav-icon fa fa-print font-18 color-grey"></i>
				</a>  
				<button onclick="btn_infoPatient(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Show Patient Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#ShowPatient_Modal">
					<i class="nav-icon fa fa-info font-18 color-grey"></i>
				</button>  
				<button onclick="btn_infoPatientMedHistory(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Show Patient Medical History" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#ShowPatientMedHistory_Modal">
					<i class="nav-icon fa fa-heartbeat font-18 color-grey"></i>
				</button>  
				<button onclick="btn_getpatientid(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Add to Medical Record" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#DeceasedPatient_Modal">
					<i class="nav-icon fa fa-plus-circle font-18 color-grey"></i>
				</button>
				 <?php if ($row['_active']=='1'): ?>
					<button onclick="btn_editPatient(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Edit Patient Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#EditPatient_Modal">
	 					<img src="../assets/images/edit-grey.svg" alt="" />
	 				</button> 
					<button onclick="btn_getpatientid(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Remove Patient Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#RemovePatient_Modal">
	 					<img src="../assets/images/remove-grey.svg" alt="" />
	 				</button> 
				<?php else: ?>
					<button onclick="btn_getpatientid(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Restore Patient Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#RestorePatient_Modal">
						<i class="nav-icon fa fa-refresh font-18 color-grey"></i>
					</button>
				<?php endif; ?> 
	 		</td> 
			<td><?php echo date("M d, Y", strtotime($row['_dateentered'])); ?></td>
			<td><?php echo htmlspecialchars($row['concat_name']); ?></td> 
			<td><?php echo htmlspecialchars($row['_age'].' YO'); ?></td>   
			<td>
				<?php echo ($row['_birthdate']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_birthdate'])): "N/A";?>
			</td>  
			<td>
				<?php if ($row['_active']=='1'): ?>
					<span class="status success">Active</span>
				<?php elseif ($row['_active']=='2'): ?>
					<span class="status danger">Deceased</span>
				<?php else: ?>
					<span class="status warning">Inactive</span>
				<?php endif; ?>  
			</td>
		</tr> 
		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="8" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if(isset($_GET['data']) && $_GET['data']=="admin_removepatient"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_removePatient= "UPDATE `tb_patient` SET `_active`='0' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_removePatient)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_POST['data']) && $_POST['data']=="admin_deceasedpatient"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);   
	$physician = strtoupper(mysqli_real_escape_string($conn, $_POST['physician']));   
	$date = mysqli_real_escape_string($conn, $_POST['date']);   
	$cause = strtoupper(mysqli_real_escape_string($conn, $_POST['cause']));   

	$query_deceasedPatient= "UPDATE `tb_patient` 
	SET `_active`='2', `_datedied`='".$date."', `_physician`='".$physician."', `_causeofdeath`='".$cause."' 
	WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_deceasedPatient)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_GET['data']) && $_GET['data']=="admin_restorepatient"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_restorePatient= "UPDATE `tb_patient` SET `_active`='1' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_restorePatient)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_POST['data']) && $_POST['data']=="admin_addpatient"){
	$dateentered = mysqli_real_escape_string($conn, $_POST['dateentered']); 
	$surname = strtoupper(mysqli_real_escape_string($conn, $_POST['surname']));
	$givenname = strtoupper(mysqli_real_escape_string($conn, $_POST['givenname']));
	$midname = strtoupper(mysqli_real_escape_string($conn, $_POST['midname'])); 
	$nickname = strtoupper(mysqli_real_escape_string($conn, $_POST['nickname']));  
	$birthdate = ($_POST['birthdate']!= "")? mysqli_real_escape_string($conn, $_POST['birthdate']): "0000-01-01 00:00:00";
	$birthplace = strtoupper(mysqli_real_escape_string($conn, $_POST['birthplace'])); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));   
	$religion = strtoupper(mysqli_real_escape_string($conn, $_POST['religion']));
	$education = strtoupper(mysqli_real_escape_string($conn, $_POST['education'])); 
	$spouse = strtoupper(mysqli_real_escape_string($conn, $_POST['spouse']));   
	$age = ($_POST['age']!= "")? mysqli_real_escape_string($conn, $_POST['age']): "0"; 
	$disable = strtoupper(mysqli_real_escape_string($conn, $_POST['disable']));   
	$skill = strtoupper(mysqli_real_escape_string($conn, $_POST['skill']));
	$relative = strtoupper(mysqli_real_escape_string($conn, $_POST['relative'])); 
	$referral = strtoupper(mysqli_real_escape_string($conn, $_POST['referral']));  
	$referraladdress = strtoupper(mysqli_real_escape_string($conn, $_POST['referraladdress'])); 
	$referralreason = strtoupper(mysqli_real_escape_string($conn, $_POST['referralreason']));  

	$query = "SELECT * FROM `tb_patient` WHERE `_surname`='".$surname."' AND `_givenname`='".$givenname."' AND `_midname`='".$midname."'";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_createPatient= "INSERT INTO `tb_patient`(`_dateentered`, `_surname`, `_givenname`, `_midname`, 
	`_nickname`, `_birthdate`, `_birthplace`, `_address`, 
	`_religion`, `_education`, `_spouse`, `_age`, 
	`_disable`, `_skill`, `_relative`, `_referral`, 
	`_referraladdress`, `_referralreason`, `_datedied`) 
	VALUES ('".$dateentered."','".$surname."','".$givenname."','".$midname."',
	'".$nickname."','".$birthdate."','".$birthplace."','".$address."',
	'".$religion."','".$education."','".$spouse."','".$age."',
	'".$disable."','".$skill."','".$relative."','".$referral."',
	'".$referraladdress."','".$referralreason."', '0000-01-01 00:00:00')"; 

	$query_updateRelation = "UPDATE `tb_patientrelation` 
	SET `_patientID`=(SELECT `_id` FROM `tb_patient` WHERE DATE(`_datecreated`)=CURDATE() ORDER BY `_id` DESC LIMIT 1), `_draft`='0' 
	WHERE `_patientID`='0' AND `_draft`='1' AND DATE(`_datecreated`)=CURDATE()";
	
	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_createPatient)){  
			if (mysqli_query($conn, $query_updateRelation)){
				echo json_encode(array('status'=>1)); 
			}
			else{
				echo json_encode(array('status'=>0));
			}  
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}   
	$conn->close(); 
} 

if (isset($_GET["data"]) && $_GET["data"] == "modal_geteditpatient"){
	$id = mysqli_real_escape_string($conn, $_GET['id']); 

	$query = "SELECT `_id`, `_surname`, `_givenname`, `_midname`, `_nickname`, 
	DATE(`_birthdate`) AS `_birthdate`, `_birthplace`, `_address`, `_religion`, 
	`_education`, `_spouse`, `_age`, `_disable`, `_skill`, `_relative`, `_referral`, 
	`_referraladdress`, `_referralreason`, DATE(`_dateentered`) AS `_dateentered`, 
	DATE(`_datedied`) AS `_datedied`, `_physician`, `_causeofdeath`, `_active` 
	FROM `tb_patient` WHERE `_id`='".$id."'"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo json_encode(array('status'=>1
			,'surname'=>$row['_surname']
			,'givenname'=>$row['_givenname']
			,'midname'=>$row['_midname']
			,'nickname'=>$row['_nickname']
			,'birthdate'=>$row['_birthdate']
			,'birthplace'=>$row['_birthplace']
			,'address'=>$row['_address']
			,'religion'=>$row['_religion']
			,'education'=>$row['_education']
			,'spouse'=>$row['_spouse']
			,'age'=>$row['_age']
			,'disable'=>$row['_disable']
			,'skill'=>$row['_skill']
			,'relative'=>$row['_relative']
			,'referral'=>$row['_referral']
			,'referraladdress'=>$row['_referraladdress']
			,'referralreason'=>$row['_referralreason']
			,'dateentered'=>$row['_dateentered']
			,'datedied'=>$row['_datedied']
			,'physician'=>$row['_physician']
			,'causeofdeath'=>$row['_causeofdeath']
			,'active'=>$row['_active'])); 
		} 
	}
	else{
		echo json_encode(array('status'=>0)); 
	}
}

if(isset($_POST['data']) && $_POST['data']=="admin_editpatient"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);   
	$dateentered = ($_POST['dateentered']!="")? mysqli_real_escape_string($conn, $_POST['dateentered']): "0000-01-01 00:00:00"; 
	$surname = strtoupper(mysqli_real_escape_string($conn, $_POST['surname']));
	$givenname = strtoupper(mysqli_real_escape_string($conn, $_POST['givenname']));
	$midname = strtoupper(mysqli_real_escape_string($conn, $_POST['midname'])); 
	$nickname = strtoupper(mysqli_real_escape_string($conn, $_POST['nickname']));  
	$birthdate = ($_POST['birthdate']!="")? mysqli_real_escape_string($conn, $_POST['birthdate']): "0000-01-01 00:00:00";
	$birthplace = strtoupper(mysqli_real_escape_string($conn, $_POST['birthplace'])); 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));   
	$religion = strtoupper(mysqli_real_escape_string($conn, $_POST['religion']));
	$education = strtoupper(mysqli_real_escape_string($conn, $_POST['education'])); 
	$spouse = strtoupper(mysqli_real_escape_string($conn, $_POST['spouse']));   
	$age = ($_POST['age']!="")? mysqli_real_escape_string($conn, $_POST['age']): "0"; 
	$disable = strtoupper(mysqli_real_escape_string($conn, $_POST['disable']));   
	$skill = strtoupper(mysqli_real_escape_string($conn, $_POST['skill']));
	$relative = strtoupper(mysqli_real_escape_string($conn, $_POST['relative'])); 
	$referral = strtoupper(mysqli_real_escape_string($conn, $_POST['referral']));  
	$referraladdress = strtoupper(mysqli_real_escape_string($conn, $_POST['referraladdress'])); 
	$referralreason = strtoupper(mysqli_real_escape_string($conn, $_POST['referralreason']));  
 
	$query_editPatient= "UPDATE `tb_patient` SET `_surname`='".$surname."',`_givenname`='".$givenname."',`_midname`='".$midname."'
	,`_nickname`='".$nickname."',`_birthdate`='".$birthdate."',`_birthplace`='".$birthplace."',`_address`='".$address."'
	,`_religion`='".$religion."',`_education`='".$education."',`_spouse`='".$spouse."',`_age`='".$age."',`_disable`='".$disable."'
	,`_skill`='".$skill."',`_relative`='".$relative."',`_referral`='".$referral."',`_referraladdress`='".$referraladdress."'
	,`_referralreason`='".$referralreason."',`_dateentered`='".$dateentered."' 
	WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_editPatient)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();  
} 

if (isset($_POST["data"]) && $_POST["data"] == "get_patientinfo"){ 
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$query_patientInfo = "SELECT * FROM `tb_patient` WHERE `_id`='".$id."'"; 
	$result = $conn->query($query_patientInfo);
	$row = mysqli_fetch_assoc($result);  

	$query_patientFamily= "SELECT * FROM `tb_patientrelation` WHERE `_patientID`='".$id."' AND `_draft`='0' ORDER BY `_id` ASC"; 
	$result2 = $conn->query($query_patientFamily);
	$row_cnt = $result2->num_rows; 
	?> 
	<div class="row"> 
		<div class="col-md-2">
			<div class="form-group">
				<label class="form-label">Status:</label>
				<?php if ($row['_active']=='1'): ?>
					<span class="status success">Active</span>
				<?php elseif ($row['_active']=='2'): ?>
					<span class="status danger">Deceased</span> 
				<?php else: ?>
					<span class="status warning">Inactive</span>
				<?php endif; ?>  
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group text-center">
				<a class="form-label" style="font-weight: bold;">ST. VINCENT STRAMBI HOME FOR THE AGED, INC.</a><br>
				<a class="form-label">Prk. Mangga Brgy. City Heights</a><br>
				<a class="form-label">General Santos City</a><br>
				<a class="form-label">Tel. No. 552-7500</a><br>
			</div> 
		</div>
	</div> 
	<div class="row">
		<div class="col-md-10"></div>   
		<div class="col-md-2">
			<div class="form-group">
				<label class="form-label">Date of Entry </label>
				<input disabled value="<?php echo ($row['_dateentered']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_dateentered'])): "N/A";?>" type="text" class="form-control" />
			</div>
		</div>  
	</div> 
	<div class="row">
		<div class="col-md-12">
			<div class="form-group text-center">
				<a class="form-label" style="font-weight: bold;font-size: 18px;">GENERAL INTAKE SHEET</a><br> 
			</div> 
		</div> 
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Surname </label>
				<input disabled value="<?php echo htmlspecialchars($row['_surname']); ?>" type="text" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Given Name </label>
				<input disabled value="<?php echo htmlspecialchars($row['_givenname']); ?>" type="text" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Middle Name </label>
				<input disabled value="<?php echo htmlspecialchars($row['_midname']); ?>" type="text" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Nickname </label>
				<input disabled value="<?php echo htmlspecialchars($row['_nickname']); ?>" type="text" class="form-control" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<label class="form-label">Date of Birth</label>
				<input disabled value="<?php echo ($row['_birthdate']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_birthdate'])): "N/A";?>" type="text" class="form-control" />
			</div>
		</div>  
		<div class="col-md-10">
			<div class="form-group">
				<label class="form-label">Place of Birth</label>
				<input disabled value="<?php echo htmlspecialchars($row['_birthplace']); ?>" type="text" class="form-control" />
			</div>
		</div>  
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Address</label>
				<textarea disabled class="form-control" rows="3"><?php echo htmlspecialchars($row['_address']); ?></textarea>
			</div>
		</div>   
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label">Religion</label>
				<input disabled value="<?php echo htmlspecialchars($row['_religion']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label">Educational Attainment</label>
				<input disabled value="<?php echo htmlspecialchars($row['_education']); ?>" type="text" class="form-control" /> 
			</div>
		</div>  
	</div>
	<div class="row">
		<div class="col-md-10">
			<div class="form-group">
				<label class="form-label">Name of Spouse</label>
				<input disabled value="<?php echo htmlspecialchars($row['_spouse']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
		<div class="col-md-2">
			<div class="form-group">
				<label class="form-label">Age</label>
				<input disabled value="<?php echo htmlspecialchars($row['_age']); ?>" type="text" class="form-control" /> 
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">If Applicant is disabled, indicate nature of disability</label>
				<input disabled value="<?php echo htmlspecialchars($row['_disable']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Skill/ Interest</label>
				<input disabled value="<?php echo htmlspecialchars($row['_skill']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Name of Nearest Relative</label>
				<input disabled value="<?php echo htmlspecialchars($row['_relative']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Source of Referral</label>
				<input disabled value="<?php echo htmlspecialchars($row['_referral']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Address</label>
				<input disabled value="<?php echo htmlspecialchars($row['_referraladdress']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Reason/s</label>
				<input disabled value="<?php echo htmlspecialchars($row['_referralreason']); ?>" type="text" class="form-control" /> 
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group" style="margin-top: 20PX;">
				<a class="form-label" style="font-weight: bold;font-size: 18px;">FAMILY COMPOSITION</a><br> 
			</div> 
		</div> 
	</div>
	<div class="row">
		<table class="table primary-table table-hover">
			<thead>
				<tr>  
					<th>#</th>
					<th>Name</th>
					<th>Age</th> 
					<th>Sex</th>
					<th>Relation to Client</th>
					<th>Civil Status</th> 
					<th>Educt'l Attainment</th>
					<th>Occupation</th> 
					<th>Company Connected</th> 
				</tr>
			</thead>
			<tbody>
				<?php if($row_cnt > 0): $count=1; while($row2 = mysqli_fetch_assoc($result2)): ?>
					<tr> 
						<td><?php echo $count; ?></td>
						<td><?php echo htmlspecialchars($row2['_name']); ?></th> 
						<td><?php echo htmlspecialchars($row2['_age']); ?></th>
						<td><?php echo (htmlspecialchars($row2['_sex'])=="M")? "Male" : "Female"; ?></th>
						<td><?php echo htmlspecialchars($row2['_relation']); ?></th>
						<td><?php echo htmlspecialchars($row2['_status']); ?></th>
						<td><?php echo htmlspecialchars($row2['_education']); ?></th>
						<td><?php echo htmlspecialchars($row2['_occupation']); ?></th>
						<td><?php echo htmlspecialchars($row2['_company']); ?></th>
					</tr>
					<?php $count++; endwhile; ?>
				<?php else: ?>
					<tr> 
						<td colspan="9" style="text-align: center;">No matching records found</th> 
					</tr>
				<?php endif; ?> 
			</tbody>
		</table>
	</div> 
<?php $conn->close(); } 

if (isset($_POST["data"]) && $_POST["data"] == "get_patientmedhistory"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$query_patientMedHistory = "SELECT * FROM `tb_patientmedical` WHERE `_patientID`='".$id."'"; 
	$result = $conn->query($query_patientMedHistory);
	$row_cnt = $result->num_rows; 

	$query_patientInfo = "SELECT * FROM `tb_patient` WHERE `_id`='".$id."'"; 
	$result2 = $conn->query($query_patientInfo);
	$row2 = mysqli_fetch_assoc($result2); ?>

	<div class="row">
		<table class="table primary-table table-hover">
			<thead>
				<tr>  
					<th>#</th>
					<th>Date</th>
					<th>Remarks</th> 
				</tr>
			</thead>
			<tbody>
				<?php if($row_cnt > 0): $count=1; while($row = mysqli_fetch_assoc($result)): ?>
					<tr> 
						<td><?php echo $count; ?></td>
						<td>
							<?php echo ($row['_date']!="0000-01-01")? date("M d, Y", strtotime($row['_date'])): "N/A";?> 
						</th> 
						<td><?php echo htmlspecialchars($row['_remarks']); ?></th>
					</tr>
					<?php $count++; endwhile; ?>
				<?php else: ?>
					<tr> 
						<td colspan="3" style="text-align: center;">No matching records found</th> 
					</tr>
				<?php endif; ?> 
			</tbody>
		</table>
	</div>

	<?php if ($row2['_active']=="2"): ?>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 20PX;">
					<a class="form-label" style="font-weight: bold;font-size: 18px;">OTHER INFORMATION</a><br> 
				</div> 
			</div> 
		</div> 
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-label">Deceased Date </label>
					<input disabled value="<?php echo ($row2['_datedied']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row2['_datedied'])): "N/A";?>" type="text" class="form-control" />
				</div>
			</div> 
			<div class="col-md-8">
				<div class="form-group">
					<label class="form-label">Attending Physician</label>
					<input  disabled value="<?php echo (htmlspecialchars($row2['_physician'])!="")? htmlspecialchars($row2['_physician']): "N/A"; ?>" type="text" class="form-control" />
				</div>
			</div>   
		</div> 
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label">Cause of Death </label>
					<textarea class="form-control" rows="3" disabled><?php echo (htmlspecialchars($row2['_causeofdeath'])!="")? htmlspecialchars($row2['_causeofdeath']): "N/A"; ?></textarea>
				</div>
			</div> 
		</div>
	<?php endif; ?>
<?php $conn->close(); }

if(isset($_POST['data']) && $_POST['data']=="admin_addpatientfamily"){
	$name = strtoupper(mysqli_real_escape_string($conn, $_POST['name']));
	$age = ($_POST['age']!="")? mysqli_real_escape_string($conn, $_POST['age']): "0";
	$sex = mysqli_real_escape_string($conn, $_POST['sex']); 
	$relation = strtoupper(mysqli_real_escape_string($conn, $_POST['relation'])); 
	$status = strtoupper(mysqli_real_escape_string($conn, $_POST['status']));
	$educ = strtoupper(mysqli_real_escape_string($conn, $_POST['educ']));
	$occu = strtoupper(mysqli_real_escape_string($conn, $_POST['occu'])); 
	$company = strtoupper(mysqli_real_escape_string($conn, $_POST['company']));   

	$query = "SELECT * FROM `tb_patientrelation` WHERE `_name`='".$name."' AND `_patientID`='0' AND `_draft`='1' AND DATE(`_datecreated`)=CURDATE()";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_createPatientFam= "INSERT INTO `tb_patientrelation`(`_name`, `_age`, `_sex`, 
	`_relation`, `_status`, `_education`, `_occupation`, `_company`) 
	VALUES ('".$name."','".$age."','".$sex."','".$relation."','".$status."','".$educ."','".$occu."','".$company."')"; 
	
	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_createPatientFam)){  
			echo json_encode(array('status'=>1)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}   
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="admin_addpatientfamilyonedit"){
	$id = strtoupper(mysqli_real_escape_string($conn, $_POST['id']));
	$name = strtoupper(mysqli_real_escape_string($conn, $_POST['name']));
	$age = ($_POST['age']!="")? mysqli_real_escape_string($conn, $_POST['age']): "0";
	$sex = mysqli_real_escape_string($conn, $_POST['sex']); 
	$relation = strtoupper(mysqli_real_escape_string($conn, $_POST['relation'])); 
	$status = strtoupper(mysqli_real_escape_string($conn, $_POST['status']));
	$educ = strtoupper(mysqli_real_escape_string($conn, $_POST['educ']));
	$occu = strtoupper(mysqli_real_escape_string($conn, $_POST['occu'])); 
	$company = strtoupper(mysqli_real_escape_string($conn, $_POST['company']));   

	$query = "SELECT * FROM `tb_patientrelation` WHERE `_name`='".$name."' AND `_patientID`='".$id."' AND `_draft`='0'";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_createPatientFam= "INSERT INTO `tb_patientrelation`(`_patientID`, `_name`, `_age`, `_sex`, 
	`_relation`, `_status`, `_education`, `_occupation`, `_company`, `_draft`) 
	VALUES ('".$id."','".$name."','".$age."','".$sex."','".$relation."','".$status."','".$educ."','".$occu."','".$company."','0')"; 
	
	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_createPatientFam)){  
			echo json_encode(array('status'=>1)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}   
	$conn->close();  
} 

if(isset($_POST['data']) && $_POST['data']=="admin_patientaddmed"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);    
	$date = ($_POST['date']!="")? mysqli_real_escape_string($conn, $_POST['date']): "0000-01-01 00:00:00";   
	$remarks = strtoupper(mysqli_real_escape_string($conn, $_POST['remarks']));   

	$query_patientAddMed= "INSERT INTO `tb_patientmedical`(`_patientID`, `_date`, `_remarks`) 
	VALUES ('".$id."','".$date."','".$remarks."')"; 
	
	if (mysqli_query($conn, $query_patientAddMed)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();  
}


/////////////////// DONATION //////////////////////
if (isset($_POST["data"]) && $_POST["data"] == "get_alldonor"){ 
	$query = "SELECT * FROM `tb_donation` WHERE 1 ORDER BY `_date` DESC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">    
				<button onclick="btn_infoDonor(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Show Donor's Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#ShowDonor_Modal">
					<i class="nav-icon fa fa-info font-18 color-grey"></i>
				</button> 
				<?php if ($row['_status']=='0'): ?>
					<?php if ($row['_type']=='G'): ?>
						<button onclick="btn_addGoods(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Add Item/ Goods" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#AddGoods_Modal">
							<i class="nav-icon fa fa-cart-plus font-18 color-grey"></i>
						</button>
					<?php endif; ?> 
					<button onclick="btn_completedDonor(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Completed" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#CompletedDonor_Modal">
						<i class="nav-icon fa fa-check font-18 color-grey"></i>
					</button> 
				<?php endif; ?> 
	 		</td>  
			<td>
				<?php if ($row['_date']!="0000-01-01 00:00:00"): ?>
					<?php echo date("M d, Y", strtotime($row['_date'])).'<br>'.date("h:i A", strtotime($row['_date'])); ?>
				<?php else: ?>
					N/A
				<?php endif; ?> 
			</td>    
			<td><?php echo htmlspecialchars($row['_fullname']); ?></td>  
			<td><?php echo htmlspecialchars($row['_mobile']); ?></td>   
			<td> 
				<span class="status info">
					<?php echo ($row['_type']=="M")? "Monetary": "Goods"; ?>
					<?php if ($row['_type']=="M" && $row['_mop']=="C"): echo "- Cash" ?>
					<?php elseif ($row['_type']=="M" && $row['_mop']=="CHK"): echo "- Check" ?>
					<?php else: ?> 
					<?php endif; ?>   
			</span>
			</td> 
			<td>
				<?php if ($row['_status']=='1'): ?>
					<span class="status success">Received</span>
				<?php elseif ($row['_status']=='2'): ?>
					<span class="status danger">Cancelled</span> 
				<?php else: ?>
					<span class="status warning">Pending</span>
				<?php endif; ?>  
			</td>
		</tr> 
		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="6" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="admin_adddonation"){ 
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address'])); 
	$type = mysqli_real_escape_string($conn, $_POST['type']); 
	$payment = mysqli_real_escape_string($conn, $_POST['payment']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);  
	$amount_cash = mysqli_real_escape_string($conn, $_POST['amount_cash']); 
	$bankname = strtoupper(mysqli_real_escape_string($conn, $_POST['bankname'])); 
	$checkno = strtoupper(mysqli_real_escape_string($conn, $_POST['checkno'])); 
	$amount_check = mysqli_real_escape_string($conn, $_POST['amount_check']); 

	if ($type == "G"){
		$getamount = "0"; 
	}
	else{
		$getamount = ($payment == "C")? $amount_cash: $amount_check; 
	} 

	$query_addDonor = "INSERT INTO `tb_donation`(`_fullname`, `_mobile`, `_address`, 
	`_type`, `_date`, `_mop`, `_amount`, 
	`_bankname`, `_checkno`, `_remarks`) 
	VALUES ('".$fullname."','".$mobile."','".$address."',
	'".$type."','0000-01-01 00:00:00','".$payment."','".$getamount."',
	'".$bankname."','".$checkno."','".$remarks."')"; 

	if (mysqli_query($conn, $query_addDonor)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();  
}

if(isset($_GET['data']) && $_GET['data']=="admin_canceldonation"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_cancelDonation= "UPDATE `tb_donation` SET `_status`='2' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_cancelDonation)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_GET['data']) && $_GET['data']=="admin_confirmdonation"){	
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query = "SELECT * FROM `tb_donation` WHERE `_id`='".$id."'";
    $result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

    if ($row_cnt > 0){ // Has Data
		$row = mysqli_fetch_assoc($result);
		$amount = $row['_amount'];

		if ($row['_type']=="M"){ // Money
			if ($row['_mop']=="C"){ // Cash
				$query_updateDonation = "UPDATE `tb_monetary` 
				SET `_amount_onhand`=(`_amount_onhand`+$amount),`_total_amount`=(`_total_amount`+$amount) WHERE `_id`='1'";
			}
			else{ // CHK - Check
				$query_updateDonation = "UPDATE `tb_monetary` 
				SET `_amount_onbank`=(`_amount_onbank`+$amount),`_total_amount`=(`_total_amount`+$amount) WHERE `_id`='1'";
			}

			if (mysqli_query($conn, $query_updateDonation)){   
				$query_confirmDonation= "UPDATE `tb_donation` SET `_status`='1', `_date`='".date("Y-m-d H:i:s")."' WHERE `_id`='".$id."'"; 
		
				if (mysqli_query($conn, $query_confirmDonation)){  
					echo json_encode(array('status'=>1)); 
				}
				else{
					echo json_encode(array('status'=>0));
				}   
			}
			else{
				echo json_encode(array('status'=>0));
			}  
		}
		else{ // Goods
			$query_updateItemInv = "UPDATE `tb_item` a
			INNER JOIN `tb_donation_lists` b
			ON a._id = b._itemID
			SET a.`_stock` = (a.`_stock` + b.`_qty`)
			WHERE a.`_active`='1' AND b.`_donationID`='".$id."' AND b.`_rcvd`='0' AND b.`_draft`='0'; ";

			$query_updateDonateLists = "UPDATE `tb_donation_lists` SET `_rcvd`='1' 
			WHERE `_donationID`='".$id."' AND `_rcvd`='0' AND `_draft`='0'";

			$query_confirmDonation= "UPDATE `tb_donation` SET `_status`='1', `_date`='".date("Y-m-d H:i:s")."' WHERE `_id`='".$id."'"; 

			try {
				mysqli_query($conn, $query_updateItemInv);
				mysqli_query($conn, $query_updateDonateLists);
				mysqli_query($conn, $query_confirmDonation);
				echo json_encode(array('status'=>1)); 
			} 
			catch (\Throwable $th) {
				echo json_encode(array('status'=>0));
			}    
		}    
    }
    else{ 
        echo json_encode(array('status'=>2));  
    }   
	$conn->close();  
}

if (isset($_POST["data"]) && $_POST["data"] == "get_infodonor"){ 
	$id = mysqli_real_escape_string($conn, $_POST['id']); 
	// $query_infoDonor = "SELECT COUNT(*) OVER() AS `numrows`, a.*,b.* FROM `tb_donation_lists` a 
	// LEFT JOIN `tb_donation` b ON a.`_donationID`=b.`_id` 
	// WHERE a.`_donationID`='".$id."' ORDER BY a.`_id` ASC"; 
	$query_infoDonor = "SELECT * FROM `tb_donation` WHERE `_id`='".$id."'"; 
	$result = $conn->query($query_infoDonor);
	$row = mysqli_fetch_assoc($result); 

	$query_getItem = "SELECT *, COUNT(*) OVER() AS `numrows` FROM `tb_donation_lists` WHERE `_donationID`='".$id."' AND `_draft`='0'";
	$result2 = $conn->query($query_getItem); 
    $row_cnt = $result2->num_rows;  
	?> 
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label">Status:</label>
			<?php if ($row['_status']=='1'): ?>
				<span class="status success">Received</span>
			<?php elseif ($row['_status']=='2'): ?>
				<span class="status danger">Cancelled</span> 
			<?php else: ?>
				<span class="status warning">Pending</span>
			<?php endif; ?>  
		</div>
	</div>  
	<div class="col-md-6">
		<div class="form-group"> 
			<?php if ($row['_date']!="0000-01-01 00:00:00"): ?>
				<label class="form-label">Date Received</label>
				<input type="date" class="form-control" value="<?php echo date("Y-m-d", strtotime($row['_date'])); ?>" disabled>
			<?php endif; ?> 
		</div>
	</div>  
	<div class="col-md-7">
		<div class="form-group">
			<label class="form-label">Donor's Full Name</label>
			<input type="text" class="form-control" value="<?php echo htmlspecialchars($row['_fullname']); ?>" disabled>
		</div>
	</div>
	<div class="col-md-5">
		<div class="form-group">
			<label class="form-label">Mobile</label>
			<input type="number" class="form-control" value="<?php echo htmlspecialchars($row['_mobile']); ?>" disabled>
		</div>
	</div>
	<div class="col-md-6"></div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label">Address</label>
			<textarea class="form-control" rows="3" disabled><?php echo htmlspecialchars($row['_address']); ?></textarea>
		</div>
	</div>    
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">Type: 
				<span class="status info"><?php echo ($row['_type']=="M")? "Monetary": "Goods"; ?></span>
			</label> 
		</div>
	</div>   

	<?php if ($row['_type']=="G"): ?>
		<div class="col-md-12">
			<table class="table primary-table table-hover" style="margin-bottom: 30px;">
				<thead>
					<tr>  
						<th>#</th>
						<th>Item Name</th> 
						<th>Description</th>
						<th>QTY</th>
						<th>Status</th> 
					</tr>
				</thead>
				<tbody>
					<?php if ($row_cnt > 0): 
						$count=1; ?>
						<?php while($row2 = mysqli_fetch_assoc($result2)): ?>
							<tr>  
								<td><?php echo $count; ?></td>
								<td><?php echo htmlspecialchars($row2['_itemName']); ?></th>
								<td><?php echo htmlspecialchars($row2['_itemDesc']); ?></th>
								<td><?php echo number_format($row2['_qty'],2); ?></th>
								<td>
									<span class="status <?php echo ($row2['_rcvd']=="1")? "success": "warning"; ?>">
										<?php echo ($row2['_rcvd']=="1")? "Received": "Pending"; ?>
									</span>
								</th> 
							</tr> 
						<?php $count++; endwhile; ?>
					<?php else: ?>
						<tr> 
							<td colspan="5" style="text-align: center;">No matching records found</th> 
						</tr>
					<?php endif; ?> 
				</tbody> 
			</table>
		</div> 
	<?php endif; ?>  
	
	<?php if ($row['_type']=="M"): ?>
		<div class="col-md-3">
			<div class="form-group">
				<label class="form-label">Payment: 
					<span class="status info"><?php echo ($row['_mop']=="C")? "Cash": "Check"; ?></span> 
				</label> 
			</div>
		</div>    
	<?php endif; ?>   
	 
	<?php if ($row['_type']=="M" && $row['_mop']=="C"): ?>
		<div class="col-md-3">
			<div class="form-group"> 
				<input type="text" class="form-control" value="<?php echo number_format($row['_amount'],2).' PHP'; ?>" disabled>
			</div>
		</div> 
	<?php elseif ($row['_type']=="M" && $row['_mop']=="CHK"): ?>
		<div class="row" style="padding: 0px 18px 0px 18px;">
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label text-orange">Bank Information</label>
				</div> 
			</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Bank Name</label>
					<input type="text" class="form-control" value="<?php echo htmlspecialchars($row['_bankname']); ?>" disabled>
				</div>
			</div>  
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Check Reference No.</label>
					<input type="text" class="form-control" value="<?php echo htmlspecialchars($row['_checkno']); ?>" disabled>
				</div>
			</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label class="form-label">Amount</label>
					<input type="text" class="form-control" value="<?php echo number_format($row['_amount'],2).' PHP'; ?>" disabled>
				</div>
			</div>  
			<div class="col-md-6"></div>
		</div> 
	<?php else: ?>
	<?php endif; ?>   

	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label">Remarks</label>
			<textarea class="form-control" rows="3" disabled><?php echo htmlspecialchars($row['_remarks']); ?></textarea>
		</div>
	</div>   

	<?php if ($row['_upload']!=""): ?>
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Uploaded Image</label>
				<img src="<?php echo htmlspecialchars('../assets/uploadfile/'.$row['_upload']); ?>" style="width: 100%;" />
			</div>
		</div> 
	<?php endif; ?>
<?php } 

if(isset($_POST['data']) && $_POST['data']=="admin_additem"){
	$id = mysqli_real_escape_string($conn, $_POST['id']); 
	$itemid = mysqli_real_escape_string($conn, $_POST['itemid']); 
	$itemname = mysqli_real_escape_string($conn, $_POST['itemname']); 
	$qty = mysqli_real_escape_string($conn, $_POST['qty']); 

	$query_checkItem = "SELECT * FROM `tb_donation_lists` 
	WHERE `_donationID`='".$id."' AND `_itemID`='".$itemid."' AND `_itemName`='".$itemname."' AND `_rcvd`='0' AND `_draft`='0'";
	$result = $conn->query($query_checkItem); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		$query = "UPDATE `tb_donation_lists` SET `_qty`=`_qty`+'".$qty."' 
		WHERE `_donationID`='".$id."' AND `_itemID`='".$itemid."' AND `_itemName`='".$itemname."' AND `_rcvd`='0' AND `_draft`='0'";
	}
	else{
		$query = "INSERT INTO `tb_donation_lists`(`_donationID`, `_itemID`, `_itemName`, `_itemDesc`, `_qty`,`_draft`) 
		SELECT '".$id."','".$itemid."','".$itemname."',`_desc`,'".$qty."','0' FROM `tb_item` WHERE `_id`='".$itemid."' AND `_name`='".$itemname."'"; 
	} 

	if (mysqli_query($conn, $query)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close();  
}



/////////////////////// EMPLOYEE / VOLUNTEER //////////////////
if (isset($_POST["data"]) && $_POST["data"] == "get_allemp"){ 
	$query = "SELECT * FROM `tb_employee` WHERE 1 ORDER BY `_fullname` ASC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">   
				 <?php if ($row['_active']=='1'): ?>
					<button onclick="btn_editEmp(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Edit Employee/ Volunteer Data" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#EditEmp_Modal">
	 					<img src="../assets/images/edit-grey.svg" alt="" />
	 				</button> 
					<button onclick="btn_removeEmp(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Remove Employee/ Volunteer Data" type="button" class="btn btn-icon small">
	 					<img src="../assets/images/remove-grey.svg" alt="" />
	 				</button>
				<?php else: ?>
					<button onclick="btn_restoreEmp(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Restore Employee/ Volunteer Data" type="button" class="btn btn-icon small">
						<i class="nav-icon fa fa-refresh font-18 color-grey"></i>
					</button>
				<?php endif; ?> 
	 		</td> 
			<td><?php echo htmlspecialchars($row['_fullname']); ?></td> 
			<td><?php echo ($row['_age']!="0")? htmlspecialchars($row['_age'].' YO'): "N/A"; ?></td>  
			<td><?php echo htmlspecialchars($row['_sex']); ?></td> 
			<td><?php echo ($row['_birthdate']!="0000-01-01 00:00:00")? date("M d, Y", strtotime($row['_birthdate'])): "N/A"; ?></td> 
			<td><?php echo date("M d, Y", strtotime($row['_datehired'])); ?></td> 
			<td><?php echo htmlspecialchars($row['_role']); ?></td>
			<td>
				<?php if ($row['_active']=='1'): ?>
					<span class="status success">Active</span> 
				<?php else: ?>
					<span class="status warning">Inactive</span>
				<?php endif; ?>  
			</td>
		</tr>


		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="8" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="admin_addemp"){
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$age = ($_POST['age']!="")? mysqli_real_escape_string($conn, $_POST['age']): "0";
	$sex = mysqli_real_escape_string($conn, $_POST['sex']); 
	$birthdate = ($_POST['birthdate']!="")? mysqli_real_escape_string($conn, $_POST['birthdate']): "0000-01-01 00:00:00"; 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
	$role = strtoupper(mysqli_real_escape_string($conn, $_POST['role']));
	$dateenlist = mysqli_real_escape_string($conn, $_POST['dateenlist']);  

	$query = "SELECT * FROM `tb_employee` WHERE `_fullname`='".$fullname."'";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_createEmp= "INSERT INTO `tb_employee`(`_fullname`, `_age`, `_sex`, `_birthdate`, `_address`, `_datehired`, `_role`) 
	VALUES ('".$fullname."','".$age."','".$sex."','".$birthdate."','".$address."','".$dateenlist."','".$role."')"; 
	
	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_createEmp)){  
			echo json_encode(array('status'=>1)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}   
	$conn->close(); 
} 

if(isset($_GET['data']) && $_GET['data']=="admin_removeemp"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_removeEmp= "UPDATE `tb_employee` SET `_active`='0' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_removeEmp)){  
		echo json_encode(array('status'=>1));  
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_GET['data']) && $_GET['data']=="admin_restoreemp"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_restoreEmp= "UPDATE `tb_employee` SET `_active`='1' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_restoreEmp)){  
		echo json_encode(array('status'=>1));  
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if (isset($_GET["data"]) && $_GET["data"] == "modal_geteditemp"){
	$id = mysqli_real_escape_string($conn, $_GET['id']); 

	$query = "SELECT `_id`, `_useracctID`, `_fullname`, `_age`, `_sex`, DATE(`_birthdate`) AS `_birthdate`, `_address`, 
	DATE(`_datehired`) AS `_datehired`, `_role` 
	FROM `tb_employee` WHERE `_id`='".$id."'"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo json_encode(array('status'=>1
			,'id'=>$row['_id']
			,'fullname'=>$row['_fullname']
			,'age'=>$row['_age']
			,'sex'=>$row['_sex']
			,'birthdate'=>$row['_birthdate']
			,'address'=>$row['_address']
			,'datehired'=>$row['_datehired']
			,'role'=>strtolower($row['_role']))); 
		} 
	}
	else{
		echo json_encode(array('status'=>0)); 
	}   
}

if(isset($_POST['data']) && $_POST['data']=="admin_editemp"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$fullname = strtoupper(mysqli_real_escape_string($conn, $_POST['fullname']));
	$age = ($_POST['age']!="")? mysqli_real_escape_string($conn, $_POST['age']): "0";
	$sex = mysqli_real_escape_string($conn, $_POST['sex']); 
	$birthdate = ($_POST['birthdate']!="")? mysqli_real_escape_string($conn, $_POST['birthdate']): "0000-01-01 00:00:00"; 
	$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
	$role = strtoupper(mysqli_real_escape_string($conn, $_POST['role']));
	$dateenlist = mysqli_real_escape_string($conn, $_POST['dateenlist']);  

	$query = "SELECT * FROM `tb_employee` WHERE `_id`!='".$id."' AND `_fullname`='".$fullname."'";
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  
 
	$query_editEmp= "UPDATE `tb_employee` SET `_fullname`='".$fullname."',`_age`='".$age."',`_sex`='".$sex."',
	`_birthdate`='".$birthdate."',`_address`='".$address."',`_datehired`='".$dateenlist."',`_role`='".$role."' 
	WHERE `_id`='".$id."'"; 
	
	if ($row_cnt > 0){ 
		echo json_encode(array('status'=>2)); 
	}
	else{
		if (mysqli_query($conn, $query_editEmp)){  
			echo json_encode(array('status'=>1)); 
		}
		else{
			echo json_encode(array('status'=>0));
		}
	}   
	$conn->close(); 
} 



/////////////////// GENERATE ItemLists.json ///////////////
function generateItemJson(){  
	session_abort();
	include 'config.php'; 
	$query_getItem = "SELECT COUNT(*) OVER() AS `countRow`, `_id` AS `id`, `_name` 
	AS `itemname`, `_desc` AS `itemdesc`, `_stock` AS `itemstock` 
	FROM `tb_item` WHERE `_active`='1' ORDER BY `_name` ASC;"; 
	$result = $conn->query($query_getItem); 

	//create an array
    $item_array = array();
    while($row =mysqli_fetch_assoc($result)){
		$item_array[] = $row;
	} 
	// echo json_encode($item_array);   
	$fp = fopen('../assets/json/ItemLists.json', 'w');
    fwrite($fp, json_encode($item_array));
    fclose($fp);
	$conn->close();  
} 

/////////////////// MANAGE INVENTORY //////////////////////
if (isset($_POST["data"]) && $_POST["data"] == "get_allinventory"){ 
	$query = "SELECT * FROM `tb_item` WHERE 1 ORDER BY `_name` ASC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">    
				 <?php if ($row['_active']=='1'): ?>
					<button onclick="btn_editItem(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Edit Item Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#EditItem_Modal">
						<img src="../assets/images/edit-grey.svg" />
					</button> 
					<button onclick="btn_editItemQty(this.getAttribute('data-id1'), this.getAttribute('data-id2'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" data-id2="<?php echo htmlspecialchars($row['_name']); ?>" title="Edit Item Quantity" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#EditItemQty_Modal">
						<i class="nav-icon fa fa-sort font-18 color-grey"></i>
					</button> 
					<button onclick="btn_removeItem(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Move Item to Draft" type="button" class="btn btn-icon small">
	 					<img src="../assets/images/remove-grey.svg" />
	 				</button>
				<?php else: ?>
					<button onclick="btn_restoreItem(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Restore Item from Draft" type="button" class="btn btn-icon small">
						<i class="nav-icon fa fa-refresh font-18 color-grey"></i>
					</button>
				<?php endif; ?> 
	 		</td> 
			<td><?php echo htmlspecialchars($row['_name']); ?></td> 
			<td><?php echo htmlspecialchars($row['_desc']); ?></td>  
			<td><?php echo number_format($row['_stock'],2); ?></td>  
			<td>
				<?php echo ($row['_active']=='1')
					? '<span class="status success">Active</span>'
					: '<span class="status warning">Draft</span>'; ?>
			</td>
		</tr>


		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="7" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if (isset($_POST["data"]) && $_POST["data"] == "get_allinventorylogs"){ 
	$query = "SELECT * FROM `tb_itemlogs` WHERE 1 ORDER BY DATE(`_datecreated`) DESC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td><?php echo date("M d, Y", strtotime($row['_datecreated'])); ?></td> 
			<td><?php echo htmlspecialchars($row['_itemname']); ?></td> 
			<td>
				<?php echo ($row['_operation']=="add")
					? '<span class="status info">ADD</span>'
					: '<span class="status warning">REDUCE</span>'; ?>
			</td> 
			<td><?php echo number_format($row['_qty'],2); ?></td>  
			<td><?php echo htmlspecialchars($row['_eventname']); ?></td>
			<td><?php echo htmlspecialchars($row['_remarks']); ?></td>  
		</tr>


		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="6" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if(isset($_GET['data']) && $_GET['data']=="admin_removeitem"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_removeItem= "UPDATE `tb_item` SET `_active`='0' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_removeItem)){  
		echo json_encode(array('status'=>1)); 
		generateItemJson();
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_GET['data']) && $_GET['data']=="admin_restoreitem"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_restoreItem= "UPDATE `tb_item` SET `_active`='1' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_restoreItem)){  
		echo json_encode(array('status'=>1)); 
		generateItemJson();
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if (isset($_GET["data"]) && $_GET["data"] == "modal_getedititem"){
	$id = mysqli_real_escape_string($conn, $_GET['id']); 

	$query = "SELECT * FROM `tb_item` WHERE `_id`='".$id."'"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo json_encode(array('status'=>1,'name'=>$row['_name'],'desc'=>$row['_desc'])); 
		} 
	}
	else{
		echo json_encode(array('status'=>0)); 
	}
}

if(isset($_POST['data']) && $_POST['data']=="admin_edititem"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$name = strtoupper(mysqli_real_escape_string($conn, $_POST['name'])); 
	$desc = strtoupper(mysqli_real_escape_string($conn, $_POST['desc'])); 
 
	$query_editItem= "UPDATE `tb_item` 
	SET `_name`='".$name."',`_desc`='".$desc."' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_editItem)){  
		echo json_encode(array('status'=>1)); 
		generateItemJson();
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="admin_additeminv"){ 
	$name = strtoupper(mysqli_real_escape_string($conn, $_POST['name'])); 
	$desc = strtoupper(mysqli_real_escape_string($conn, $_POST['desc'])); 
	$qty = mysqli_real_escape_string($conn, $_POST['qty']);  
 
	$query_checkItem = "SELECT * FROM `tb_item` WHERE `_name`='".$name."'";
	$result = $conn->query($query_checkItem); 
    $row_cnt = $result->num_rows; 
	
	if ($row_cnt > 0){
		echo json_encode(array('status'=>2));
	}
	else{
		$query_addItem= "INSERT INTO `tb_item`(`_name`, `_desc`, `_stock`) 
		VALUES ('".$name."','".$desc."','".$qty."')"; 
		
		if (mysqli_query($conn, $query_addItem)){  
			echo json_encode(array('status'=>1)); 
			generateItemJson();
		}
		else{
			echo json_encode(array('status'=>0));
		}  
	} 
	$conn->close(); 
} 

if(isset($_POST['data']) && $_POST['data']=="admin_editqty"){
	$id = mysqli_real_escape_string($conn, $_POST['id']);  
	$name = mysqli_real_escape_string($conn, $_POST['name']);  
	$operation = mysqli_real_escape_string($conn, $_POST['operation']); 
	$qty = mysqli_real_escape_string($conn, $_POST['qty']);  
	$event = mysqli_real_escape_string($conn, $_POST['event']); 
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']); 

	$queryCheckQty = "SELECT * FROM `tb_item` WHERE `_id`='".$id."'"; 
	$result = $conn->query($queryCheckQty);
	$row = mysqli_fetch_assoc($result);
	$total_qty = $row['_stock']; 

	$query_addInvLogs = ($event!="")
	? "INSERT INTO `tb_itemlogs`(`_itemid`, `_itemname`, `_operation`, `_qty`, `_eventid`, `_eventname`, `_remarks`) 
	SELECT '".$id."','".$name."','".$operation."','".$qty."',`_id`,`_title`,'".$remarks."' FROM `tb_events` WHERE `_id`='".$event."'"
	: "INSERT INTO `tb_itemlogs`(`_itemid`, `_itemname`, `_operation`, `_qty`, `_remarks`) 
	VALUES ('".$id."','".$name."','".$operation."','".$qty."','".$remarks."')";
	
	if ($operation == "sub"){
		if (number_format($total_qty) < number_format($qty)){
			echo json_encode(array('status'=>2)); 
		}
		else{
			$query_updateItemInv = "UPDATE `tb_item` SET `_stock`=(`_stock`-".$qty.") WHERE `_id`='".$id."'";
			if (mysqli_query($conn, $query_updateItemInv)){  
				generateItemJson();
				if (mysqli_query($conn, $query_addInvLogs)){  
					echo json_encode(array('status'=>1));  
				}
				else{
					echo json_encode(array('status'=>0));
				}   
			}
			else{
				echo json_encode(array('status'=>0));
			}  
		} 
	}
	else{
		$query_updateItemInv = "UPDATE `tb_item` SET `_stock`=(`_stock`+".$qty.") WHERE `_id`='".$id."'";
		if (mysqli_query($conn, $query_updateItemInv)){   
			generateItemJson();
			if (mysqli_query($conn, $query_addInvLogs)){  
				echo json_encode(array('status'=>1));  
			}
			else{
				echo json_encode(array('status'=>0));
			}   
		}
		else{
			echo json_encode(array('status'=>0));
		}  
	}  
	$conn->close(); 
} 




/////////////////// MANAGE EVENT/ ACTIVITY //////////////////////
if(isset($_POST['data']) && $_POST['data']=="admin_addevent"){
	$datefrom = mysqli_real_escape_string($conn, $_POST['datefrom']);  
	$dateto = ($_POST['dateto']!="")? mysqli_real_escape_string($conn, $_POST['dateto']): "0000-01-01 00:00:00"; 
	$title = strtoupper(mysqli_real_escape_string($conn, $_POST['title'])); 
	$info = mysqli_real_escape_string($conn, $_POST['info']);  
 
	$query_addEvent= "INSERT INTO `tb_events`(`_title`, `_body`, `_startdate`, `_enddate`) 
	VALUES ('".$title."','".$info."','".$datefrom."','".$dateto."')"; 
	
	if (mysqli_query($conn, $query_addEvent)){  
		echo json_encode(array('status'=>1));  
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
} 

if(isset($_GET['data']) && $_GET['data']=="admin_removeevent"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_removeItem= "UPDATE `tb_events` SET `_draft`='1' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_removeItem)){  
		echo json_encode(array('status'=>1));  
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if (isset($_POST["data"]) && $_POST["data"] == "get_eventrequests"){ 
	$query = "SELECT b._fullname, a.* FROM `tb_events` a 
	LEFT JOIN `tb_useracct` b ON a._userID=b._id WHERE a.`_userID`!='0' 
	ORDER BY DATE(`_startdate`) ASC"; 
	$result = $conn->query($query); 
    $row_cnt = $result->num_rows;  

	if ($row_cnt > 0){
		while($row = mysqli_fetch_assoc($result)){ ?>
		<tr> 
			<td class="action" style="justify-content: flex-start;">   
				 <?php if ($row['_draft']=='2'): ?>
					<button onclick="btn_editEventReq(this.getAttribute('data-id1'))" data-id1="<?php echo htmlspecialchars($row['_id']); ?>" title="Edit Patient Information" type="button" class="btn btn-icon small" data-toggle="modal" data-target="#EventRequest_Modal">
						<i class="nav-icon fa fa-check font-18 color-grey"></i>
	 				</button>  
				<?php endif; ?> 
	 		</td> 
			<td><?php echo htmlspecialchars($row['_fullname']); ?></td> 
			<td><?php echo htmlspecialchars($row['_title']); ?></td>  
			<td><?php echo htmlspecialchars($row['_body']); ?></td> 
			<td><?php echo date("M d, Y", strtotime($row['_startdate'])); ?></td> 
			
			<td>
				<?php if ($row['_enddate']!="0000-01-01"): ?>
					<?php echo date("M d, Y", strtotime($row['_enddate'])); ?>
				<?php else: ?>
					N/A
				<?php endif; ?>  
			</td>  
			<td>
				<?php if ($row['_draft']=='0'): ?>
					<span class="status success">Posted</span>
				<?php elseif ($row['_draft']=='1'): ?>
					<span class="status danger">Draft</span> 
				<?php else: ?>
					<span class="status warning">Pending</span>
				<?php endif; ?>   
			</td>
		</tr> 
		<?php } 
	}
	else{ ?>
		<tr> 
			<td colspan="7" style="text-align: center;">No matching records found</td>
		</tr> 
	<?php } 
	$conn->close(); 
} 

if(isset($_GET['data']) && $_GET['data']=="admin_canceleventrequest"){
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_cancelEventReq= "UPDATE `tb_events` SET `_draft`='1' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_cancelEventReq)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

if(isset($_GET['data']) && $_GET['data']=="admin_confirmeventrequest"){	
	$id = mysqli_real_escape_string($conn, $_GET['id']);   
	$query_confirmEventReq= "UPDATE `tb_events` SET `_draft`='0' WHERE `_id`='".$id."'"; 
	
	if (mysqli_query($conn, $query_confirmEventReq)){  
		echo json_encode(array('status'=>1)); 
	}
	else{
		echo json_encode(array('status'=>0));
	}  
	$conn->close(); 
}

?>



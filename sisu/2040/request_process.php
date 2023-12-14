<?php
session_start();
require_once('../Db/connection.php');
require_once('../Db/connection2.php');

$username = $_SESSION['uname'];
$access=$_SESSION['access'];

$requests = json_decode($_POST['req_array']);
$request_len = sizeof($requests);
$username = $_SESSION['uname'];
$today = date("Y-m-d");

$cf = "";
if(in_array("cf", $requests)) {
	$cf = "Confirmatory Letter";
} else {
	
}

$trans = "";
if(in_array("trans", $requests)) {
	$trans = "Transcript";
} else {
	
}

$il = "";
if(in_array("il", $requests)) {
	$il = "Introductory Letter";
} else {
	
}

$ep = "";
if(in_array("ep", $requests)) {
	$ep = "English Proficiency";
} else {
	
}

$visa = "";
if(in_array("visa", $requests)) {
	$visa = "Visa";
} else {
	
}

$category = $_POST['category'];
// $req_id = $_POST['req_id'];
$stud_id = $_POST['stud_id'];
$cf_q = $_POST['cf_q'];
$ep_q = $_POST['ep_q'];
$il_q = $_POST['il_q'];
$visa_q = $_POST['visa_q'];
$trans_q = $_POST['trans_q'];
$req_type = $_POST['req_type'];
$req_del = $_POST['req_del'];
$req_del_addrs = $_POST['req_del_addrs'];
if(isset($_POST['country'])) {
	$country = $_POST['country'];
} else {
	$country = '';
}

$code = rand(10000000, 100000000);

if ($category == 'Undergraduate') {
	$profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM studentbiodata LEFT JOIN programme on sprogid = programme.progid WHERE indexno = '$stud_id'";
$rs_profile = mysqli_query($conn, $profile);
if($rs_profile) {
	while($r = mysqli_fetch_assoc($rs_profile)) {
		$name = $r['name'];
		$progid = $r['sprogid'];
	}
		$time = time();
	$sql = "INSERT INTO trial_transcript (trans_uin, indexno, name, programme, service_type, service_cat1, quantity1, service_cat2, quantity2, service_cat3, quantity3, service_cat4, quantity4, service_cat5, quantity5, country, delivery_mode, delivery_addrss, Req_No_Rem, status, category, verify_code) values ('$time', '$stud_id', '$name', '$progid', '$req_type', '$trans', '$trans_q', '$ep', '$ep_q', '$il', '$il_q', '$cf', '$cf_q', '$visa', '$visa_q', '$country', '$req_del', '$req_del_addrs', '$request_len', 'Being Processed', '$category', '$code')";

	$rs = mysqli_query($conn, $sql);
	if($rs) {
		$sql_assign="SELECT DISTINCT username from tbl_user_profile where status='1' and not exists (SELECT assignedto from tbl_schedule where username=assignedto and date_added='$today')";
		$rs_assign=mysqli_query($conn, $sql_assign);

		if(mysqli_num_rows($rs_assign)<=0){
			$sql="SELECT count(assignedto) as num, assignedto from tbl_schedule where date_added='$today' group by assignedto order by num DESC";
			$results = mysqli_query($conn, $sql);
			if($results) {
				while($row1 = mysqli_fetch_assoc($results)) {
					$assign=$row1['assignedto'];
				}
			}
			
		}else{
			while($row2=mysqli_fetch_assoc($rs_assign)) {
				$assign=$row2['username'];
			}
			
	}

	$sql_add="INSERT INTO tbl_schedule(date_added, added_by, assignedto, action_date, remark, indexnum, cat, trans_id) values('$today', '$username', '$assign','$today', 'Being processed','$stud_id', '$category', '$time')";
		$rs_add = mysqli_query($conn, $sql_add);
		if($rs_add) {
			$event = "New Request Added. Transaction ID: ".$time;
			$log_insert = "INSERT INTO `tbl_log` (`event`, `username`, `access_lvl`) values ('$event', '$username', '$access')";
			$log_rs = mysqli_query($conn, $log_insert);
			if($log_rs) {
				echo 1;
			} else {
				echo $conn->error;
			}
		} else {
			echo $conn->error;
		}
		
	} else {
		echo $conn->error;
	}
} else {
	echo $conn->error;
}
} else if($category == 'Postgraduate') {

$profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM arms_pg.studentbiodata LEFT JOIN arms_pg.programme on sprogid = programme.progid WHERE indexno = '$stud_id'";
$rs_profile = mysqli_query($conn2, $profile);
if($rs_profile) {
	while($r = mysqli_fetch_assoc($rs_profile)) {
		$name = $r['name'];
		$progid = $r['sprogid'];
	}
		$time = time();
	$sql = "INSERT INTO trial_transcript (trans_uin, indexno, `name`, programme, service_type, service_cat1, quantity1, service_cat2, quantity2, service_cat3, quantity3, service_cat4, quantity4, service_cat5, quantity5, country, delivery_mode, delivery_addrss, Req_No_Rem, status, category, verify_code) values ('$time', '$stud_id', '$name', '$progid', '$req_type', '$trans', '$trans_q', '$ep', '$ep_q', '$il', '$il_q', '$cf', '$cf_q', '$visa', '$visa_q', '$country', '$req_del', '$req_del_addrs', '$request_len', 'Being Processed', '$category', '$code')";

	$rs = mysqli_query($conn, $sql);
	if($rs) {
		$sql_assign="SELECT DISTINCT username from tbl_user_profile where status='1' and not exists (SELECT assignedto from tbl_schedule where username=assignedto and date_added='$today')";
		$rs_assign=mysqli_query($conn, $sql_assign);

		if(mysqli_num_rows($rs_assign)<=0){
			$sql="SELECT count(assignedto) as num, assignedto from tbl_schedule where date_added='$today' group by assignedto order by num DESC";
			$results = mysqli_query($conn, $sql);
			if($results) {
				while($row1 = mysqli_fetch_assoc($results)) {
					$assign=$row1['assignedto'];
				}
			}
			
		}else{
			while($row2=mysqli_fetch_assoc($rs_assign)) {
				$assign=$row2['username'];
			}
			
	}

	$sql_add="INSERT INTO tbl_schedule(date_added, added_by, assignedto, action_date, remark, indexnum, cat, trans_id) values('$today', '$username', '$assign', '$today', 'Being processed','$stud_id', '$category', '$time')";
		$rs_add = mysqli_query($conn, $sql_add);
		if($rs_add) {
			$event = "New Request Added. Transaction ID: ".$time;
			$log_insert = "INSERT INTO `tbl_log` (`event`, `username`, `access_lvl`) values ('$event', '$username', '$access')";
			$log_rs = mysqli_query($conn, $log_insert);
			if($log_rs) {
				echo 1;
			} else {
				echo $conn->error;
			}
		} else {
			echo $conn->error;
		}
		
	} else {
		echo $conn->error;
	}
}
}



?>
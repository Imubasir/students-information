<?php
require_once('../Db/connection.php');

$req_ = $_POST['req_'];
$requests = explode(",", $req_);

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

$loa = "";
if(in_array("loa", $requests)) {
	$loa = "Letter of Attestation";
} else {
	
}

$ep = "";
if(in_array("ep", $requests)) {
	$ep = "English Proficiency";
} else {
	
}

$req_id = $_POST['req_id'];
$stud_id = $_POST['stud_id'];
$cf_q = $_POST['cf_q'];
$ep_q = $_POST['ep_q'];
$loa_q = $_POST['loa_q'];
$trans_q = $_POST['trans_q'];
$req_type = $_POST['req_type'];
$req_del = $_POST['req_del'];
$req_del_addrs = $_POST['req_del_addrs'];

// $profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM studentbiodata LEFT JOIN programme on sprogid = programme.progid WHERE Sindexno = '$stud_id'";
// $rs_profile = mysqli_query($conn, $profile);
// if($rs_profile) {
// 	while($r = mysqli_fetch_assoc($rs_profile)) {
// 		$name = $r['name'];
// 		$progid = $r['sprogid'];
// 	}
// 	$sql = "INSERT INTO trial_transcript (trans_uin, indexno, name, programme, service_type, service_cat1, quantity1, service_cat2, quantity2, service_cat3, quantity3, service_cat4, quantity4, delivery_mode, delivery_addrss) values ('$req_id', '$stud_id', '$name', '$progid', '$req_type', '$trans', '$trans_q', '$ep', '$ep_q', '$loa', '$loa_q', '$cf', '$cf_q', '$req_del', '$req_del_addrs')";

	// $rs = mysqli_query($conn, $sql);
	// if($rs) {
	// 	echo 1;
	// } else {
	// 	echo $conn->error;
	// }
// }

?>
<?php
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT tbl_shs_results.`trans_id`, tbl_shs_results.`indexnumber`, tbl_shs_results.`exam_month`, tbl_shs_results.`exam_year`, tbl_verified.`cand_name` FROM tbl_shs_results LEFT JOIN tbl_verified ON tbl_shs_results.trans_id = tbl_verified.uin WHERE trans_id = '$id' order by indexnumber asc";

$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}

} else {
	echo $conn->error;
}
	echo json_encode($data);

?>

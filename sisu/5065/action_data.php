<?php
require_once('../Db/connection.php');
$id = $_POST['id'];


$sql = "SELECT CONCAT_WS(' ', surname, middlename, firstname) AS name, indexno, sprogid, study_status, progname, action, startDate, endDate, date from studentbiodata LEFT JOIN programme on sprogid = progid LEFT JOIN tbl_action on studentbiodata.uin = tbl_action.uin where studentbiodata.uin = '$id'";
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
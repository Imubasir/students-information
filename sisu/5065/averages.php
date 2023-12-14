<?php
require_once("../Db/connection.php");
$id=$_POST['id'];
$sql = "SELECT * FROM tbl_cwa_gpa where indexnum = '$id' order by levelid, trimid, present ASC";
$data = array();

$rs = mysqli_query($conn, $sql);
if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
} else {
	echo $conn->error;
}

echo json_encode($data);

?>
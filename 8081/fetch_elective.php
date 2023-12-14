<?php
require("../Db/connection.php");

$sql = "SELECT * FROM tbl_verified_subjects";

$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}

	echo json_encode($data);

} else {
	echo $conn->error;
}

?>

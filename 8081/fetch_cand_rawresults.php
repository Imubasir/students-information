<?php
require("../Db/connection.php");
$uin = $_POST['uin'];
$index = $_POST['index'];

$sql = "SELECT * FROM tbl_shs_results where trans_id = '$uin' and indexnumber = '$index'";

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

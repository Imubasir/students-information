<?php
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT * FROM tbl_shs_results where trans_id = '$id'";

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

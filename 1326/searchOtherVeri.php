<?php
require("../Db/connection.php");

$id = $_POST['sid'];

$sql = "SELECT * FROM tbl_other_verified WHERE indexnum = '$id' OR uin = '$id'";
$data = array();
$sql_rs = mysqli_query($conn, $sql);
if($sql_rs) {
	while($row = mysqli_fetch_assoc($sql_rs)) {
		$data[] = $row;
	}
} else {
	echo $conn->error;
}
echo json_encode($data);

?>
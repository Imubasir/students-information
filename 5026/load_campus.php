<?php
require("../Db/connection.php");

$data = array();
$sql = "SELECT * FROM tbl_campus order by campus_descr ASC";
$result = mysqli_query($conn, $sql);

if($result) {
	while($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
} else {
	echo $conn->error;
}
echo json_encode($data);
?>
<?php
require("../Db/connection.php");
$id = $_POST['id'];
$mon = $_POST['mon'];

$month = strtoupper(date("M", strtotime($mon)));
$year = date("Y", strtotime($mon));

$sql = "UPDATE tbl_shs_results SET exam_month = '$month', exam_year = '$year' WHERE trans_id = '$id'";

$rs = mysqli_query($conn, $sql);

if($rs) {
	echo 1;
} else {
	echo $conn->eror;
}

?>
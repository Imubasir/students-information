<?php
require("../Db/connection.php");

$id = $_POST['student_id'];

$sql_check = "SELECT * FROM payments where reference = '$id' AND narration = 'GRADUATION FEE' AND transaction_type = 'PAID' ";
$rs_check = mysqli_query($conn, $sql_check);
$data = array();

if($rs_check->num_rows > 0) {
	// while($row_check = mysqli_fetch_assoc($rs_check)) {
	// 	$data = $row_checK;
	// }
	// echo json_encode($data);
	echo 1;
} else {
	echo $conn->error;
}

?>
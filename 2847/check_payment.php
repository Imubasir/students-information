<?php
require("../Db/connection.php");

$id = $_POST['student_id'];
$uin = $_POST['uin'];

$sql_check = "SELECT * FROM payments where (reference = '$id' OR reference = '$uin') AND narration = 'GRADUATION FEE' AND transaction_type = 'PAID' ";

$rs_check = mysqli_query($conn, $sql_check);
$data = array();

if($rs_check->num_rows > 0) {
	echo 1;
} else {
	echo $conn->error;
}

?>
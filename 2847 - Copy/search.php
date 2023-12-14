<?php
require("../Db/connection.php");
$student_id = $_POST['student_id'];

	$sql = "SELECT * FROM payments WHERE reference = '$student_id' and narration = 'GRADUATION FEE' AND transaction_type = 'PAID' ";


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
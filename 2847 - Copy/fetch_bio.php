<?php
require("../Db/connection.php");

$student_id = $_POST['student_id'];

$result = strpos($student_id, "/");
if($result) {
	$sql = "SELECT * FROM tbl_students where indexno = '$student_id' ";
} else {
		$sql = "SELECT * FROM tbl_students where uin = '$student_id' ";
}

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
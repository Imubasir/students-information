<?php
require("../Db/connection.php");

$student_id = $_POST['id'];

$sql = "SELECT * FROM studentbiodata LEFT JOIN programme on sprogid = progid where indexno = '$student_id' OR uin = '$student_id'";

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
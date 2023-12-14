<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$student_id = $_POST['id'];

$sql = "SELECT * FROM arms.studentbiodata LEFT JOIN arms.programme on sprogid = progid where indexno = '$student_id' OR uin = '$student_id'";
$rs = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM arms_pg.studentbiodata LEFT JOIN arms_pg.programme on sprogid = progid where indexno = '$student_id' OR uin = '$student_id'";
$rs2 = mysqli_query($conn2, $sql2);

$data = array();
if($rs->num_rows > 0) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
} else if($rs2->num_rows > 0) {
	while($row = mysqli_fetch_assoc($rs2)) {
		$data[] = $row;
	}
} else {
	echo $conn->error;
	echo $conn2->error;
}

echo json_encode($data);

?>
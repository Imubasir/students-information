<?php
require_once("../Db/connection.php");
$sql = "SELECT * FROM course left join department on course.deptid = department.deptid ORDER BY coursecode ASC";
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
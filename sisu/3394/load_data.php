<?php
require_once("../Db/connection2.php");
$sql = "SELECT * FROM course left join department on course.deptid = department.deptid ORDER BY coursecode ASC";
$data = array();
$rs = mysqli_query($conn2, $sql);
if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
} else {
	echo $conn2->error;
}

echo json_encode($data);
?>
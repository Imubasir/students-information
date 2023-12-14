<?php
require_once('../Db/connection2.php');
$id = $_POST['id'];
$sql = "SELECT * FROM course left join department on course.deptid = department.deptid where coursecode = '$id' ORDER BY coursecode ASC ";
$rs = mysqli_query($conn2, $sql);
$data = array();
if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
} else {
	echo $conn2->error;
}

echo json_encode($data);
?>
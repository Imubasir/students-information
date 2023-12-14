<?php
require("../Db/connection2.php");
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT * FROM arms_pg.studentbiodata LEFT JOIN arms_pg.programme on sprogid = progid LEFT JOIN arms.department on arms_pg.programme.dept_id = arms.department.deptid LEFT JOIN arms.faculty ON facid = arms.faculty.facultyid 
LEFT JOIN arms.tbl_campus ON arms.tbl_campus.campus_id = arms.faculty.fcampus_id LEFT JOIN arms_pg.tbl_option on studentbiodata.option_id = tbl_option.optionid where indexno = '$id' or uin = '$id'";
$rs = mysqli_query($conn2, $sql);
$data = array();

if($rs->num_rows > 0) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
echo json_encode($data);
 } else if ($rs->num_rows < 1){
 	echo 0;
 } else {
 	echo $conn2->eror;
 }


?>
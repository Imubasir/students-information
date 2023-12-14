<?php
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT studentbiodata.*, programme.facid, programme.progname, programme.progid, programme.dept_id, faculty.facultyid, faculty.fcampus_id, faculty.facultyname, department.deptid, department.deptname, department.hod, tbl_campus.campus_descr, tbl_option.option_title FROM studentbiodata LEFT JOIN programme on sprogid = progid LEFT JOIN faculty ON facid = faculty.facultyid 
LEFT JOIN tbl_campus ON tbl_campus.campus_id = fcampus_id LEFT JOIN department on programme.dept_id = department.deptid LEFT JOIN tbl_option on studentbiodata.option_id = tbl_option.optionid where indexno = '$id' or uin = '$id'";

$rs = mysqli_query($conn, $sql);
$data = array();

if($rs->num_rows == 1) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}

		 echo json_encode($data);
 } else if ($rs->num_rows < 1){
 	echo 0;
 } else {
 	echo $conn->eror;
 }


?>
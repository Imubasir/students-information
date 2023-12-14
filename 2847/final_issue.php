<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$id = $_POST['id'];
$uin = $_POST['uin'];

$sql_check = "SELECT * FROM tbl_graduate where indexno = '$id'";
$rs_check = mysqli_query($conn, $sql_check);

$sql_check2 = "SELECT * FROM arms_pg.tbl_graduate where indexno = '$id'";
$rs_check2 = mysqli_query($conn2, $sql_check2);
$data = array();

if($rs_check->num_rows > 0) {
	while($row_check = mysqli_fetch_assoc($rs_check)) {
		$issued = $row_check['issued'];

		if($issued == '1') {
			echo 0;
		} else if($issued == '0') {
			$sql = "SELECT * FROM arms.tbl_souvenir where student_id = '$id'";
			$rs = mysqli_query($conn, $sql);
			
			if($rs) {
				while($row = mysqli_fetch_assoc($rs)) {
					$data[] = $row;
				}
					echo json_encode($data);
			}  else {
				echo $conn->error;
			}

		} else {
			echo $conn->error;
		}
	}
} else if($rs_check2) {
	while($row_check = mysqli_fetch_assoc($rs_check2)) {
		$issued = $row_check['issued'];

		if($issued == '1') {
			echo 0;
		} else if($issued == '0') {
			$sql = "SELECT * FROM arms.tbl_souvenir where student_id = '$id'";
			$rs2 = mysqli_query($conn2, $sql);

			if($rs2) {
				while($row2 = mysqli_fetch_assoc($rs2)) {
					$data[] = $row2;
				}
					echo json_encode($data);
			}  else {
				echo $conn2->error;
			}

		} else {
			echo $conn->error;
		}
	}
} else {
	echo $conn->error;
}

?>
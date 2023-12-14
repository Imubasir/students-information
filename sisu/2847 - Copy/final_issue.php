<?php
require("../Db/connection.php");

$id = $_POST['id'];

$sql_check = "SELECT * FROM tbl_graduate where indexno = '$id'";
$rs_check = mysqli_query($conn, $sql_check);
$data = array();

if($rs_check->num_rows > 0) {
	while($row_check = mysqli_fetch_assoc($rs_check)) {
		$issued = $row_check['issued'];

		if($issued == '1') {
			echo 0;
		} else if($issued == '0') {
			$sql = "SELECT * FROM tbl_souvenir where student_id = '$id'";
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
} else {
	echo 1;
}



?>
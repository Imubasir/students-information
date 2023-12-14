
<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$id = $_POST['id'];

$sql_check = "SELECT * FROM arms_pg.tbl_graduate where indexno = '$id'";
$rs_check = mysqli_query($conn2, $sql_check);

$sql_check2 = "SELECT * FROM arms.tbl_graduate where indexno = '$id'";
$rs_check2 = mysqli_query($conn, $sql_check2);

$data = array();
if ($rs_check) {
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
			}  else {
				echo $conn->error;
			}

		} else {
			echo $conn->error;
		}
	}
} else if($rs_check2){
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
			}  else {
				echo $conn->error;
			}

		} else {
			echo $conn->error;
		}
	}
}
	echo json_encode($data);


?>
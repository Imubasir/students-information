<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$sql_ug= "SELECT COUNT(*) FROM studentbiodata";
$rs_ug = mysqli_query($conn, $sql_ug);

$sql_pg = "SELECT COUNT(*) FROM studentbiodata";
$rs_pg = mysqli_query($conn2, $sql_pg);

$sql_trans = "SELECT COUNT(*) FROM trial_transcript where cat1_status = 0  and Req_No_Rem > 0";
$rs_trans = mysqli_query($conn, $sql_trans);

$sql_letters = "SELECT * FROM trial_transcript WHERE Req_No_Rem > 0";
$rs_letters = mysqli_query($conn, $sql_letters);

$data = array();

if($rs_ug) {
	while($row_one = mysqli_fetch_assoc($rs_ug)) {
		$data['ug'] = $row_one['COUNT(*)'];
	}
} else {
	echo $conn->error;
}

if($rs_pg) {
	while($row_two = mysqli_fetch_assoc($rs_pg)) {
		$data['pg'] = $row_two['COUNT(*)'];
	}
} else {
	echo $conn->error;
}

if($rs_trans) {
	while($row_three = mysqli_fetch_assoc($rs_trans)) {
		$data['trans'] = $row_three['COUNT(*)'];
	}
} else {
	echo $conn->error;
}

$letter_count = 0;
if($rs_letters) {
	while($row_four = mysqli_fetch_assoc($rs_letters)) {
		if($row_four['quantity2'] > 0 ) {
			$letter_count++;
		}

		if($row_four['quantity3'] > 0) {
			$letter_count++;
		}

		if($row_four['quantity4'] > 0) {
			$letter_count++;
		}

		if($row_four['quantity5'] > 0) {
			$letter_count++;
		}

	}
		$data['letters'] = $letter_count;
} else {
	echo $conn->error;
}

echo json_encode($data);
?>
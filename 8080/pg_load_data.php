<?php
require("../Db/connection2.php");
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT * FROM studentbiodata 
		LEFT JOIN programme ON sprogid = progid 
		LEFT JOIN tbl_option ON studentbiodata.option_id = tbl_option.optionid
		LEFT JOIN arms.tbl_country ON nationality = country_id
		LEFT JOIN arms.region ON rob = regionid 
		WHERE studentbiodata.uin = '$id'";
$data = array();

$rs = mysqli_query($conn2, $sql);
if($rs) {
	while($row =mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
} else {
	echo $conn2->error;
}

echo json_encode($data);
?>
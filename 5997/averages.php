<?php
require_once ('../Db/connection2.php');
$id = $_POST['id'];

$sql = "SELECT levelid, trimid, cwa, present, sprogid, progname FROM tbl_cwa_gpa, studentbiodata, programme where indexno = indexnum and sprogid=progid and indexnum = '$id' order by levelid, trimid ASC";

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

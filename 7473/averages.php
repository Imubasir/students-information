<?php
require_once ('../Db/connection.php');
$id = $_POST['id'];

$sql = "SELECT levelid, trimid, cwa, present, sprogid, progname FROM tbl_cwa_gpa, studentbiodata, programme where studentbiodata.indexno = indexnum and sprogid=progid and indexnum = '$id' order by levelid, trimid ASC";

$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {

		$data[] = $row;
	}
} else {
	echo $conn->error;
}
	echo json_encode($data);
?>

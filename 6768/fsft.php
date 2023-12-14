<?php
require("../Db/connection.php");
$id = $_POST['id'];

$sql1 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and trimester = 1 and levelid = '1' and grade <> 'DF' order by coursecode1, session";
$data = array();

$rs = mysqli_query($conn, $sql1);
if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		$data[] = $row;
	}
}

echo json_encode($data);

?>
<?php
require("../Db/connection.php");
$id = $_POST['id'];
$code = $_POST['code'];
$assid = $_POST['assid'];

$sql = "DELETE FROM conass WHERE assid='$assid' and indexno = '$id' and coursecode1 = '$code'";
$rs = mysqli_query($conn, $sql);

if($rs) {
	echo '1';
} else {
	echo $conn->error;
}
?>
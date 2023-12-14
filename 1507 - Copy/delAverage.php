<?php
require("../Db/connection.php");
$id = $_POST['id'];
$level = $_POST['lvl'];
$trim = $_POST['trim'];

$sql = "DELETE FROM tbl_cwa_gpa WHERE indexnum='$id' and levelid = '$level' and trimid = '$trim'";
$rs = mysqli_query($conn, $sql);

if($rs) {
	echo '1';
} else {
	echo $conn->error;
}
?>
<?php
require_once('../Db/connection2.php');
$id = $_POST['id'];

$sql = "DELETE FROM course WHERE coursecode = '$id'";
$rs = mysqli_query($conn2, $sql);
if($rs) {
	echo "1";
} else {
	echo $conn2->error;
}
?>
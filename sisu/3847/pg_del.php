<?php
require_once("../Db/connection2.php");
$progid = $_POST['id'];

$sql = "DELETE FROM programme  where progid = '$progid'";

$rs = mysqli_query($conn2, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn2->error;
}
?>
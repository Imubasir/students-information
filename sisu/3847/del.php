<?php
require_once("../Db/connection.php");
$progid = $_POST['id'];

$sql = "DELETE FROM programme  where progid = '$progid'";

$rs = mysqli_query($conn, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn->error;
}
?>
<?php
require_once("../Db/connection.php");
$id = $_POST['id'];

$sql = "DELETE FROM department  where username = '$id'";

$rs = mysqli_query($conn, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn->error;
}
?>
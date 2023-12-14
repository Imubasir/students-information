<?php
require("../Db/connection.php");
$id = $_POST['id'];
$name = $_POST['name'];

$nam = strtoupper($name);

$sql = "UPDATE tbl_verified SET cand_name = '$nam' WHERE uin = '$id'";

$rs = mysqli_query($conn, $sql);

if($rs) {
	echo 1;
} else {
	echo $conn->eror;
}

?>
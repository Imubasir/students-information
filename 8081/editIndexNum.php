<?php
require("../Db/connection.php");
$id = $_POST['id'];
$num = $_POST['num'];

$sql = "UPDATE tbl_shs_results SET indexnumber = '$num' WHERE trans_id = '$id'";

$rs = mysqli_query($conn, $sql);

if($rs) {
	echo 1;
} else {
	echo $conn->eror;
}

?>
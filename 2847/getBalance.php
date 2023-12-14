<?php
require("../Db/connection.php");
$id = $_POST['indexno'];
$uin = $_POST['uin'];

$query = "SELECT * FROM tbl_balance WHERE (indexno = '$id' OR uin = '$uin')";
$result = mysqli_query($conn, $query);
if($result){
	while($row = mysqli_fetch_assoc($result)) {
		echo $row['balance'];
	}
}
 ?>
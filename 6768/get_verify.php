<?php
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT * FROM trial_transcript where indexno = '$id' ";
$rs = mysqli_query($conn, $sql);
if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		echo $row['verify_code'];
	}
}
?>
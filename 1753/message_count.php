<?php
require('../Db/connection.php');
$sql = "SELECT COUNT(*) FROM inbox WHERE status = '0'";
$rs = mysqli_query($conn, $sql);
if($rs) {
	while($row = mysqli_fetch_assoc($rs)) {
		echo $row['COUNT(*)'];
	}
}
?>
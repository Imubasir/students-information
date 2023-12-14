<?php
session_start();
require('../connection.php');
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '9' ";
$result = mysqli_query($conn, $sql);
if($result->num_rows>0){
	$_SESSION['timeout'] = time();
	echo 1;
}else{
	echo $conn->error;
}
 ?>

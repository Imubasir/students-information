<?php
session_start();
require('../Db/connection.php');
$id = $_SESSION['username'];

$sql = "SELECT * FROM tbl_user_profile left join tbl_user_dept on tbl_user_profile.department = tbl_user_dept.dept_id where username = '$id' ";
$result = mysqli_query($conn, $sql);
$data = array();
if($result){
while($row = mysqli_fetch_assoc($result)){
	$data[] = $row;
}
}else{
	echo $conn->error;
}
echo json_encode($data);
?>
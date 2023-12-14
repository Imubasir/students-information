<?php
	session_start();
	require_once("../Db/connection.php");

	$query = "SELECT * FROM tbl_paging";
	$result = mysqli_query($conn, $query);
	$data = array();
	if($result){
		while($row = $result->fetch_assoc()){
		$data[] = $row;
	}
}else{
	echo "Error:".$conn->error;
}
	
	echo json_encode($data);

?>
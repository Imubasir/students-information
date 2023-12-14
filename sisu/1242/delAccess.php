<?php
    session_start();
	require_once('../Db/connection.php');
	$id = $_POST['id'];
	$name = $_POST['user'];
    $user = $_SESSION['uname'];

    $activity = $name." Access Revoked for page ".$id;
	
	$query = "SELECT * FROM tbl_pages where fpage = '$id' AND username = '$name' ";
	$output = mysqli_query($conn, $query) or die($conn->error);
	
	if($output->num_rows > 0){
		$sql = "DELETE FROM tbl_pages WHERE username = '$name' and fpage = '$id' ";
        $sql1 = "Insert into tbl_log(activity, performed_by) values('$activity', '$user')";
		$result = mysqli_query($conn, $sql);
        $result1 = mysqli_query($conn, $sql);
		if($result == TRUE && $result1 == TRUE){
            
                        $now = date("Y-m-d H:i:s");     
                             $action = $now. "\t". $activity. "\t". $user. "\r\n";
                            if(file_exists('../soms_log.txt')) {
                             file_put_contents('../soms_log.txt', $action, FILE_APPEND);
                            }
            
			echo 1;
		}else {
			echo $conn->error;
		}

	} else {
		echo "Error";
	}

?>
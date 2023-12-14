<?php
    require_once('../Db/connection.php');
    $id = $_POST['id'];

    $sql = "UPDATE trial_transcript SET Req_No_Rem = Req_No_Rem - 1 where trans_uin = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {

    	$_sql = "SELECT * FROM trial_transcript where trans_uin = '$id'";
    	$_rs = mysqli_query($conn, $_sql);
    	if($_rs) {
    		while ($_row = mysqli_fetch_assoc($_rs)) {
    			if($_row['Req_No_Rem'] < 1) {
    				$action_date = date("Y-m-d H:i:s");
    				$sql_update = "UPDATE tbl_schedule SET action_date = '$action_date' where trans_id = '$id'";
    				$rs_update = mysqli_query($conn, $sql_update);
    				if($rs_update) {
						echo 1;
    				} else {
    					echo $conn->error;
    				}
    			}
    		}
    	} else {
    		echo $conn->error;
    	}
    	
    } else {
        echo $conn->error;
    }
?>
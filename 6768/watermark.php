<?php
require_once('../Db/connection.php');
$id = $_POST['id'];
$disp_balance = '';
$sql = "SELECT qualification_status from studentbiodata WHERE indexno = '$id' OR uin = '$id'";


$rs = mysqli_query($conn, $sql);
if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $qualification = $row['qualification_status'];
    }
} else {
	echo $conn->error;
}

$query = "SELECT * FROM tbl_balance WHERE (indexno = '$id' OR uin = '$id')";
$result = mysqli_query($conn, $query);
if($result){
	while($row = mysqli_fetch_assoc($result)) {
		$balance = $row['balance'];
		if($balance < 0) {
			$disp_balance = "Owing";
		} else if ($balance > 0) {
			$disp_balance = "Cleared";
		}
	}
}   

echo $qualification.','.$disp_balance;
?>
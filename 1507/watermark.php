<?php
require_once('../Db/connection.php');
$id = $_POST['id'];

$sql = "SELECT qualification_status from studentbiodata WHERE indexno = '$id' OR uin = '$id'";


$rs = mysqli_query($conn, $sql);
if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        echo $row['qualification_status'];
    }
} else {
	echo $conn->error;
}
    

?>
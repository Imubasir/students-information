<?php
require_once('../Db/connection.php');
$id = $_POST['id'];

$sql13 = "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid LEFT JOIN faculty ON facultyid=facid LEFT JOIN tbl_campus ON fcampus_id = tbl_campus.campus_id WHERE indexno = '$id' OR uin = '$id'";

$info = array();

$rs13 = mysqli_query($conn, $sql13);
if($rs13) {
    while($row13 = mysqli_fetch_assoc($rs13)) {
        $info[] = $row13;
    }
}
    
echo json_encode($info);

?>
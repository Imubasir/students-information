<?php
require_once('../Db/connection2.php');
$id = $_POST['id'];

// $sql13 = "SELECT * FROM studentbiodata inner join programme on Sprogid = progid inner join tbl_campus on programme.campus_id = tbl_campus.campus_id where indexno = '$id'";

$sql13 = "SELECT * FROM studentbiodata
        LEFT JOIN programme ON sprogid = progid LEFT JOIN faculty ON facid = faculty.facultyid LEFT JOIN tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE indexno = '$id'";


$info = array();

$rs13 = mysqli_query($conn2, $sql13);
if($rs13) {
    while($row13 = mysqli_fetch_assoc($rs13)) {
        $info[] = $row13;
    }
}
    
echo json_encode($info);

?>
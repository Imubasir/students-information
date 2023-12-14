<?php
require_once('../Db/connection2.php');
$id=$_POST['index'];
$uin=$_POST['transid'];

//$title = $_POST['title'];
$data = array();
$sql = "SELECT t1.`indexno`, concat(t1.firstname,' ', IFNULL(t1.middlename,''),' ', t1.surname) AS name, if(t2.progname LIKE'DIP%','2-year', '4-year')AS numyears,if(t2.progname LIKE'DIP%','', 'degree')AS deg,t2.fullname, t2.progname, if(t1.gender='Male','his', 'her') AS gender, verify_code FROM arms_pg.studentbiodata AS t1 LEFT JOIN arms_pg.programme AS t2 ON t2.progid =t1.sprogid LEFT JOIN arms.trial_transcript on t1.`indexno` = trial_transcript.indexno WHERE t1.indexno='$id' and trial_transcript.trans_uin = '$uin' ";

$data = array();
$rs = mysqli_query($conn2, $sql);
if($rs) {
    while ($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn2->error;
}
echo json_encode($data);
?>
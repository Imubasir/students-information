<?php
require_once("../Db/connection.php");
$id = $_POST['index'];
$trans_id = $_POST['transid'];

$sql = "SELECT t1.indexno,t1.entryyear,concat(t1.firstname,' ', IFNULL(t1.middlename,''),' ', t1.surname) AS name, if(t2.progname LIKE'DIP%','2-year', '4-year') AS numyears,if(t2.progname LIKE'DIP%','', 'degree')AS deg,t2.fullname, t2.progname,t2.facid, if(t1.gender='Male','him', 'her') AS gender, if(t1.gender='Male','His', 'Her') AS gender2, facultyname, gradclass, verify_code, countrynm, consulate, people, consulatelocation, levelname FROM arms.studentbiodata AS t1 LEFT JOIN arms.programme AS t2 ON t2.progid =t1.sprogid LEFT JOIN tbl_graduate ON t1.indexno = tbl_graduate.indexno LEFT JOIN faculty on faculty.facultyid = t2.facid LEFT JOIN trial_transcript on trial_transcript.indexno = t1.indexno LEFT JOIN tbl_country ON trial_transcript.country = tbl_country.country_id LEFT JOIN level ON t1.currentlevel = level.levelid WHERE t1.indexno='$id' and trial_transcript.trans_uin = '$trans_id' ";

$data = array();
$rs = mysqli_query($conn, $sql);
if($rs) {
    while ($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}    
echo json_encode($data);

?>
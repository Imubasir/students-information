<?php
require_once('../Db/connection.php');
$sql = "SELECT action_date, tbl_schedule.indexnum, first_name, last_name, cat, trans_id, Req_No_Rem, trial_transcript.submitted_date FROM tbl_schedule inner join tbl_user_profile on username = assignedto inner join trial_transcript on tbl_schedule.trans_id = trial_transcript.trans_uin order by tbl_schedule.date_added DESC";
$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

echo json_encode($data);
?>
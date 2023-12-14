<?php
require("../Db/connection2.php");
$sql = "SELECT * FROM arms.trial_transcript LEFT JOIN arms.tbl_schedule ON arms.trial_transcript.trans_uin = arms.tbl_schedule.trans_id LEFT JOIN arms.tbl_user_profile ON arms.tbl_schedule.assignedto = tbl_user_profile.username LEFT JOIN arms_pg.programme ON trial_transcript.programme = programme.progid WHERE Req_No_Rem = '0' and category = 'Postgraduate' ORDER BY action_date DESC";

$rs= mysqli_query($conn2, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo $conn2->error;
}

?>
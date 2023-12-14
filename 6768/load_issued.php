<?php
require("../Db/connection.php");
$sql = "SELECT * FROM trial_transcript LEFT JOIN tbl_schedule ON trial_transcript.trans_uin = tbl_schedule.trans_id LEFT JOIN tbl_user_profile ON tbl_schedule.assignedto = tbl_user_profile.username LEFT JOIN programme ON trial_transcript.programme = programme.progid WHERE Req_No_Rem = '0' and category = 'Undergraduate' ORDER BY action_date DESC";

$rs= mysqli_query($conn, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo $conn->error;
}

?>
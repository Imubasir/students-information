<?php
session_start();
    require_once('../Db/connection2.php');
    $username = $_SESSION['uname'];
    $sql = "SELECT * FROM arms.trial_transcript LEFT JOIN arms_pg.programme on trial_transcript.programme = programme.progid LEFT JOIN arms.tbl_schedule on trans_uin = trans_id where assignedto = '$username' and Req_No_Rem != 0 and category = 'Postgraduate' order by service_type ASC";
    $result = mysqli_query($conn2, $sql);
    $data = array();

    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo $conn2->error;
    }

echo json_encode($data);
?>
<?php
session_start();
    require_once('../Db/connection.php');
    $username = $_SESSION['uname'];
    $sql = "SELECT * FROM trial_transcript LEFT JOIN programme on trial_transcript.programme = programme.progid LEFT JOIN tbl_schedule on trans_uin = trans_id where assignedto = '$username' and Req_No_Rem != 0 and category = 'Undergraduate' order by service_type ASC";
    $result = mysqli_query($conn, $sql);
    $data = array();

    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo $conn->error;
    }

echo json_encode($data);
?>
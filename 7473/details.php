<?php
    require_once('../Db/connection.php');
    require_once('../Db/connection2.php');
    $id = $_POST['id'];

    $sql = "SELECT * FROM arms.trial_transcript
            LEFT JOIN arms_pg.studentbiodata ON arms.trial_transcript.indexno = arms_pg.studentbiodata.indexno 
            LEFT JOIN arms_pg.programme on arms_pg.studentbiodata.sprogid = arms_pg.programme.progid 
            WHERE arms.trial_transcript.trans_uin='$id'";

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
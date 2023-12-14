<?php
    require_once('../Db/connection.php');
    $id = $_POST['id'];

    $sql = "SELECT * FROM trial_transcript LEFT JOIN studentbiodata ON trial_transcript.indexno = studentbiodata.indexno LEFT JOIN programme on studentbiodata.sprogid = programme.progid WHERE  trial_transcript.trans_uin='$id'";
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
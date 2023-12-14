<?php
    require_once('../Db/connection.php');
    $id = $_POST['id'];
    $trans = $_POST['trans'];
    
    $sql = "SELECT * FROM trial_transcript WHERE indexno = '$id' and trans_uin = '$trans' ";
    $result = mysqli_query($conn, $sql);
    $data = array();

    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row['verify_code'];
        }
             
    } else {
        echo $conn->error;
    }

?>
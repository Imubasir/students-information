<?php
require_once("../Db/connection.php");
$tracking_id = $_POST['req_id'];

$sql = "SELECT * FROM trial_transcript WHERE trans_uin = '$tracking_id'";
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
<?php
require('../Db/connection.php');
$trans_id = $_POST['id'];

$sql = "SELECT * FROM tbl_schedule inner join tbl_user_profile on username = assignedto where trans_id = '$trans_id'";
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
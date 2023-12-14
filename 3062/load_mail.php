<?php
require('../Db/connection.php');
$id = $_POST['id'];

$sql = "SELECT inbox.*, CONCAT_WS(' ', tbl_user_profile.first_name, tbl_user_profile.middle_name, tbl_user_profile.last_name) AS name FROM inbox LEFT JOIN tbl_user_profile ON username = sender where id = '$id' ";
$sql_update = "UPDATE inbox SET status = '1' WHERE id = '$id'";
$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
    $rs_update = mysqli_query($conn, $sql_update);
} else {
    echo $conn->error;
}
echo json_encode($data);
?>
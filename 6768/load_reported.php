<?php
require("../Db/connection.php");
$sql = "SELECT inbox.*, CONCAT_WS(' ', tbl_user_profile.first_name, tbl_user_profile.middle_name, tbl_user_profile.last_name) AS name FROM inbox LEFT JOIN tbl_user_profile ON username = sender order by `date` DESC";

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
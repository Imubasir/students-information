<?php
require('../Db/connection.php');

$sql = "SELECT staff_ID, concat_ws(' ', first_name, middle_name, last_name) as name, status FROM tbl_user_profile order by name ASC";
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
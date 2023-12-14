<?php
require_once('../Db/connection.php');

$sql = "SELECT * FROM uni_halls LEFT JOIN tbl_campus ON hall_campus_id = campus_id ORDER BY hall_name ASC";
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
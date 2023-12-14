<?php
require_once('../Db/connection.php');

$sql = "SELECT * FROM tbl_campus left join region on tbl_campus.region = region.regionid order by campus_descr ASC";
$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] =$row;
    }
} else {
    echo $conn->error;
}

echo json_encode($data);
?>
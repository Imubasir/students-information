<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$sql_fetch1 = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata on indexno = indexno LEFT JOIN programme on sprogid=progid WHERE graddate = 'JULY 31 2019' ";
$sql_fetch2 = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata on indexno = indexno LEFT JOIN programme on sprogid=progid WHERE graddate = 'JULY 31 2019' ";

$rs_1 = mysqli_query($conn, $sql_fetch1);
$rs_2 = mysqli_query($conn2, $sql_fetch2);

$data = array();
if($rs_1) {
    while($row = mysqli_fetch_assoc($rs_1)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

if($rs_2) {
    while($row_2 = mysqli_fetch_assoc($rs_2)) {
        $data[] = $row_2;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);
?>
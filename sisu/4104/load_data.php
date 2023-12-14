<?php
require_once('../Db/connection.php');
$sql = "SELECT * FROM course left join department on course.deptid = department.deptid order by coursecode ASC";
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
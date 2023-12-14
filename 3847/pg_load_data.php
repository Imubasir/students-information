<?php
require_once('../Db/connection.php');
require_once('../Db/connection2.php');

$sql = "SELECT * FROM programme left join arms.faculty on programme.facid = faculty.facultyid left join arms.department on dept_id= deptid left join arms.tbl_campus on fcampus_id = arms.tbl_campus.campus_id order by progname ASC";
$rs = mysqli_query($conn2, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);
?>
<?php
require_once('../Db/connection.php');
$sql = "SELECT deptid, deptname, department.facultyid, department.campus, facultyname, hod, tbl_campus.campus_descr FROM department left join faculty on department.facultyid = faculty.facultyid left join tbl_campus on department.campus = tbl_campus.campus_id order by deptname ASC";
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
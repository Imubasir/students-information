<?php
require_once('../Db/connection.php');
$id = $_POST['id'];

$sql = "SELECT * FROM programme left join faculty on programme.facid = faculty.facultyid left join department on dept_id= deptid left join tbl_campus on fcampus_id = tbl_campus.campus_id where programme.progid = '$id'";
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
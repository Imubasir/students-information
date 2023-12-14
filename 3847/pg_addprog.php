<?php
session_start();
require_once('../Db/connection.php');
require_once('../Db/connection2.php');

$progname = strtoupper($_POST['progname']);
$progfullname = strtoupper($_POST['progfullname']);
$duration = strtoupper($_POST['duration']);
$dept = strtoupper($_POST['dept']);
$status = strtoupper($_POST['pg_prg_status']);
$user = strtoupper($_SESSION['uname']);

$query = "SELECT arms.department.facultyid, arms.faculty.fcampus_id from arms.department left join arms.faculty on arms.department.facultyid = arms.faculty.facultyid where deptid = '$dept'";
$query2 = "SELECT curindex from progindex";

$rs1 = mysqli_query($conn2, $query);
if($rs1) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $id = $row['facultyid'];
        $fcam_id = $row['fcampus_id'];
    }
        $rs2 = mysqli_query($conn2, $query2);
        if($rs2) {
            while($row2 = mysqli_fetch_assoc($rs2)) {
                $index = $row2['curindex'];
            }
                $progid = $id.'-'.$index;
                
            $sql = "INSERT INTO programme (progid, progname, fullname, facid, dept_id, duration, prg_status, added_by) values ('$progid', '$progname', '$progfullname', '$id', '$dept', '$duration', '$status', '$user')";
                $rs = mysqli_query($conn2, $sql);
                
                if($rs) {
                    echo 1;
                    $query3 = "UPDATE progindex SET curindex = curindex+1";
                    $rs = mysqli_query($conn2, $query3);
                } else {
                    echo $conn2->error;
                }
        } else {
            echo $conn2->error;
        }
} else {
    echo $conn2->error;
}

?>
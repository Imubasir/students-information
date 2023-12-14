<?php
session_start();
require('../Db/connection.php');

$progname = strtoupper($_POST['progname']);
$progfullname = strtoupper($_POST['progfullname']);
$duration = strtoupper($_POST['duration']);
$dept = strtoupper($_POST['dept']);
$status = strtoupper($_POST['prg_status']);
$user = strtoupper($_SESSION['uname']);

$query = "SELECT department.facultyid, fcampus_id from department left join faculty on department.facultyid = faculty.facultyid where deptid = '$dept'";
$query2 = "SELECT curindex from progindex";

$rs1 = mysqli_query($conn, $query);
if($rs1) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $id = $row['facultyid'];
        $fcam_id = $row['fcampus_id'];
    }
        $rs2 = mysqli_query($conn, $query2);
        if($rs2) {
            while($row2 = mysqli_fetch_assoc($rs2)) {
                $index = $row2['curindex'];
            }
                $progid = $id.'-'.$index;
                
            $sql = "INSERT INTO programme (progid, progname, fullname, facid, dept_id, duration, prg_status, added_by) values ('$progid', '$progname', '$progfullname', '$id', '$dept', '$duration', '$status', '$user')";
                $rs = mysqli_query($conn, $sql);
                
                if($rs) {
                    echo 1;
                    $query3 = "UPDATE progindex SET curindex = curindex+1";
                    $rs = mysqli_query($conn, $query3);
                } else {
                    echo $conn->error;
                }
        } else {
            echo $conn->error;
        }
} else {
    echo $conn->error;
}

?>
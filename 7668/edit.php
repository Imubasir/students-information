<?php 
session_start();
require_once('../Db/connection.php');

$key = $_POST['key'];
$dept = $_POST['e_deptname'];
$hod = $_POST['e_hod'];
$faculty = $_POST['e_faculty'];
$user = $_SESSION['uname'];
$campus = $_POST['e_campus'];
$date = date('Y-m-d h:m:s');

$sql = "UPDATE department SET deptname = '$dept', facultyid= '$faculty', hod = '$hod', campus = '$campus', modified_by = '$user', dept_date_modified = '$date' where deptid = '$key'";

$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
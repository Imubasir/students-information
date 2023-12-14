<?php
session_start();
require("../Db/connection.php");

$progname = $_POST['e_progname'];
$key = $_POST['key'];
$progfullname = $_POST['e_progfullname'];
$duration = $_POST['e_duration'];
$dept = $_POST['e_dept'];
$user = $_SESSION['uname'];

$today = date("Y-m-d H:i:s");
$user = $_SESSION['uname'];

$sql = "UPDATE programme set progname = '$progname', fullname = '$progfullname', duration='$duration', dept_id='$dept', modified_by = '$user', date_modified='$today' where progid= '$key'";

$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
<?php
session_start();

require_once('../Db/connection2.php');

$code = $_POST['pg_code'];
$title = $_POST['pg_title'];
$credit = $_POST['pg_credits'];
$dept = $_POST['pg_dept'];
$user = $_SESSION['uname'];

$sql = "INSERT INTO course (coursecode, coursetitle, credit, deptid, added_by) values ('$code', '$title', '$credit', '$dept', '$user')";
$rs = mysqli_query($conn2, $sql);

if($rs) {
    echo 1;
} else {
    echo $conn2->error;
}
?>
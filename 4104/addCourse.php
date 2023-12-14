<?php
session_start();

require_once('../Db/connection.php');

$code = $_POST['code'];
$title = $_POST['title'];
$credit = $_POST['credits'];
$dept = $_POST['dept'];
$user = $_SESSION['uname'];

$sql = "INSERT INTO course (coursecode, coursetitle, credit, deptid, added_by) values ('$code', '$title', '$credit', '$dept', '$user')";
$rs = mysqli_query($conn, $sql);

if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
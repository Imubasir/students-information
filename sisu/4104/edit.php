<?php 
session_start();
require_once('../Db/connection.php');

$key = $_POST['key'];
$code = $_POST['e_code'];
$title = $_POST['e_title'];
$credits = $_POST['e_credits'];
$user = $_SESSION['uname'];
if(isset($_POST['e_dept'])) {
    $dept = $_POST['e_dept'];
} else {
    $dept = '';
}
$today = date('Y-m-d H:i:s');

$sql = "UPDATE course SET coursecode = '$code', coursetitle= '$title', credit = '$credits', deptid = '$dept', modified_by='$user', date_modified='$today' where coursecode = '$key'";

$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
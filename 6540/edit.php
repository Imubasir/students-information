<?php 
session_start();
require_once('../Db/connection.php');

$id = $_POST['Ehall_id'];
$hallName = $_POST['Ehall_name'];
$hallGender = $_POST['Ehall_gender'];
$hallCampus = $_POST['Ehall_campus'];
$hallCapacity = $_POST['Ehall_capacity'];

$user = $_SESSION['uname'];
$today = date('Y-m-d H:i:s');

$sql = "UPDATE uni_halls SET hall_name = '$hallName', hall_gender= '$hallGender', hall_campus_id = '$hallCampus', hall_capacity = '$hallCapacity', hall_modified_by='$user', hall_date_modified='$today' where hall_id = '$id'";

$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
<?php
session_start();

require_once('../Db/connection.php');

$hallName = $_POST['hall_name'];
$hallGender = $_POST['hall_gender'];
$hallCampus = $_POST['hall_campus'];
$hallCapacity = $_POST['hall_capacity'];
$user = $_SESSION['uname'];

$sql = "INSERT INTO uni_halls (hall_name, hall_gender, hall_capacity, hall_campus_id, hall_added_by) values ('$hallName', '$hallGender', '$hallCapacity', '$hallCampus', '$user')";
$rs = mysqli_query($conn, $sql);

if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
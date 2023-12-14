<?php
session_start();
require_once('../Db/connection.php');
$key = $_POST['key'];
$message = mysqli_real_escape_string($conn, $_POST['value']);
$subject = mysqli_real_escape_string($conn, $_POST['subj']);
$user = $_SESSION['LNAME'].' '.$_SESSION['FNAME'];

$sql = "INSERT INTO inbox (receipient, subject, sender, message) values ('$key', '$subject', '$user', '$message')";
$rs = mysqli_query($conn, $sql);

if($rs) {
    echo 1;
} else {
    echo $conn->error;
}

?>
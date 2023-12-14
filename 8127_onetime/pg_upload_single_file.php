<?php
session_start();
set_time_limit(0);
require("../Db/connection2.php");

$user = strtoupper($_SESSION['uname']);

$uin = $_POST['new_pg_uin'];
$indexno = strtoupper($_POST['new_pg_indexno']);
$surname = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_surname']));
$middlename = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_middlename']));
$firstname = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_firstname']));
$gender = strtoupper($_POST['new_pg_gender']);
$dob = strtoupper($_POST['new_pg_dob']);
$hometown = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_hometown']));
$rob = $_POST['new_pg_homeregion'];
$address = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_address']));
$phone = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_phone']));
$programme = strtoupper($_POST['new_pg_programme']);
$entryyear = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_admitted_year']));
$entrylevel = strtoupper(mysqli_real_escape_string($conn, $_POST['new_pg_admitted_lvl']));
$nationality = $_POST['new_pg_nationality'];


$sql = "INSERT INTO studentbiodata (uin, indexno, surname, middlename, firstname, gender, dob, htown, rob, homeaddress, fonnumber, sprogid, entryyear, entrylevel, nationality, added_by) values ('$uin', '$indexno', '$surname', '$middlename', '$firstname', '$gender', '$dob', '$hometown', '$rob', '$address', '$phone', '$programme', '$entryyear', '$entrylevel', '$nationality', '$user') ";

$rs = mysqli_query($conn2, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn2->error;
}
?>
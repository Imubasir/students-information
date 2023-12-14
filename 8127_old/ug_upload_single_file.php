<?php
session_start();
set_time_limit(0);
require("../Db/connection.php");
$user = $_SESSION['uname'];
$uin = $_POST['ug_new_uin'];
$indexno = $_POST['ug_new_indexno'];
$surname = mysqli_real_escape_string($conn, $_POST['ug_new_surname']);
$middlename = mysqli_real_escape_string($conn, $_POST['ug_new_middlename']);
$firstname = mysqli_real_escape_string($conn, $_POST['ug_new_firstname']);
$gender = $_POST['ug_new_gender'];
$dob = $_POST['ug_new_dob'];
$pob = $_POST['ug_new_pob'];
$hometown = mysqli_real_escape_string($conn, $_POST['ug_new_hometown']);
$rob = $_POST['ug_new_rob'];
$address = mysqli_real_escape_string($conn, $_POST['ug_new_address']);
$phone = mysqli_real_escape_string($conn, $_POST['ug_new_phone']);
$disability_status = $_POST['ug_new_disability_status'];
$disability_descr = mysqli_real_escape_string($conn, $_POST['ug_new_disability_descr']);
$guardian_contact = mysqli_real_escape_string($conn, $_POST['ug_new_guardian_contact']);
$guardian_name = mysqli_real_escape_string($conn, $_POST['ug_new_guardian_name']);
$guardian_addr = mysqli_real_escape_string($conn, $_POST['ug_new_guardian_addr']);
$programme = $_POST['ug_new_programme'];
$entryyear = mysqli_real_escape_string($conn, $_POST['ug_new_entryyear']);
$entrylevel = mysqli_real_escape_string($conn, $_POST['ug_new_entrylevel']);
$curlevel = mysqli_real_escape_string($conn, $_POST['ug_new_curlevel']);
$option = $_POST['ug_new_option'];
$nationality = $_POST['ug_new_nationality'];
$study_duration = mysqli_real_escape_string($conn, $_POST['ug_new_study_duration']);
$admn_category = mysqli_real_escape_string($conn, $_POST['ug_new_admission_category']);

$sql = "INSERT INTO studentbiodata (uin, indexno, surname, middlename, firstname, gender, dob, pob, htown, rob, homeaddress, fonnumber, disability_status, disability_descr, guardian_contact, guardian_name, guardian_address, sprogid, entryyear, entrylevel, currentlevel, option_id, nationality, study_duration, admission_category, added_by) values ('$uin', '$indexno', '$surname', '$middlename', '$firstname', '$gender', '$dob', '$pob', '$hometown', '$rob', '$address', '$phone', '$disability_status', '$disability_descr', '$guardian_contact', '$guardian_name', '$guardian_addr', '$programme', '$entryyear', '$entrylevel', '$curlevel', '$option', '$nationality', '$study_duration', '$admn_category', '$user') ";

$rs = mysqli_query($conn, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn->error;
}
?>
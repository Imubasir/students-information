<?php
session_start();
require_once("../Db/connection.php");

$type = $_POST['up_type'];
$group = $_POST['up_programme'];
$level = $_POST['up_level'];

if($group == '' && $level == '') {
	$query = "SELECT uin, surname, middlename, firstname, gender, dob, sprogid, option_id, qualification_status, study_status FROM studentbiodata";

} else if ($group == '' && $level != '') {
	$query = "SELECT uin, surname, middlename, firstname, gender, dob, sprogid, option_id, qualification_status, study_status FROM studentbiodata WHERE entryyear = '$level'";

} else if ($level == '' && $group != '') {
	$query = "SELECT uin, surname, middlename, firstname, gender, dob, sprogid, option_id, qualification_status, study_status FROM studentbiodata WHERE sprogid = '$group'";
	
} else {
	echo "Error";
}

?>
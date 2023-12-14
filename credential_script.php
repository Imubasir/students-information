<?php

function random_username($fname, $lname, $uin) {
	$_fname = substr($fname, 0, 2);
	$_lname = substr($lname, 0, 2);
	$_uin = substr($uin, 0, 2);
	$_rand = rand(0, 100);
	return $_fname.$_lname.$_uin.$_rand;

}

function rand_password() {
	$strings = "0123456789abcdefghijklmnopqrstuvwxyz";
	    $pin =  substr(str_shuffle($strings), 0, 6)."\r\n";
	    return $pin;
	}


require_once("Db/connection.php");
ini_set('memory_limit', '-1');
set_time_limit(0);
$sql = "SELECT * FROM studentbiodata";
$rs = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($rs)) {
	$surname = $row['surname'];
	$firstname = $row['firstname'];
	$uin = $row['uin'];

	if($row['inst_mail'] == '') {
		$username = strtolower(random_username($surname, $firstname, $uin));
		$email = strtolower($row['surname'].substr($row['firstname'], 0, 2)."@uds.edu.gh");
		$pass = rand_password();

		$upd = "UPDATE studentbiodata SET inst_mail = '$email', username = '$username', password = '$pass' where uin = '$uin'";
		$rs_upd = mysqli_query($conn, $upd);
		if($rs_upd) {
			// echo "Successfully Updated";
		} else {
			echo $conn->error;
		}
	}
}
echo "Update Successfull";
?>
<!-- ABCDEFGHIJKLMNOPQRSTUVWXYZ -->
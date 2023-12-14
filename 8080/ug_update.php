<?php
session_start();
require("../Db/connection.php");

$user = $_SESSION['uname'];
$access = $_SESSION['access'];
$date_modified = date('Y-m-d H:i:s');
//variables
$indexno = $_POST['edit_indexno'];
$uin = $_POST['uin'];


$sql_fetch = "SELECT * FROM studentbiodata where uin = '$uin'";
$fetch_rs = mysqli_query($conn, $sql_fetch);
if($fetch_rs) {
    while($fetch_row = mysqli_fetch_assoc($fetch_rs)) {
        $upd_surname = $fetch_row['surname'];
        $upd_middlename = $fetch_row['middlename'];
        $upd_firstname = $fetch_row['firstname'];
        $upd_gender = $fetch_row['gender'];
        $upd_dob = $fetch_row['dob'];
        $upd_pob = $fetch_row['pob'];
        $upd_htown = $fetch_row['htown'];
        $upd_rob = $fetch_row['rob'];
        $upd_homeaddress = $fetch_row['homeaddress'];
        $upd_fonnumber = $fetch_row['fonnumber'];
        $upd_disability_status = $fetch_row['disability_status'];
        $upd_disability_descr = $fetch_row['disability_descr'];
        $upd_guardian_name = $fetch_row['guardian_name'];
        $upd_guardian_address = $fetch_row['guardian_address'];
        $upd_sprogid = $fetch_row['sprogid'];
        $upd_entryyear = $fetch_row['entryyear'];
        $upd_entrylevel = $fetch_row['entrylevel'];
        $upd_nationality = $fetch_row['nationality'];
        $upd_currentlevel = $fetch_row['currentlevel'];
        $upd_option_id = $fetch_row['option_id'];
    }
}

$sname = isset($_POST['sname']) ? mysqli_real_escape_string($conn, strtoupper($_POST['sname'])) : '';
$mname = isset($_POST['mname']) ? mysqli_real_escape_string($conn, strtoupper($_POST['mname'])) : '';
$fname = isset($_POST['fname']) ? mysqli_real_escape_string($conn, strtoupper($_POST['fname'])) : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
$pob = isset($_POST['pob']) ? mysqli_real_escape_string($conn, strtoupper($_POST['pob'])) : '';
$htown = isset($_POST['htown']) ? mysqli_real_escape_string($conn, strtoupper($_POST['htown'])) : '';
$rob = isset($_POST['rob']) ? $_POST['rob'] : '';
$homeaddress = isset($_POST['homeaddress']) ? mysqli_real_escape_string($conn, strtoupper($_POST['homeaddress'])) : '';
$fonnumber = isset($_POST['fonnumber']) ? mysqli_real_escape_string($conn, strtoupper($_POST['fonnumber'])) : '';
$disability_descr = isset($_POST['disability_descr']) ? mysqli_real_escape_string($conn, strtoupper($_POST['disability_descr'])) : '';
$guardian_name = isset($_POST['guardian_name']) ? mysqli_real_escape_string($conn, strtoupper($_POST['guardian_name'])) : '';
$nationality = isset($_POST['nationality']) ? $_POST['nationality'] : '';
$guardian_address = isset($_POST['guardian_address']) ? mysqli_real_escape_string($conn, strtoupper($_POST['guardian_address'])) : '';
$disability_status = isset($_POST['disability_status']) ? $_POST['disability_status'] : '';
$sprogid = isset($_POST['sprogid']) ? $_POST['sprogid'] : '';
$entryyear = isset($_POST['entryyear']) ? mysqli_real_escape_string($conn, strtoupper($_POST['entryyear'])) : '';
$entrylevel = isset($_POST['entrylevel']) ? mysqli_real_escape_string($conn, strtoupper($_POST['entrylevel'])) : '';
$currentlevel = isset($_POST['currentlevel']) ? $_POST['currentlevel'] : '';
$option = isset($_POST['edit_option']) ? $_POST['edit_option'] : '';

$sql_query = "UPDATE studentbiodata SET surname = '$sname', middlename = '$mname', firstname = '$fname', gender = '$gender', dob = '$dob', pob = '$pob', htown = '$htown', rob = '$rob', homeaddress = '$homeaddress', fonnumber = '$fonnumber', disability_status = '$disability_status', disability_descr = '$disability_descr', guardian_name = '$guardian_name', guardian_address = '$guardian_address', sprogid = '$sprogid', entryyear = '$entryyear', entrylevel = '$entrylevel', nationality = '$nationality',currentlevel = '$currentlevel', option_id = '$option', date_modified = '$date_modified', modified_by = '$user' WHERE indexno = '$indexno' ";

$sql_rs = mysqli_query($conn, $sql_query);
if($sql_rs) {

    //update UCM
    $update_array = array($indexno, $uin, $sname, $mname, $fname, $gender, $dob, $pob, $htown, $rob, $homeaddress, $fonnumber, $disability_descr, $disability_status, $guardian_name, $guardian_address, $nationality, $sprogid, $entryyear, $entrylevel, $currentlevel, $option);
    $state = update_ucm($update_array);
    echo $state;
    exit();

    $event = "UG Student Record Updated. UIN: ".$uin;

    if($upd_surname != $sname) {
        $event .= " Surname From ".$upd_surname. "-> ".$sname;
    }

    if($upd_middlename != $mname) {
        $event .= " Middlename From ".$upd_middlename. "-> ".$mname;
    }

    if($upd_firstname != $fname) {
        $event .= " Firstname From ".$upd_firstname. "-> ".$fname;
    }

    if($upd_gender != $gender) {
        $event .= " Gender From ".$upd_gender. "-> ".$gender;
    }

    if($upd_dob != $dob) {
        $event .= " DOB From ".$upd_dob. "-> ".$dob;
    }

    if($upd_pob != $pob) {
        $event .= " Place of Birth From ".$upd_pob. "-> ".$pob;
    }

    if($upd_htown != $htown) {
        $event .= " Home TownFrom ".$upd_htown. "-> ".$htown;
    }

    if($upd_rob != $rob) {
        $event .= " Region of Birth From ".$upd_rob. "-> ".$rob;
    }

    if($upd_homeaddress != $homeaddress) {
        $event .= " Home Address From ".$upd_homeaddress. "-> ".$homeaddress;
    }

    if($upd_fonnumber != $fonnumber) {
        $event .= " Phone From ".$upd_fonnumber. "-> ".$fonnumber;
    }

    if($upd_disability_status != $disability_status) {
        $event .= " Disability Status From ".$upd_disability_status. "-> ".$disability_status;
    }

    if($upd_disability_descr != $disability_descr) {
        $event .= " Disability Description From ".$upd_disability_descr. "-> ".$disability_descr;
    }

    if($upd_guardian_name != $guardian_name) {
        $event .= " Guardian Name From ".$upd_guardian_name. "-> ".$guardian_name;
    }

    if($upd_guardian_address != $guardian_address) {
        $event .= " Guardian Address From ".$upd_guardian_address. "-> ".$guardian_address;
    }

    if($upd_sprogid != $sprogid) {
        $event .= " Programme From ".$upd_sprogid. "-> ".$sprogid;
    }

    if($upd_entryyear != $entryyear) {
        $event .= " Entry year From ".$upd_guardian_address. "-> ".$guardian_address;
    }

    if($upd_entrylevel != $entrylevel) {
        $event .= " Entry Level From ".$upd_entrylevel. "-> ".$entrylevel;
    }

    if($upd_nationality != $nationality) {
        $event .= " Nationality From ".$upd_nationality. "-> ".$nationality;
    }

    if($upd_currentlevel != $currentlevel) {
        $event .= " Current Level From ".$upd_currentlevel. "-> ".$currentlevel;
    }

    if($upd_option_id != $option) {
        $event .= " Option From ".$upd_option_id. "-> ".$option;
    }

    $sql_log = "INSERT INTO tbl_log(event, username, access_lvl) VALUES ('$event', '$user', '$access')";
    $sql_rs = mysqli_query($conn, $sql_log);
    if($sql_rs) {
        echo 1;
    } else {
        echo $conn->error;
    }
}else {
    echo $conn->error;
 }

 function update_ucm($array_name) {
    require("../Db/connection.php");
    $status = '';
    
    $indexno = $array_name[0];
    $uin = $array_name[1];
    $sname = $array_name[2];
    $mname = $array_name[3];
    $fname = $array_name[4];
    $gender = $array_name[5];
    $dob = $array_name[6];
    $pob = $array_name[7];
    $htown = $array_name[8];
    $rob = $array_name[9];
    $homeaddress = $array_name[10];
    $fonnumber = $array_name[11];
    $disability_descr = $array_name[12];
    $disability_status = $array_name[13];
    $guardian_name = $array_name[14];
    $guardian_address = $array_name[15];
    $nationality = $array_name[16];
    $sprogid = $array_name[17];
    $entryyear = $array_name[18];
    $entrylevel = $array_name[19];
    $currentlevel = $array_name[20];
    $option = $array_name[21];

    $update_ucm = "UPDATE ucm_student_profile SET first_name = '$fname', middle_name = '$mname', last_name = '$sname', gender = '$gender', dob = '$dob', phone = '$fonnumber' WHERE uin = '$uin'";

    $update_rs = mysqli_query($conn, $update_ucm);
    if($update_rs) {
        $status = 'Updated';
    } else {
        
        $status = 'Failed';
    }

return $status;
 }
?>
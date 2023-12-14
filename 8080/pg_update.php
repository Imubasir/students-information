<?php
session_start();
require("../Db/connection2.php");
require("../Db/connection.php");

$user = $_SESSION['uname'];
$access = $_SESSION['access'];
$date_modified = date('Y-m-d');
//variables
$indexno = $_POST['pg_edit_indexno'];
$uin = $_POST['pg_uin'];

$sql_fetch = "SELECT * FROM studentbiodata where uin = '$uin'";
$fetch_rs = mysqli_query($conn2, $sql_fetch);
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

if(mysqli_real_escape_string($conn2, $_POST['pg_sname']) != '') {
    $sname= mysqli_real_escape_string($conn2, $_POST['pg_sname']);
}else {
    $sname = '';
}

if(mysqli_real_escape_string($conn2, $_POST['pg_mname']) != '') {
    $mname = mysqli_real_escape_string($conn2, $_POST['pg_mname']);
}else {
    $mname = '';
}

if(mysqli_real_escape_string($conn2, $_POST['pg_fname']) != '') {
    $fname = mysqli_real_escape_string($conn2, $_POST['pg_fname']);

}else {
    $fname = '';
}

if(isset($_POST['pg_gender'])) {
    $gender= $_POST['pg_gender'];

}else {
    $gender = '';
}

if(isset($_POST['pg_dob'])) {
    $dob = $_POST['pg_dob'];

}else {
    $dob = '';
}

if(mysqli_real_escape_string($conn2, $_POST['pg_pob']) != '') {
    $pob = mysqli_real_escape_string($conn2, $_POST['pg_pob']);

}else {
    $pob = '';
}
if(mysqli_real_escape_string($conn2, $_POST['pg_htown']) != '') {
    $htown = mysqli_real_escape_string($conn2, $_POST['pg_htown']);

}else {
    $htown = '';
}

if(isset($_POST['pg_rob'])) {
    $rob = $_POST['pg_rob'];

}else {
    $rob = '';

}
if(mysqli_real_escape_string($conn2, $_POST['pg_homeaddress']) != '') {
    $homeaddress = mysqli_real_escape_string($conn2, $_POST['pg_homeaddress']);

}else {
    $homeaddress = '';

}
if(mysqli_real_escape_string($conn2, $_POST['pg_fonnumber']) != '') {
    $fonnumber = mysqli_real_escape_string($conn2, $_POST['pg_fonnumber']);

}else {
    $fonnumber = '';

}

if(mysqli_real_escape_string($conn2, $_POST['pg_disability_descr']) != '') {
    $disability_descr = mysqli_real_escape_string($conn2, $_POST['pg_disability_descr']);

}else {
    $disability_descr = '';

}

if(mysqli_real_escape_string($conn2, $_POST['pg_guardian_name']) != '') {
    $guardian_name = mysqli_real_escape_string($conn2, $_POST['pg_guardian_name']);

} else {
    $guardian_name = '';
}

if(isset($_POST['pg_nationality'])) {
    $nationality = $_POST['pg_nationality'];
} else {
    $nationality = '';
}

if(mysqli_real_escape_string($conn2, $_POST['pg_guardian_address']) != '') {
    $guardian_address= mysqli_real_escape_string($conn2, $_POST['pg_guardian_address']);
} else {
    $guardian_address= '';
}

$disability_status = $_POST['pg_disability_status'];
$sprogid = $_POST['pg_sprogid'];
$entryyear = $_POST['pg_entryyear'];
$entrylevel = $_POST['pg_entrylevel'];
$currentlevel = $_POST['pg_currentlevel'];
// $option = $_POST['pg_edit_option'];


$sql_query = "UPDATE studentbiodata SET surname = '$sname', middlename = '$mname', firstname = '$fname', gender = '$gender', dob = '$dob', pob = '$pob', htown = '$htown', rob = '$rob', homeaddress = '$homeaddress', fonnumber = '$fonnumber', disability_status = '$disability_status', disability_descr = '$disability_descr', guardian_name = '$guardian_name', guardian_address = '$guardian_address', sprogid = '$sprogid', entryyear = '$entryyear', entrylevel = '$entrylevel', nationality = '$nationality',currentlevel = '$currentlevel', date_modified = '$date_modified', modified_by = '$user' WHERE indexno = '$indexno' ";

$sql_rs = mysqli_query($conn2, $sql_query);
if($sql_rs) {

    $event = "PG Student Record Updated. UIN: ".$uin;

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

    // if($upd_option_id != $option) {
    //     $event .= " Option From ".$upd_option_id. "-> ".$option;
    // }

    $sql_log = "INSERT INTO tbl_log(event, username, access_lvl) VALUES ('$event', '$user', '$access')";
    $sql_rs = mysqli_query($conn, $sql_log);
    if($sql_rs) {
        echo 1;
    } else {
        echo $conn->error;
    }
}else {
    echo $conn2->error;
 }
?>
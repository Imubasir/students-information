<?php
$uin = $_POST['id'];

function random_username($sname,$fname,$suin){
    $fname=strtolower(str_replace(' ','',$fname));
    $sname=strtolower(substr($sname,0,2));
    $suin=strtolower(substr($suin,0,2));
    $nrRand=rand(0,100);
    return $fname.$sname.$suin.$nrRand;
}

function rand_password() {
	$strings = "0123456789";
	    $pin =  substr(str_shuffle($strings), 0, 8);
	    return $pin;
}

$api_url = "http://admissions.uds.edu.gh/api/students/graduate/".$uin;
$response = file_get_contents($api_url);
$response = json_decode($response, TRUE);

$surname = strtoupper($response[0]['surname']);
                $firstname = strtoupper($response[0]['firstname']);
                $middlename = strtoupper($response[0]['middlename']);
                $gender = $response[0]['gender'];
                if($gender == "F") {
                    $gender = "FEMALE";
                } else if ($gender == "M") {
                    $gender = "MALE";
                }
                $dateofbirth = strtoupper($response[0]['dateofbirth']);
                $placeofbirth = strtoupper($response[0]['placeofbirth']);
                $nationality = strtoupper($response[0]['nationality']);
                $hometown = strtoupper($response[0]['hometown']);
                $homeregion = strtoupper($response[0]['homeregion']);
                /**  `homeaddress` **/
                $boxnumber = strtoupper($response[0]['boxnumber']);
                $add_town = strtoupper($response[0]['add_town']);
                $add_region = strtoupper($response[0]['add_region']);
                $homeaddress = mysqli_real_escape_string($conn, strtoupper($boxnumber))." ".mysqli_real_escape_string($conn, strtoupper($add_town))." ".mysqli_real_escape_string($conn, strtoupper($add_region));
                /**  `************` **/
                $entry_level = strtoupper($response[0]['entry_level']);
                $entry_year = strtoupper($response[0]['entry_year']);
                $study_duration = strtoupper($response[0]['study_duration']);
                $image_id = strtoupper($response[0]['image_id']);
                $disability = strtoupper($response[0]['disability']);
                $descr_disability = strtoupper($response[0]['descr_disability']);
                $name_guardian = strtoupper($response[0]['name_guardian']);
                $address_guardian = strtoupper($response[0]['address_guardian']);
                $admitted_programme = strtoupper($response[0]['admitted_programme']);
                $contact = strtoupper($response[0]['contact']);

                $username = strtolower(random_username($surname, $firstname, $uin));
                $password = rand_password();
                $email = $username."@uds.edu.gh";
                $user = $_SESSION['uname'];

                $date_modified = date("Y-m-d");
                $sql_update = "UPDATE studentbiodata SET surname = '$surname', middlename = '$middlename', firstname = '$firstname', gender = '$gender', dob = '$dateofbirth', pob = '$placeofbirth', htown = '$hometown', rob = '$homeregion', homeaddress = '$homeaddress', fonnumber = '$contact', disability_status = '$disability', disability_descr = '$descr_disability', guardian_name = '$name_guardian', guardian_address = '$address_guardian', sprogid = '$programme', entryyear = '$entry_year', entrylevel = '$entry_level', nationality = '$nationality', pic_id = '$image_id', study_status = 'On-Going', username = '$username', wifi_password='$password', inst_mail='$email', password='$uin', date_modified = '$date_modified', modified_by = '$user' WHERE uin = '$uin' ";

                $sql_rs = mysqli_query($conn2, $sql_update);
                if($sql_rs) {
                    $event = "Student UIN: ".$uin.". Index No. ".$indexno." Updated for PG";
                    $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                    $rs_log = mysqli_query($conn2, $log_insert);
                    if($rs_log) {
                        echo "1";
                    } else {
                        echo $conn2->error;
                    }
                } else {
                    echo "2";
                }


?>
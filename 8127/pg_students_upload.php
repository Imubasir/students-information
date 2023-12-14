<?php
session_start();
set_time_limit(0);
require_once("../Db/connection2.php");
require_once("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");

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

$programme = $_POST['pg_program_file'];
$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['pg_students_upload']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['pg_students_upload']['name'];
    if(move_uploaded_file($_FILES['pg_students_upload']['tmp_name'], $targetPath)) {

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
        
        $counter = 0;
        for($i=0;$i<$sheetCount;$i++){
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row){
                if($counter == 0){
                    $counter++;
                    continue;
                };

                $uin = $Row[0];
                $indexno = $Row[1];
                if($uin == '') {
                    echo "UIN Not Found \n";
                } else if($indexno == '') {
                    echo "Index Number Not Found \n";
                } else {

                /*$api_url = "http://admissions.uds.edu.gh/api/students/graduate/".$uin;
                $response = file_get_contents($api_url);
                $response = json_decode($response, TRUE);*/
                $response = array();
                $cURLConnection = curl_init();
                curl_setopt($cURLConnection, CURLOPT_URL, 'https://admissions.uds.edu.gh/api/students/biodata/'.$uin);
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false); // REMOVE THIS LINE IN PRODUCTION

                curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
                    'Authorization: $2y$10$TUbbijRgmw/ZhqGHxGY7CuBamCXPB5N9gpNrqqsYv1qL0S.1cn2vG',
                    'Client: sisu'
                ));

                $studentBiodata = curl_exec($cURLConnection);

                $response = json_decode($studentBiodata, true);
                if (curl_errno($cURLConnection)) {
                    $error_msg = curl_error($cURLConnection);
                }
                curl_close($cURLConnection);

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
                $hometown = mysqli_real_escape_string($conn, strtoupper($response[0]['hometown']));
                $homeregion = mysqli_real_escape_string($conn, strtoupper($response[0]['homeregion']));
                /**  `homeaddress` **/
                $boxnumber = strtoupper($response[0]['postal_address']);
                $add_town = strtoupper($response[0]['address_town']);
                $add_region = strtoupper($response[0]['address_region']);
                $homeaddress = mysqli_real_escape_string($conn, strtoupper($boxnumber))." ".mysqli_real_escape_string($conn, strtoupper($add_town))." ".mysqli_real_escape_string($conn, strtoupper($add_region));
                /**  `************` **/
                $entry_level = strtoupper($response[0]['entry_level']);
                $entry_year = strtoupper($response[0]['entry_year']);
                $study_duration = strtoupper($response[0]['study_duration']);
                $image_id = strtoupper($response[0]['image_id']);
                $disability = strtoupper($response[0]['disability']);
                $descr_disability = strtoupper($response[0]['descr_disability']);
                $name_guardian = strtoupper($response[0]['name_guardian']);
                $address_guardian = mysqli_real_escape_string($conn, strtoupper($response[0]['address_guardian']));
                $admitted_programme = strtoupper($response[0]['admitted_programme_id']);
                $contact = strtoupper($response[0]['contact']);

                $username = strtolower(random_username($surname, $firstname, $uin));
                $password = rand_password();
                $email = $username."@uds.edu.gh";
                $user = strtoupper($_SESSION['uname']);
                $access = $_SESSION['access'];

                switch ($entry_level) {
                    case '1ST YEAR':
                        $entry_level=1;
                        break;
                    case '2ND YEAR':
                        $entry_level=2;
                        break;
                    case '3RD YEAR':
                        $entry_level=3;
                        break;
                    case '100':
                        $entry_level=1;
                        break;
                    case '200':
                        $entry_level=2;
                        break;
                    case '300':
                        $entry_level=3;
                        break;
                    case '400':
                        $entry_level=4;
                        break;  
                        
                }

                /** Checking for existence **/
                $sql_check = "SELECT * FROM studentbiodata where indexno = '$indexno' ";
                $rs_check = mysqli_query($conn2, $sql_check);
                if($rs_check->num_rows <= 0) {
                    $sql_insert = "INSERT INTO studentbiodata (indexno, uin, surname, middlename, firstname, gender, dob, pob, htown, rob, homeaddress, fonnumber, disability_status, disability_descr, guardian_name, guardian_address, sprogid, entryyear, entrylevel, nationality, username, wifi_password, inst_mail, `password`, pic_id, study_status, added_by) VALUES ('$indexno', '$uin', '$surname', '$middlename', '$firstname', '$gender', '$dateofbirth', '$placeofbirth', '$hometown', '$homeregion', '$homeaddress', '$contact', '$disability', '$descr_disability', '$name_guardian', '$address_guardian', '$programme', '$entry_year', '$entry_level', '$nationality', '$username', '$password', '$email', '$uin', '$image_id', 'On-Going', '$user')";

                    $rs_insert = mysqli_query($conn2, $sql_insert);
                    if($rs_insert) {
                        $event = "Student UIN: ".$uin.". Index No. ".$indexno." Inserted for PG";
                        $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                        $rs_log = mysqli_query($conn, $log_insert);
                        if($rs_log) {
                            $inserted++;
                        } else {
                            echo $conn2->error;
                        }
                    } else {
                        echo $conn2->error;
                    }
                } else {
                    $date_modified = date("d-m-Y");
                    $sqlcheck1="select * from studentbiodata where indexno='$indexno'";
                    $rschk1=mysqli_query($conn2, $sqlcheck1);
                    $rowchk=mysqli_fetch_assoc($rschk1);
                    
                        if(trim($rowchk['surname'])){
                            if(strtoupper(trim($rowchk['surname']))!=='FAKE'){
                                $surname=trim($rowchk['surname']);
                            }
                        }
                        if(trim($rowchk['middlename'])){
                            if(strtoupper(trim($rowchk['surname']))!=='FAKE'){
                                $middlename=trim($rowchk['middlename']);
                            }
                        }
                        if(trim($rowchk['firstname'])){
                            if(strtoupper(trim($rowchk['surname']))!=='FAKE'){
                                $firstname=trim($rowchk['firstname']);
                            }
                        }
                        if(trim($rowchk['dob'])!='0000-00-00' || trim($rowchk['dob'])!=''){
                            $dob=trim($rowchk['dob']);
                        }
                        if(trim($rowchk['inst_mail'])){
                            $uds_email=trim($rowchk['inst_mail']);
                            $wifi_username=trim($rowchk['username']);
                            $wifi_password=trim($rowchk['password']);
                            
                        }else{
                            $uds_email='';
                            $wifi_username='';
                            $wifi_password='';
                        }
                        if(trim($rowchk['study_status'])){
                            $study_status=trim($rowchk['study_status']);
                        }
                        if(trim($rowchk['token'])){
                            $token=trim($rowchk['token']);
                        }
                        if(trim($rowchk['qualification_status'])){
                            $qualification_status=trim($rowchk['qualification_status']);
                        }
                        if(trim($rowchk['currentlevel'])){
                            $currentlevel=trim($rowchk['currentlevel']);
                        }

                    $sql_update = "UPDATE studentbiodata SET surname='$surname', middlename='$middlename', firstname='$firstname', gender='$gender', dob='$dateofbirth', pob='$placeofbirth', htown = '$hometown', rob='$homeregion', homeaddress='$homeaddress', fonnumber='$contact', guardian_contact='$guardian_contact', entryyear='$entry_year', entrylevel='$entry_level', currentlevel='$entry_level', study_status='$study_status', nationality='$nationality', pic_id='$image_id', study_duration='$study_duration', username='$wifi_username', wifi_password='$password', inst_mail='$uds_email', password='$uin', qualification_status='$qualification_status', sprogid='$programme', date_modified='$date_modified', modified_by='$user', admission_category= '$admission_category' WHERE indexno = '$indexno' AND uin='$uin'"; 

                    $sql_rs = mysqli_query($conn2, $sql_update);
                    if($sql_rs) {
                        $event = "Student UIN: ".$uin.". Index No. ".$indexno." updated";
                        $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                        $rs_log = mysqli_query($conn, $log_insert);
                        if($rs_log) {
                            $updated++;
                        } else {
                            echo $conn->error;
                        }
                    } else {
                        echo $conn->error;
                    }
                }
            }
            }
            echo "\n".$inserted." Postgraduate Inserted  \n";
            echo $updated. " Records Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
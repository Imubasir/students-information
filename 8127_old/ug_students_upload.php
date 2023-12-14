<?php
session_start();
set_time_limit(0);
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

$programme = $_POST['ug_program_file'];
$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['ug_students_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['ug_students_file']['name'];
    if(move_uploaded_file($_FILES['ug_students_file']['tmp_name'], $targetPath)) {

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());

        $counter = 0;
        for($i=0;$i<$sheetCount;$i++){ 

            $Reader->ChangeSheet($i);
            // if($counter > 0) {
            foreach ($Reader as $Row){
                if($counter == 0){
                    $counter++;
                    continue;
                };
                $uin = $Row[0];
                $indexno = $Row[1];
                if($uin == '') {
                    
                
                } else {

                $api_url = "http://admissions.uds.edu.gh/api/students/undergraduate/".$uin;
                $response = file_get_contents($api_url);
                $response = json_decode($response, TRUE);
                // if(empty($response)) {
                //     continue;
                // }
                $surname = strtoupper($response[0]['surname']);
                $firstname = strtoupper($response[0]['firstname']);
                $middlename = strtoupper($response[0]['middlename']);
                $gender = $response[0]['gender'];
                if($gender == "F") {
                    $gender = "FEMALE";
                } else if ($gender == "M") {
                    $gender = "MALE";
                }
                $dateofbirth = mysqli_real_escape_string($conn, strtoupper($response[0]['dateofbirth']));
                $placeofbirth = mysqli_real_escape_string($conn, strtoupper($response[0]['placeofbirth']));
                $nationality = mysqli_real_escape_string($conn, strtoupper($response[0]['nationality']));
                $hometown = mysqli_real_escape_string($conn, strtoupper($response[0]['hometown']));
                $homeregion = mysqli_real_escape_string($conn, strtoupper($response[0]['homeregion']));
                /**  `homeaddress` **/
                $boxnumber = mysqli_real_escape_string($conn, strtoupper($response[0]['boxnumber']));
                $add_town = mysqli_real_escape_string($conn, strtoupper($response[0]['add_town']));
                $add_region = mysqli_real_escape_string($conn, strtoupper($response[0]['add_region']));
                $homeaddress = mysqli_real_escape_string($conn, strtoupper($boxnumber))." ".mysqli_real_escape_string($conn, strtoupper($add_town))." ".mysqli_real_escape_string($conn, strtoupper($add_region));
                /**  `************` **/
                $entry_level = strtoupper($response[0]['entry_level']);
                $entry_year = strtoupper($response[0]['entry_year']);
                $study_duration = strtoupper($response[0]['study_duration']);
                $image_id = strtoupper($response[0]['image_id']);
                $disability = strtoupper($response[0]['disability']);
                $descr_disability = strtoupper($response[0]['descr_disability']);
                $name_guardian = mysqli_real_escape_string($conn, strtoupper($response[0]['name_guardian']));
                $address_guardian = mysqli_real_escape_string($conn, strtoupper($response[0]['address_guardian']));
                $admitted_programme = strtoupper($response[0]['admitted_programme']);
                $admission_category = strtoupper($response[0]['admission_category']);
                $contact = strtoupper($response[0]['contact']);

                $username = strtoupper(strtolower(random_username($surname, $firstname, $uin)));
                $password = rand_password();
                $email = $username."@uds.edu.gh";
                $user = $_SESSION['uname'];
                $access = $_SESSION['access'];

                switch ($entry_level) {
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
                        case '500':
                        $entry_level=5;
                        break;
                        case '600':
                        $entry_level=6;
                        break;
                        case '700':
                        $entry_level=7;
                        break;
                        case 'PBL 1':
                        $entry_level=1;
                        break;
                        case 'PBL 2':
                        $entry_level=2;
                        break;
                        case 'PBL 3':
                        $entry_level=3;
                        break;
                        case 'PBL 4':
                        $entry_level=4;
                        break;
                        case 'PBL 5':
                        $entry_level=5;
                        break;
                        case 'PBL 6':
                        $entry_level=6;
                        break;
                }

                /** Checking for existence */
                $sql_check = "SELECT * FROM studentbiodata where indexno = '$indexno' ";
                $rs_check = mysqli_query($conn, $sql_check);
                if($rs_check->num_rows <= 0) {
                    $sql_insert = "INSERT INTO studentbiodata (indexno, uin, surname, middlename, firstname, gender, dob, pob, htown, rob, homeaddress, fonnumber, disability_status, disability_descr, admission_category, guardian_name, guardian_address, sprogid, entryyear, entrylevel, nationality, username, wifi_password, inst_mail, `password`, pic_id, study_status, added_by) VALUES ('$indexno', '$uin', '$surname', '$middlename', '$firstname', '$gender', '$dateofbirth', '$placeofbirth', '$hometown', '$homeregion', '$homeaddress', '$contact', '$disability', '$descr_disability', '$admission_category', '$name_guardian', '$address_guardian', '$programme', '$entry_year', '$entry_level', '$nationality', '$username', '$password', '$email', '$uin', '$image_id', 'On-Going', '$user')";

                    $rs_insert = mysqli_query($conn, $sql_insert);
                if($rs_insert) {
                        $event = "Student UIN: ".$uin.". Index No. ".$indexno." inserted";
                        $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                        $rs_log = mysqli_query($conn, $log_insert);
                        if($rs_log) {
                            $inserted++;
                        } else {
                            echo $conn->error;
                        }
                    } else {
                        echo $conn->error;
                    }
                } else {
                    $date_modified = date("Y-m-d");
                    $sql_update = "UPDATE studentbiodata SET surname = '$surname', middlename = '$middlename', firstname = '$firstname', gender = '$gender', dob = '$dateofbirth', pob = '$placeofbirth', htown = '$hometown', rob = '$homeregion', homeaddress = '$homeaddress', fonnumber = '$contact', disability_status = '$disability', disability_descr = '$descr_disability', admission_category= '$admission_category', guardian_name = '$name_guardian', guardian_address = '$address_guardian', sprogid = '$programme', entryyear = '$entry_year', entrylevel = '$entry_level', nationality = '$nationality', pic_id = '$image_id', study_status = 'On-Going', date_modified = '$date_modified', modified_by = '$user' WHERE indexno = '$indexno' AND uin = '$uin' ";

                    $sql_rs = mysqli_query($conn, $sql_update);
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
           
        
           
            
        }
            echo "\n". $inserted." Students Uploaded  \n";
            echo $updated. " Students Updated \n";
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
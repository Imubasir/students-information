<?php
session_start();
require( './Db/connection.php' );

/*Wi-Fi Username generation function*/

function random_username( $sname, $fname, $suin ) {
    $fname = strtolower( str_replace( ' ', '', $fname ) );
    $sname = strtolower( substr( $sname, 0, 2 ) );
    $suin = strtolower( substr( $suin, 0, 2 ) );
    $nrRand = rand( 0, 100 );
    return $fname.$sname.$suin.$nrRand;
}

/*Wi-Fi Password generation function*/

function rand_password() {
    $strings = '0123456789';
    $pin =  substr( str_shuffle( $strings ), 0, 8 );
    return $pin;
}

function get_country( $name ) {
    require_once( './Db/connection.php' );
    $query = "SELECT country_id FROM tbl_country WHERE countrynm = '$name'";
    $rs = mysqli_query( $conn, $query );
    if ( $rs ) {
        $row = mysqli_fetch_assoc( $rs );
        return $row['country_id'];
    }
}

/*Get POST values for UIN and INDEX Number*/
$uin = mysqli_real_escape_string( $conn, trim( $_POST['uin'] ) );
$index = mysqli_real_escape_string( $conn, trim( $_POST['index'] ) );
$level = mysqli_real_escape_string( $conn, trim( $_POST['level'] ) );

/*Check for Existence in SISU*/
$check_existence = "SELECT * FROM studentbiodata WHERE (indexno = '$index' or uin = '$uin')";
$check_result = mysqli_query( $conn, $check_existence );
if ( $check_result->num_rows > 0 ) {
    $fetch = mysqli_fetch_assoc( $check_result );
    /*If biodata exists, update student CURRENT LEVEL*/
    if ( $uin == $fetch['indexno'] ) {
        /*If UIN is same as POST VALUE, update index and level*/
        $update_data = "UPDATE studentbiodata SET indexno = '$index' and currentlevel = '$level' WHERE uin = '$uin'";
        $update_result = mysqli_query( $conn, $update_data );
        if ( $update_result ) {
            echo 1;
        } else {
            echo $conn->error;
        }
    } else {
        /*If UIN is different from POST VALUE, update level*/
        $update_data = "UPDATE studentbiodata SET currentlevel = '$level' WHERE uin = '$uin'";
        $update_result = mysqli_query( $conn, $update_data );
        if ( $update_result ) {
            echo 1;
        } else {
            echo $conn->error;
        }
    }

} else {
    /*if biodata does not exist, insert student biodata*/
    $response = array();
    $cURLConnection = curl_init();

    curl_setopt( $cURLConnection, CURLOPT_URL, 'https://admissions.uds.edu.gh/api/students/biodata/'.$uin );
    curl_setopt( $cURLConnection, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $cURLConnection, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $cURLConnection, CURLOPT_HTTPHEADER, array(
        'Authorization: $2y$10$TUbbijRgmw/ZhqGHxGY7CuBamCXPB5N9gpNrqqsYv1qL0S.1cn2vG',
        'Client: sisu'
    ) );

    $studentBiodata = curl_exec( $cURLConnection );

    $response = json_decode( $studentBiodata, true );
    if ( curl_errno( $cURLConnection ) ) {
        $error_msg = curl_error( $cURLConnection );
    }
    curl_close( $cURLConnection );

    $surname = strtoupper( $response[0]['surname'] );
    $firstname = strtoupper( $response[0]['firstname'] );
    $middlename = strtoupper( $response[0]['middlename'] );
    $gender = $response[0]['gender'];
    if ( $gender == 'F' ) {
        $gender = 'FEMALE';
    } else if ( $gender == 'M' ) {
        $gender = 'MALE';
    }
    $dateofbirth = strtoupper( $response[0]['dateofbirth'] );
    $placeofbirth = strtoupper( $response[0]['placeofbirth'] );
    $nationality = get_country( strtoupper( $response[0]['nationality'] ) );
    $religion = strtoupper( $response[0]['religion'] );
    $denomination = strtoupper( $response[0]['denomination'] );
    $hometown = mysqli_real_escape_string( $conn, strtoupper( $response[0]['hometown'] ) );
    $homeregion = mysqli_real_escape_string( $conn, strtoupper( $response[0]['homeregion'] ) );

    /**  `homeaddress` **/
    $boxnumber = strtoupper( $response[0]['postal_address'] );
    $add_town = strtoupper( $response[0]['address_town'] );
    $add_region = strtoupper( $response[0]['address_region'] );
    $homeaddress = mysqli_real_escape_string( $conn, strtoupper( $boxnumber ) ).' '.mysqli_real_escape_string( $conn, strtoupper( $add_town ) ).' '.mysqli_real_escape_string( $conn, strtoupper( $add_region ) );
    /**  End homeaddress **/

    $entry_level = strtoupper( $response[0]['entry_level'] );
    $currentlevel = $level;
    /*Level from POST DATA*/
    $entry_year = strtoupper( $response[0]['entry_year'] );
    $study_duration = strtoupper( $response[0]['study_duration'] );
    $study_status = 'ON-GOING';
    $image_id = strtoupper( $response[0]['image_id'] );
    $disability = strtoupper( $response[0]['disability'] );
    $descr_disability = strtoupper( $response[0]['descr_disability'] );

    /*Guardian Info*/
    $name_guardian = strtoupper( $response[0]['name_guardian'] );
    $relation_guardian = strtoupper( $response[0]['relation_guardian'] );
    $address_guardian = mysqli_real_escape_string( $conn, strtoupper( $response[0]['address_guardian'] ) );
    $occupation_guardian = mysqli_real_escape_string( $conn, strtoupper( $response[0]['occupation_guardian'] ) );
    $guardian_contact = mysqli_real_escape_string( $conn, strtoupper( $response[0]['guardian_contact'] ) );
    /*End Guardian Info*/

    $admitted_programme = strtoupper( $response[0]['admitted_programme_id'] );
    $contact = strtoupper( $response[0]['contact'] );
    $sponsor = strtoupper( $response[0]['sponsor'] );

    $residence_status = strtoupper( $response[0]['residence_status'] );
    $qualification_status = strtoupper( $response[0]['qualification_status'] );
    $fee_category = strtoupper( $response[0]['fee_category'] );
    $application_category = strtoupper( $response[0]['application_category'] );
    $admission_category = strtoupper( $response[0]['admission_category'] );

    /*Programme Choices*/
    $first_choice = strtoupper( $response[0]['first_choice'] );
    $second_choice = strtoupper( $response[0]['second_choice'] );
    $third_choice = strtoupper( $response[0]['third_choice'] );

    $username = strtolower( random_username( $surname, $firstname, $uin ) );
    $password = rand_password();
    $email = $username.'@uds.edu.gh';
    $primary_email = strtoupper( $response[0]['email'] );
    $added_by = 'auto_update';

    switch ( $entry_level ) {
        case '100':
        $entry_level = 1;
        break;
        case '200':
        $entry_level = 2;
        break;
        case '300':
        $entry_level = 3;
        break;
        case '400':
        $entry_level = 4;
        break;
        case '500':
        $entry_level = 5;
        break;
        case '600':
        $entry_level = 6;
        break;
        case '700':
        $entry_level = 7;
        break;
        case 'PBL 1':
        $entry_level = 1;
        break;
        case 'PBL 2':
        $entry_level = 2;
        break;
        case 'PBL 3':
        $entry_level = 3;
        break;
        case 'PBL 4':
        $entry_level = 4;
        break;
        case 'PBL 5':
        $entry_level = 5;
        break;
        case 'PBL 6':
        $entry_level = 6;
        break;
    }

    switch ( $currentlevel ) {
        case '100':
        $currentlevel = 1;
        break;
        case '200':
        $currentlevel = 2;
        break;
        case '300':
        $currentlevel = 3;
        break;
        case '400':
        $currentlevel = 4;
        break;
        case '500':
        $currentlevel = 5;
        break;
        case '600':
        $currentlevel = 6;
        break;
        case '700':
        $currentlevel = 7;
        break;
        case 'PBL 1':
        $currentlevel = 1;
        break;
        case 'PBL 2':
        $currentlevel = 2;
        break;
        case 'PBL 3':
        $currentlevel = 3;
        break;
        case 'PBL 4':
        $currentlevel = 4;
        break;
        case 'PBL 5':
        $currentlevel = 5;
        break;
        case 'PBL 6':
        $currentlevel = 6;
        break;
    }

    $sql_insert = "INSERT INTO `studentbiodata` (indexno, uin, surname, middlename, firstname, gender, dob, religion, denomination,  pob, htown, rob, homeaddress, fonnumber, disability_status, disability_descr, guardian_name, relation_guardian, guardian_contact,  guardian_address, occupation_guardian, sponsor, sprogid, entryyear, entrylevel, currentlevel, nationality, username, wifi_password, inst_mail, `password`, pic_id, qualification_status, study_status, study_duration, residence_status, fee_category, first_choice, second_choice, third_choice, added_by) VALUES ('$index', '$uin', '$surname', '$middlename', '$firstname', '$gender', '$dateofbirth', '$religion', '$denomination', '$placeofbirth', '$hometown', '$homeregion', '$homeaddress', '$contact', '$disability', '$descr_disability', '$name_guardian', '$relation_guardian', '$guardian_contact', '$address_guardian', '$occupation_guardian', '$sponsor', '$admitted_programme', '$entry_year', '$entry_level', '$currentlevel', '$nationality', '$username', '$password', '$email', '$uin', '$image_id', '$qualification_status', '$study_status', '$study_duration', '$residence_status', '$fee_category', '$first_choice', '$second_choice', '$third_choice', '$added_by')";

    $sql_result = mysqli_query( $conn, $sql_insert );
    if ( $sql_result ) {
        echo 2;
    } else {
        echo $conn->error;
    }
}
?>

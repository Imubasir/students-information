<?php
$year = $_POST['year'];

$response = array();
$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, 'https://admissions.uds.edu.gh/api/students/biodata/'.$year);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false); // REMOVE THIS LINE IN PRODUCTION
                curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
                	'Authorization: $2y$10$TUbbijRgmw/ZhqGHxGY7CuBamCXPB5N9gpNrqqsYv1qL0S.1cn2vG',
                	'Client: sisu'
                ));

                $studentBiodata = curl_exec($cURLConnection);
                $response = json_decode($studentBiodata, true);
                // echo json_encode($response);
                // $surname = strtoupper($response[0]['surname']);
                // $firstname = strtoupper($response[0]['firstname']);
                // $middlename = strtoupper($response[0]['middlename']);
                // $gender = $response[0]['gender'];
                // $dateofbirth = strtoupper(date('Y-m-d', strtotime($response[0]['dateofbirth'])));
                // $placeofbirth = mysqli_real_escape_string($conn, strtoupper($response[0]['placeofbirth']));
                // $nationality = mysqli_real_escape_string($conn, strtoupper($response[0]['nationality']));
                // $hometown = mysqli_real_escape_string($conn, strtoupper($response[0]['hometown']));
                // $homeregion = mysqli_real_escape_string($conn, strtoupper($response[0]['homeregion']));
                // /**  `homeaddress` **/
                // $boxnumber = mysqli_real_escape_string($conn, strtoupper($response[0]['postal_address']));
                // $add_town = mysqli_real_escape_string($conn, strtoupper($response[0]['address_town']));
                // $add_region = mysqli_real_escape_string($conn, strtoupper($response[0]['address_region']));
                // $homeaddress = mysqli_real_escape_string($conn, strtoupper($boxnumber))." ".mysqli_real_escape_string($conn, strtoupper($add_town))." ".mysqli_real_escape_string($conn, strtoupper($add_region));
                // /**  `************` **/
                // $entry_level = strtoupper($response[0]['entry_level']);
                // $entry_year = strtoupper($response[0]['entry_year']);
                // $study_duration = strtoupper($response[0]['study_duration']);
                // $disability = strtoupper($response[0]['disability']);
                // $descr_disability = strtoupper($response[0]['descr_disability']);
                // $name_guardian = mysqli_real_escape_string($conn, strtoupper($response[0]['name_guardian']));
                // $address_guardian = mysqli_real_escape_string($conn, strtoupper($response[0]['address_guardian']));
                // $admitted_programme = strtoupper($response[0]['admitted_programme_id']);
                // $admission_category = strtoupper($response[0]['admission_category']);
                // $contact = strtoupper($response[0]['contact']);
                // $guardian_contact=strtoupper(mysqli_real_escape_string($conn, $response[0]['guardian_contact']));
                // $fchoice=strtoupper(mysqli_real_escape_string($conn, $response[0]['fchoice']));
                // $schoice=strtoupper(mysqli_real_escape_string($conn, $response[0]['schoice']));
                // $tchoice=strtoupper(mysqli_real_escape_string($conn, $response[0]['tchoice']));
                // $qualification_status=strtoupper($response[0]['qualification_status']);
                // $fee_category=strtoupper($response[0]['fee_category']);
            ?>
<?php
// $data_out = array();

// $data = array(
//   'Faculty'    => '18009183',
//   'UserID'      => 'ICTD',
//   'UserPassword'      => 'bash@5910',
// );
// $url = "http://www.udsmis.com/uds/api/transcript/studentresults";

// $options = array(
//   'http' => array(
//     'method'  => 'POST',
//     'content' => json_encode( $data ),
//     'header'=>  "Content-Type: application/json\r\n" .
//                 "Accept: application/json\r\n"
//     )
// );

// $context  = stream_context_create( $options );
// $result = file_get_contents( $url, false, $context );
// $result = file_get_contents( $url);
// $response = json_decode( $result );
// $array_keys = array_keys($response);

//     foreach($array_keys as $key) {

//         $indexno = $response[$key]['Studentid'];
//         $acad_yr = $response[$key]['AcademicYear'];
//         $studylevel = $response[$key]['Studylevel'];
//         $trimester = $response[$key]['Trimester'];
//         $coursecode = $response[$key]['Coursecode'];
//         $coursetitle = $response[$key]['CourseTitle'];
//         $credithour = $response[$key]['CreditHour'];
//         $totalmark = $response[$key]['TotalMark'];
//         $grade = $response[$key]['Grade'];

//         // $sql_insert = "INSERT INTO tbl_conass(indexno, levelid, trimester, session, coursecode1, credits, mark, grade, w, gp, course_title, date_modified, modified_by) VALUES ('$')";

//         $data_out[] = $response[$key];
//     }

//     echo json_encode($data_out);


//API Url

$url = 'https://www.udsmis.com/uds/api/transcript/studentresults';

//Initiate cURL.

$ch = curl_init($url);

//The JSON data.

$jsonData = array(

       'IndexNumber' => 'FAS/4387/12',

    'UserID' => 'ICTD',

    'UserPassword' => 'bash@5910'

);

//Encode the array into JSON.

$jsonDataEncoded = json_encode($jsonData);

 //Tell cURL that we want to send a POST request.

curl_setopt($ch, CURLOPT_POST, 1);

 

//Attach our encoded JSON string to the POST fields.

curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

 

//Set the content type to application/json

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

 

//Execute the request

$result = curl_exec($ch);

print_r($result);


    ?>
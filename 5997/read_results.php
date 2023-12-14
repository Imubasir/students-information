<?php
session_start();
require("../Db/connection2.php");
// $id = 'FMS/1936/14';
$id = $_POST['Faculty'];
$userId = "ICTD";
$password = "bash@5910";

$today = date("Y-m-d H:i:s");
$user = $_SESSION['uname'];
$ncount = 0;

//-------------------------------------Results Update--------------------------------------
try{
    //API URL
    $url = 'https://udsmis.com/uds/api/transcript/studentresults';

    $ch = curl_init($url); //initiate curl request

    //request json object NOT ARRAY
    $data = array(
        'IndexNumber' => $id,
        'UserID' => $userId,
        'UserPassword' => $password
    );
    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_POST, 1); // request method POST
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); // attach json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); // set encoding
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); // ignore SSL. their SSL certificate cannot be verified
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //return response instead of outputting
    
    $result = curl_exec($ch); //execute the POST request
    $result = trim(stripslashes($result), '"');

    // print_r($result);
    $json = json_decode($result, true);

    for ($i = 0; $i < sizeof($json); $i++){
        // foreach ($json[$i] as $key => $value) {
        //     echo $key . ' => ' . $value. '<br>';
        // }
        $studentid =  $json[$i]['Studentid'];
        $academicyear =  $json[$i]['AcademicYear'];
        $studylevel =  $json[$i]['StudyLevel'];
        switch ($studylevel) {
            case '1ST YEAR':
                $level = '1';
                break;
            case '2ND YEAR':
                $level = '2';
                break;
            case '3RD YEAR':
                $level = '3';
                break;
            default:
                $level = '';
                break;
        }
        $trimester =  $json[$i]['Trimester'];
        switch ($trimester) {
            case 'FIRST':
                $trim = '1';
                break;
            case 'SECOND':
                $trim = '2';
                break;
            case 'THIRD':
                $trim = '3';
                break;
            
            default:
                $level = '';
                break;
        }
        $coursecode =  $json[$i]['Coursecode'];
        $coursetitle =  $json[$i]['CourseTitle'];
        $credits =  $json[$i]['CreditHour'];
        $totalmark =  $json[$i]['TotalMark'];
        $grade =  $json[$i]['Grade'];

        if($studentid == '' && $academicyear == '' && $studylevel == '') {
            echo "Empty Results \n";
        } else {

        $sql = "DELETE FROM conass WHERE indexno = '$studentid' and session = '$academicyear' and levelid = '$level' and trimester = '$trim' and coursecode1 = '$coursecode' ";
        $rs = mysqli_query($conn2, $sql);
        
            $sql_insert = "INSERT INTO conass(indexno, levelid, trimester, session, coursecode1, credits, mark, course_title, grade, added_by) VALUES ('$studentid', '$level', '$trim', '$academicyear', '$coursecode', '$credits', '$totalmark', '$coursetitle', '$grade', '$user')";
            $rs_insert = mysqli_query($conn2, $sql_insert);
            if($rs_insert) {
            } else {
                echo $conn2->error;
            }
                $ncount++;
    }
    }
    echo $ncount." Results Updated";

    // if request fails
    if ($result === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

    // echo curl_errno($ch);
    echo curl_error($ch);
    curl_close($ch); // close conn2ection
} catch (Exception $e) {
    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

}


//-------------------------------TWA/CGPA Update------------------------------------------
// try{
//     //API URL
//     $url = 'https://udsmis.com/uds/api/transcript/studentcgpa';

//     $ch = curl_init($url); //initiate curl request

//     //request json object NOT ARRAY
//     $data = array(
//         'IndexNumber' => $id,
//         'UserID' => $userId,
//         'UserPassword' => $password
//     );
//     $payload = json_encode($data);

//     curl_setopt($ch, CURLOPT_POST, 1); // request method POST
//     curl_setopt($ch, CURLINFO_HEADER_OUT, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); // attach json
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); // set encoding
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); // ignore SSL. their SSL certificate cannot be verified
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //return response instead of outputting
    
//     $result = curl_exec($ch); //execute the POST request
//     $result = trim(stripslashes($result), '"');

//     // print_r($result);
//     $json = json_decode($result, true);
    

//     for ($i = 0; $i < sizeof($json); $i++){
//         // foreach ($json[$i] as $key => $value) {
//         //     echo $key . ' => ' . $value. '<br>';
//         // }
        
//         $studentid =  $json[$i]['Studentid'];
//         $academicyear =  $json[$i]['AcademicYear'];
//         $trimester =  $json[$i]['Trimester'];
//         switch ($trimester) {
//             case 'FIRST':
//                 $trimid = '1';
//                 break;
//             case 'SECOND':
//                 $trimid = '2';
//                 break;
//             case 'THIRD':
//                 $trimid = '3';
//                 break;
//             default:
//                 $trimid = '';
//                 break;
//         }
//         $studylevel =  $json[$i]['StudyLevel'];
//         switch ($studylevel) {
//             case 'FIRST':
//                 $level = '1';
//                 break;
//             case 'SECOND':
//                 $level = '2';
//                 break;
//             case 'THIRD':
//                 $level = '3';
//                 break;
//             case 'FOURTH':
//                 $level = '4';
//                 break;
//             case 'FIFTH':
//                 $level = '5';
//                 break;
//             case 'SIXTH':
//                 $level = '6';
//                 break;
            
//             default:
//                 $level = '';
//                 break;
//         }
//         $currentcredit =  $json[$i]['CurrentCredit'];
//         $currenttgp =  $json[$i]['CurrentTGP'];
//         $currentgpa =  $json[$i]['CurrentGPA'];
//         $cumulativecredit =  $json[$i]['CumulativeCredit'];
//         $cumulativetgp =  $json[$i]['CumulativeTGP'];
//         $cumulativegpa =  $json[$i]['CumulativeGPA'];
//         $classdegree =  $json[$i]['ClassDegree'];

//         $sql = "DELETE FROM tbl_cwa_gpa WHERE indexnum = '$studentid' and levelid = '$level' and trimid = '$trimid'";
//         $rs = mysqli_query($conn2, $sql);
        
//             $sql_insert = "INSERT INTO tbl_cwa_gpa(indexnum, levelid, trimid, cwa, present, added_by) VALUES ('$studentid', '$level', '$trimid', '$cumulativegpa', '$currentgpa', '$user')";
//             $rs_insert = mysqli_query($conn2, $sql_insert);
//             if($rs_insert) {
//             } else {
//                 echo $conn2->error;
//             }
//     }
//                 echo "Averages Updated";
    

//     // if request fails
//     if ($result === false) {
//             throw new Exception(curl_error($ch), curl_errno($ch));
//         }

//     // echo curl_errno($ch);
//     echo curl_error($ch);
//     curl_close($ch); // close conn2ection
// } catch (Exception $e) {
//     trigger_error(sprintf(
//         'Curl failed with error #%d: %s',
//         $e->getCode(), $e->getMessage()),
//         E_USER_ERROR);

// }
?>

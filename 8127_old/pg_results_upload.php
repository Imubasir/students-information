<?php
session_start();
require_once("../Db/connection2.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");

$user = $_SESSION['uname'];
$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['ug_averages_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['ug_averages_file']['name'];
    if(move_uploaded_file($_FILES['ug_averages_file']['tmp_name'], $targetPath)) {

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

                $indexno = $Row[0];
                $levelid = $Row[1];
                $trimid = $Row[2];
                $session = $Row[3];
                $coursecode = $Row[4];
                $grade = $Row[5];
                $credits = $Row[6];
                $title = $Row[7];
                $mark = $Row[8];

                if($indexno == '') {
                    echo "Index No. Not Found \n";
                } else {

                    if ($rscourse->num_rows<=0) {
                        $updatecourse="INSERT INTO course(coursecode, added_by) VALUES ('$coursecode', '$user')";
                        $rep=mysqli_query($conn22, $updatecourse);
                    }
                    
                    $sql_check = "SELECT * FROM conass WHERE indexno = '$indexno' AND session = '$session' AND coursecode1 = '$coursecode' ";
                    $rs_check = mysqli_query($conn2, $sql_check);
                    if($rs_check->num_rows <= 0) {


                        $sql_insert = "INSERT INTO conass (indexno, levelid, trimester, session, coursecode1, credits, mark, grade, course_title, added_by) VALUES ('$indexno', '$levelid', '$trimid', '$session', '$coursecode', '$credits', '$mark', '$grade', '$title', '$user')";

                        $rs_insert = mysqli_query($conn2, $sql_insert);
                        if($rs_insert) {

                        } else {
                            echo $conn2->error;
                        }
                    } else {

                    }
                /** Checking for Existence **/
                
                }
            }
            echo "\n".$inserted." Records Inserted  \n";
            echo $updated. " Records Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
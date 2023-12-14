<?php
session_start();
require_once("../Db/connection2.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");

$user = strtoupper($_SESSION['uname']);
$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['pg_results_upload']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['pg_results_upload']['name'];
    if(move_uploaded_file($_FILES['pg_results_upload']['tmp_name'], $targetPath)) {

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

                $indexno = strtoupper($Row[0]);
                $levelid = strtoupper($Row[1]);
                $trimid = strtoupper($Row[2]);
                $session = strtoupper($Row[3]);
                $coursecode = strtoupper($Row[4]);
                $grade = strtoupper($Row[5]);
                $credits = strtoupper($Row[6]);
                $title = strtoupper($Row[7]);
                $mark = strtoupper($Row[8]);

                if($indexno == '') {
                    continue;
                } else {
                	$sql_check = "SELECT * FROM conass WHERE indexno = '$indexno' AND session = '$session' AND coursecode1 = '$coursecode' ";
                    $rs_check = mysqli_query($conn2, $sql_check);
                    // $rs_chk = mysqli_fetch_assoc($rs_check);
                    // $up_trim = $rs_chk['trimester'];
                    if ($rs_check->num_rows < 1) {

                        
                        $sql_course="SELECT * from course where coursecode='$coursecode'";
                        $rscourse=mysqli_query($conn2, $sql_course);
                        
                        if ($rscourse->num_rows < 1) {
							$updatecourse="INSERT INTO course(coursecode, coursetitle, credit, added_by) VALUES ('$coursecode', '$title', '$credits', '$user')";
							$rep=mysqli_query($conn2, $updatecourse);
						}

                            $sql_insert = "INSERT INTO conass (indexno, levelid, trimester, session, coursecode1, credits, mark, grade, course_title, added_by ) VALUES ('$indexno', '$levelid', '$trimid', '$session', '$coursecode', '$credits', '$mark', '$grade', '$title', '$user')";

                            $rs_insert = mysqli_query($conn2, $sql_insert);
                            if($rs_insert) {
                                $inserted++;
                            } else {
                                echo $conn2->error;
                            }
                        
                    } else {
                        $sql_insert = "UPDATE conass SET coursecode1 = '$coursecode', trimester = '$trimid', credits = '$credits', mark = '$mark', grade= '$grade', course_title = '$title', added_by = '$user' WHERE indexno = '$indexno' and levelid = '$levelid' and trimester = '$trimid' and session = '$session' ";

                            $rs_update = mysqli_query($conn2, $sql_insert);
                            if($rs_update) {
                                $updated++;
                            } else {
                                echo $conn2->error;
                            }
                    }


            }
        }
            echo "\n".$inserted." Records Inserted  \n";
            echo $updated. " Records Updated \n";
    }
    
} else {
    echo "Wrong File Format \n";
}
}
?>
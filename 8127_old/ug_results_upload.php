<?php
session_start();
require_once("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");
set_time_limit(0);
$user = $_SESSION['uname'];
$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    // echo $_FILES['ug_results_file']['type'];
    // echo "Reading";
if(in_array($_FILES['ug_results_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['ug_results_file']['name'];
    if(move_uploaded_file($_FILES['ug_results_file']['tmp_name'], $targetPath)) {

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
        $data = array();
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
                    if ($grade=="A+"){
                            $gp=5*($credits);
                        }elseif ($grade=="A") {
                            $gp=4.5*($credits);
                        }elseif ($grade=="B+"){
                            $gp=4*($credits);
                        }elseif ($grade=="B"){
                            $gp=3.5*($credits);
                        }elseif ($grade=="C+"){
                            $gp=3*($credits);
                        }elseif ($grade=="C"){
                            $gp=2.5*($credits);
                        }elseif ($grade=="D+"){
                            $gp=2*($credits);
                        }elseif ($grade=="D"){
                            $gp=1.5*($credits);
                        }else {
                            $gp=0*($credits);
                        }
                        
                        $w=($credits)*($mark);

                    $sql_check = "SELECT * FROM conass WHERE indexno = '$indexno' AND session = '$session' AND coursecode1 = '$coursecode' ";
                    $rs_check = mysqli_query($conn, $sql_check);
                    if($rs_check->num_rows <= 0) {

                        
                        $sql_course="select * from course where coursecode='$coursecode'";
                        $rscourse=mysqli_query($conn, $sql_course);
                        
                        if ($rscourse->num_rows<=0) {
							$updatecourse="INSERT INTO course(coursecode, coursetitle, credit, added_by) VALUES ('$coursecode', '$title', '$credits', '$user')";
							$rep=mysqli_query($conn, $updatecourse);
						}

                            $sql_insert = "INSERT INTO conass (indexno, levelid, trimester, session, coursecode1, credits, mark, grade, w, gp, course_title, added_by ) VALUES ('$indexno', '$levelid', '$trimid', '$session', '$coursecode', '$credits', '$mark', '$grade', '$w', '$gp', '$title', '$user')";

                            $rs_insert = mysqli_query($conn, $sql_insert);
                            if($rs_insert) {
                                $inserted++;
                            } else {
                                echo $conn->error;
                            }
                        
                    } else {
                        $sql_insert = "UPDATE conass SET coursecode1 = '$coursecode', credits = '$credits', mark = '$mark', grade= '$grade', w = '$w', gp = '$gp', course_title = '$title', added_by = '$user' WHERE indexno = '$indexno' and levelid = '$levelid' and trimester = '$trimid' and session = '$session' ";

                            $rs_update = mysqli_query($conn, $sql_insert);
                            if($rs_update) {
                                $updated++;
                            } else {
                                echo $conn->error;
                            }
                    }
                /** Checking for Existence **/
               
                
                }
            }
            echo "\n".$inserted." Results Uploaded  \n";
            echo $updated." Results Updated  \n";
            // echo $updated. " Records Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
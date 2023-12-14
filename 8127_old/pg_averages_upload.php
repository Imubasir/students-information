<?php
session_start();
require_once("../Db/connection2.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");

$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['pg_averages_upload']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['pg_averages_upload']['name'];
    if(move_uploaded_file($_FILES['pg_averages_upload']['tmp_name'], $targetPath)) {

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
                if($indexno == '') {
                    echo "Index No. Not Found \n";
                } else {
                    $levelid = $Row[1];
                    $trimid = $Row[2];
                    $present = $Row[3];
                    $cwa = $Row[4];

                /** Checking for Existence **/
                $sql_check = "SELECT * FROM tbl_cwa_gpa where indexnum = '$indexno' AND levelid = '$levelid' and trimid = '$trimid' ";
                $rs_check = mysqli_query($conn, $sql_check);
                
                if($rs_check->num_rows <= 0) {
                    $sql_insert = "INSERT INTO tbl_cwa_gpa (indexnum, levelid, trimid, cwa, present) VALUES ('$indexno', '$levelid', '$trimid', '$cwa', '$present')";

                    $rs_insert = mysqli_query($conn, $sql_insert);
                    if($rs_insert) {
                        
                        $event = "Index No. ".$indexno.": Inserted Averages";
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
                    $sql_insert = "UPDATE tbl_cwa_gpa SET levelid = '$levelid', trimid = '$trimid', cwa = '$cwa', present = '$present' where indexnum = '$indexno' and levelid = '$levelid' and trimid = '$trimid'";

                    $rs_insert = mysqli_query($conn, $sql_insert);
                    if($rs_insert) {
                        $event = "Index No. ".$indexno.": Updated into Averages";
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
                }
            }
            }
            echo $inserted."\n Postgraduate Averages Uploaded  \n";
            echo $updated. " Postgraduate Graduands Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
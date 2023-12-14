<?php
session_start();
require_once("../Db/connection2.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");

$inserted = 0;
$updated = 0;

$user = strtoupper($_SESSION['uname']);
$access = strtoupper($_SESSION['access']);

$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['pg_graduands_upload']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['pg_graduands_upload']['name'];
    if(move_uploaded_file($_FILES['pg_graduands_upload']['tmp_name'], $targetPath)) {

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
                    echo "Index Number Not Found \n";
                } else {
                    $gradclass = strtoupper($Row[1]);
                    $graddate = strtoupper($Row[2]);
                    $facname = strtoupper($Row[3]);
                    $certno = strtoupper($Row[4]);

                /** Checking for Existence */
                $sql_check = "SELECT * FROM tbl_graduate where indexno = '$indexno' ";
                $rs_check = mysqli_query($conn2, $sql_check);
                if($rs_check->num_rows <= 0) {
                    $sql_insert = "INSERT INTO tbl_graduate (indexno, gradclass, graddate, facname, certno) VALUES ('$indexno', '$gradclass', '$graddate', '$facname', '$certno')";

                    $rs_insert = mysqli_query($conn2, $sql_insert);
                    if($rs_insert) {

                        $sql_ = "UPDATE studentbiodata SET study_status = 'GRADUATED' WHERE indexno = '$indexno' ";
                        $rs = mysqli_query($conn2, $sql_);
                        if($rs) {
                            $event = "Index No. ".$indexno.": Inserted for PG Graduation \n Graduation Date: ".$graddate;
                            $inserted++;
                        // $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                        // $rs_log = mysqli_query($conn2, $log_insert);
                        // if($rs_log) {
                        // } else {
                        //     echo $conn2->error;
                        // }
                        }
                        
                    } else {
                        echo $conn2->error;
                    }
                } else {
                    $date_modified = date("Y-m-d");
                    $sql_update = "UPDATE tbl_graduate SET gradclass = '$gradclass', graddate = '$graddate',facname = '$facname', certno= '$certno' WHERE indexno = '$indexno' ";

                    $sql_rs = mysqli_query($conn2, $sql_update);
                    if($sql_rs) {
                        $event = "Index No. ".$indexno.": Updated for PG Graduation \n Graduation Date: ".$graddate;
                        $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                            $updated++;
                        // $rs_log = mysqli_query($conn2, $log_insert);
                        // if($rs_log) {
                        // } else {
                        //     echo $conn2->error;
                        // }
                    } else {
                        echo $conn2->error;
                    }
                }
            }
            }
            echo "\n".$inserted." Postgraduate Graduands Uploaded  \n";
            echo $updated. "Postgraduate Graduands Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
<?php
require_once("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");
session_start();
$user = strtoupper($_SESSION['uname']);
$access = $_SESSION['access'];
set_time_limit(0);

$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['ug_graduands_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['ug_graduands_file']['name'];
    if(move_uploaded_file($_FILES['ug_graduands_file']['tmp_name'], $targetPath)) {

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
                    $graddate = strtoupper(date('M d, Y', strtotime($Row[2])));
                    $facname = strtoupper($Row[3]);
                    $certno = $Row[4];

                /** Checking for Existence */
                $sql_check = "SELECT * FROM tbl_graduate where indexno = '$indexno' ";
                $rs_check = mysqli_query($conn, $sql_check);
                if($rs_check->num_rows <= 0) {
                    $sql_insert = "INSERT INTO tbl_graduate (indexno, gradclass, graddate, facname, certno) VALUES ('$indexno', '$gradclass', '$graddate', '$facname', '$certno')";

                    $rs_insert = mysqli_query($conn, $sql_insert);
                    if($rs_insert) {
                        $sql_ = "UPDATE studentbiodata SET study_status = 'GRADUATED' WHERE indexno = '$indexno' ";
                    $rs = mysqli_query($conn, $sql_);
                    if($rs) {
                        $event = "Index No. ".$indexno.": Inserted for Graduation \n Graduation Date: ".$graddate;
                        $log_insert = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$event', '$user', '$access')";
                        $rs_log = mysqli_query($conn, $log_insert);
                        if($rs_log) {
                            $inserted++;
                        } else {
                            echo $conn->error;
                        }
                    }

                        
                    } else {
                        echo $conn->error;
                    }
                } else {
                    $date_modified = date("Y-m-d");
                    $sql_update = "UPDATE tbl_graduate SET gradclass = '$gradclass', graddate = '$graddate',facname = '$facname', certno='$certno' WHERE indexno = '$indexno' ";

                    $sql_rs = mysqli_query($conn, $sql_update);
                    if($sql_rs) {
                        $event = "Index No. ".$indexno.": Updated for Graduation \n Graduation Date: ".$graddate;
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
            echo "\n".$inserted." Graduands Uploaded  \n";
            echo $updated. " Graduands Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
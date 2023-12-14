<?php
session_start();
set_time_limit(0);
require_once("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");
set_time_limit(0);
$inserted = 0;
$updated = 0;
$access = $_SESSION['dept'];
$user = strtoupper($_SESSION['uname']);
$today = date("Y-m-d H:i:s");
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['ug_options_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['ug_options_file']['name'];
    if(move_uploaded_file($_FILES['ug_options_file']['tmp_name'], $targetPath)) {

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
                $option_title = strtoupper($Row[1]);
                if($indexno == '') {
                    echo "UIN Not Found \n";
                } else {

                /** Checking for Existence */
                $sql_check = "SELECT * FROM tbl_option where option_title = '$option_title' ";
                $rs_check = mysqli_query($conn, $sql_check);
                if($rs_check->num_rows <= 1) {
                    $sql_insert = "INSERT INTO tbl_option (option_title, added_by) VALUES ('$option_title', '$user')";

                    $rs_insert = mysqli_query($conn, $sql_insert);
                    if($rs_insert) {
                        $bio_update = "SELECT * FROM tbl_option where option_title = '$option_title'";
                        $bio_rs = mysqli_query($conn, $bio_update);
                        
                        if($bio_rs) {
                            while($bio_row = mysqli_fetch_assoc($bio_rs)) {
                                $bio_option = $bio_row['optionid'];

                                $sql_bio_update = mysqli_query($conn, "UPDATE studentbiodata SET option_id = '$bio_option' where indexno = '$indexno' ");
                                
                                if($sql_bio_update) {
                                    $event = "Index No. ".$indexno.": Inserted for Option";
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
                        } else {
                            echo $conn->error;
                        }
                       
                    } else {
                        echo $conn->error;
                    }
                } else {
                    $bio_update = "SELECT * FROM tbl_option where option_title = '$option_title'";
                        $bio_rs = mysqli_query($conn, $bio_update);
                        
                        if($bio_rs) {
                            while($bio_row = mysqli_fetch_assoc($bio_rs)) {
                                $bio_option = $bio_row['optionid'];

                                $sql_bio_update = mysqli_query($conn, "UPDATE studentbiodata SET option_id = '$bio_option' where indexno = '$indexno' ");
                                
                                if($sql_bio_update) {
                                    $event = "Index No. ".$indexno.": Inserted for Option";
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
                        } else {
                            echo $conn->error;
                        }
                }
            }
            }
            echo $updated. " Options Updated \n";
        }
    }
} else {
    echo "Wrong File Format \n";
}

?>
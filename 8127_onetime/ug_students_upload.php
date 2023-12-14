<?php
session_start();
set_time_limit(0);
require_once("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");

function random_username($sname,$fname,$suin){
    $fname=strtolower(str_replace(' ','',$fname));
    $sname=strtolower(substr($sname,0,2));
    $suin=strtolower(substr($suin,0,2));
    $nrRand=rand(0,100);
    return $fname.$sname.$suin.$nrRand;
}

function rand_password() {
    $strings = "0123456789";
        $pin =  substr(str_shuffle($strings), 0, 8);
        return $pin;
}

$programme = $_POST['ug_program_file'];
$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES['ug_students_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['ug_students_file']['name'];
    if(move_uploaded_file($_FILES['ug_students_file']['tmp_name'], $targetPath)) {

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());

        $counter = 0;
        for($i=0;$i<$sheetCount;$i++){ 

            $Reader->ChangeSheet($i);
            // if($counter > 0) {
            foreach ($Reader as $Row){
                if($counter == 0){
                    $counter++;
                    continue;
                };
                $uin = $Row[0];
                $indexno = $Row[1];
                $firstname = $Row[2];
                $middlename = $Row[3];
                $surname = $Row[4];

                $sql_check = "SELECT * FROM studentbiodata where indexno = '$indexno' ";
                $rs_check = mysqli_query($conn, $sql_check);
                if($rs_check->num_rows <= 0) {

                $sql_insert = "INSERT INTO studentbiodata (indexno, uin, surname, middlename, firstname) VALUES ('$indexno', '$uin', '$surname', '$middlename', '$firstname')";
                $rs_insert = mysqli_query($conn, $sql_insert);
                if($rs_insert) {
                	$inserted++;
                } else {
                	echo $conn->error;
                }
               } else {
               	$sql_insert = "UPDATE studentbiodata SET indexno = '$indexno', uin = '$uin', surname = '$surname', middlename = '$middlename', firstname = '$firstname' WHERE indexno = '$indexno'";
               	$rs_insert = mysqli_query($conn, $sql_insert);
               	if($rs_insert) {
               		$updated++;
               	}  else {
                	echo $conn->error;
                }
                }
                
                }
            }
            echo "Inserted: ".$inserted.'\n'.'Updated: '.$updated;
            }    
        }
?>
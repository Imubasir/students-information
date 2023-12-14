<?php
session_start();
require("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");
require_once("verify_function.php");
set_time_limit(0);
$username = $_SESSION['uname'];
$today = date("Y-m-d H:i:s");
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/octet-stream'];
// echo "file name: ".$_FILES['file']['type'];

if(in_array($_FILES['file']['type'], $allowedFileType)) {
    $targetPath = '../../../../../../uploads/'.$_FILES['file']['name'];
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
        // $data = array();
        $counter = 1;
        for($i=0; $i<$sheetCount; $i++){

            $Reader->ChangeSheet($i);
            
            foreach($Reader as $Row){
                if($counter>1){

                $uin=str_replace("'","",strtoupper($Row[0]));
                $indexno=str_replace("'","",strtoupper($Row[1]));
                $month=strtoupper($Row[2]);
                $year=strtoupper($Row[3]);
                $dob=strtoupper($Row[4]);
                $cname=strtoupper(mysqli_real_escape_string($conn, $Row[5]));

                if(strpos($Row[7],'|')!==false || strpos($Row[9],'|')!==false || strpos($Row[11],'|')!==false || strpos($Row[13],'|')!==false){
                    $sub1=strtoupper($Row[10]);
                    $gd1=str_replace("|","",strtoupper($Row[11]));
                    $sub2=strtoupper($Row[12]);
                    $gd2=str_replace("|","",strtoupper($Row[13]));
                    $sub3=strtoupper($Row[6]);
                    $gd3=str_replace("|","",strtoupper($Row[7]));
                    $sub4=strtoupper($Row[8]);
                    $gd4=str_replace("|","",strtoupper($Row[9]));

                }else{
                    $sub1=strtoupper($Row[6]);
                    $gd1=str_replace("|","",strtoupper($Row[7]));
                    $sub2=strtoupper($Row[8]);
                    $gd2=str_replace("|","",strtoupper($Row[9]));
                    $sub3=strtoupper($Row[10]);
                    $gd3=str_replace("|","",strtoupper($Row[11]));
                    $sub4=strtoupper($Row[12]);
                    $gd4=str_replace("|","",strtoupper($Row[13]));
                }

                $sub7=strtoupper($Row[18]);
                $gd7=str_replace("|","",strtoupper($Row[19]));
                $sub8=strtoupper($Row[20]);
                $gd8=str_replace("|","",strtoupper($Row[21]));
                $sub9=strtoupper($Row[22]);
                $gd9=str_replace("|","",strtoupper($Row[23]));
                $sub10=strtoupper($Row[24]);
                $gd10=str_replace("|","",strtoupper($Row[25]));
				
				switch($sub7){
					case 'BUSINESS MATH & PRIN':
						$sub7='PRIN OF COST ACOUNTING';
						break;
					case 'LIT-IN-ENGLISH':
						$sub7='LITERATURE-IN-ENGLISH';
						break;
					case 'LIT. IN ENGLISH':
						$sub7='LITERATURE-IN-ENGLISH';
						break;
					case 'MGT. IN LIVING':
						$sub7='MANAGEMENT-IN-LIVING';
						break;
					case 'MGT IN LIVING':
						$sub7='MANAGEMENT-IN-LIVING';
						break;
					case 'GEN KNOW IN ART':
						$sub7='GENERAL KNOWLEDGE IN ART';
						break;
				}
				
				switch($sub8){
					case 'BUSINESS MATH & PRIN':
						$sub8='PRIN OF COST ACOUNTING';
						break;
					case 'LIT-IN-ENGLISH':
						$sub8='LITERATURE-IN-ENGLISH';
						break;
					case 'LIT. IN ENGLISH':
						$sub8='LITERATURE-IN-ENGLISH';
						break;
					case 'MGT. IN LIVING':
						$sub8='MANAGEMENT-IN-LIVING';
						break;
					case 'MGT IN LIVING':
						$sub8='MANAGEMENT-IN-LIVING';
						break;
					case 'GEN KNOW IN ART':
						$sub8='GENERAL KNOWLEDGE IN ART';
						break;
				}
				
				switch($sub9){
					case 'BUSINESS MATH & PRIN':
						$sub9='PRIN OF COST ACOUNTING';
						break;
					case 'LIT-IN-ENGLISH':
						$sub9='LITERATURE-IN-ENGLISH';
						break;
					case 'LIT. IN ENGLISH':
						$sub9='LITERATURE-IN-ENGLISH';
						break;
					case 'MGT. IN LIVING':
						$sub9='MANAGEMENT-IN-LIVING';
						break;
					case 'MGT IN LIVING':
						$sub9='MANAGEMENT-IN-LIVING';
						break;
					case 'GEN KNOW IN ART':
						$sub9='GENERAL KNOWLEDGE IN ART';
						break;
				}
				
				switch($sub10){
					case 'BUSINESS MATH & PRIN':
						$sub10='PRIN OF COST ACOUNTING';
						break;
					case 'LIT-IN-ENGLISH':
						$sub10='LITERATURE-IN-ENGLISH';
						break;
					case 'LIT. IN ENGLISH':
						$sub10='LITERATURE-IN-ENGLISH';
						break;
					case 'MGT. IN LIVING':
						$sub10='MANAGEMENT-IN-LIVING';
						break;
					case 'MGT IN LIVING':
						$sub10='MANAGEMENT-IN-LIVING';
						break;
					case 'GEN KNOW IN ART':
						$sub10='GENERAL KNOWLEDGE IN ART';
						break;
				}
                
                $sub5 = strtoupper($Row[14]);
                $gd5 = str_replace("|","",strtoupper($Row[15]));
                $sub6 = strtoupper($Row[16]);
                $gd6 = str_replace("|","",strtoupper($Row[17]));

                if($sub5 == 'LEAVE EMPTY') {
                    $sub5 = '';
                }
                if($gd5 == 'LEAVE EMPTY') {
                    $gd5 = '';
                }
                if($sub6 == 'LEAVE EMPTY') {
                    $sub6 = '';
                }
                if($gd6 == 'LEAVE EMPTY') {
                    $gd6 = '';
                }


                if($uin == '') {
                    echo "UIN Not Found";
                }
                 else if($sub5 != '' || $gd5 != '' || $sub6 != '' || $gd6 != '') {
                    // echo ;
                    EXIT("Invalid File Format");
                } else {
                    $sqlcheck="DELETE from tbl_verified where indexno='$indexno' and uin='$uin'";
                    $checkresult=mysqli_query($conn, $sqlcheck);
                    
                    $sql_insert = "INSERT INTO tbl_verified (uin,indexno,exam_month,exam_year,dob,cand_name, subject1,grade1,subject2,grade2,subject3,grade3, subject4,grade4,subject7,grade7,subject8,grade8,subject9,grade9,subject10,grade10, added_by, date_added) VALUES ('$uin','$indexno','$month','$year','$dob','$cname','$sub1','$gd1','$sub2','$gd2','$sub3','$gd3','$sub4','$gd4','$sub7','$gd7','$sub8','$gd8','$sub9','$gd9','$sub10','$gd10', '$username', '$today')";

                        $rs_insert = mysqli_query($conn, $sql_insert);
                        if($rs_insert) {
                            $studentData[]=$uin;
                        } else {
                            echo $conn->error;
                        }
                    
                } 
            }
            $counter++;
                
            }
        
        
            $remark=Functions::resultVerification(array_unique($studentData),$username);
			echo "File uploaded successfully";

        }
    }else {
        echo "File Not Moved";
    }
    
} else {
    echo "Wrong File Format";
}

?>
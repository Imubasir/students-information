<?php
session_start();
require_once("../Db/connection.php");
require_once("../vendor/spreadsheet-reader-master/php-excel-reader/excel_reader2.php");
require_once("../vendor/spreadsheet-reader-master/SpreadsheetReader.php");
require_once("verify_function.php");

set_time_limit(0);

$inserted = 0;
$updated = 0;
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
echo "file name: ".$_FILES['results_file']['type'];
if(in_array($_FILES['results_file']['type'], $allowedFileType)) {
    $targetPath = '../uploads/'.$_FILES['results_file']['name'];
    if(move_uploaded_file($_FILES['results_file']['tmp_name'], $targetPath)) {

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
        $data = array();
        $counter = 0;
        for($i=0;$i<$sheetCount;$i++){
            if($counter == 0){
                $counter++;
                continue;
            };
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row){
                /*
                $indexno = $Row[0];
                $levelid = $Row[1];
                $trimid = $Row[2];
                $session = $Row[3];
                $coursecode = $Row[4];
                $grade = $Row[5];
                $credits = $Row[6];
                $title = $Row[7];
                $mark = $Row[8];
				*/
				//------------
				$uin=str_replace("'","",strtoupper($Row[0]));
				$indexno=str_replace("'","",strtoupper($Row[1]));
				$month=strtoupper($Row[2]);
				$year=strtoupper($Row[3]);
				$dob=strtoupper($Row[4]);
				$cname=strtoupper(mysql_real_escape_string($Row[5]));
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
				//------------

                if($uin == '') {
                    echo "UIN Not Found \n";
                } else {
                    
					$sqlcheck="DELETE from tbl_verified where indexno='$indexno' and uin='$uin'";
					$checkresult=mysqli_query($conn, $sqlcheck);
					
					$sql_insert = "INSERT INTO tbl_verified SET
							uin='$uin',
                            indexno='$indexno',
                            exam_month='$month',
			    			exam_year='$year',
			    			dob='$dob',
			    			cand_name='$cname',
							subject1='$sub1',
							grade1='$gd1',
							subject2='$sub2',
							grade2='$gd2',
							subject3='$sub3',
							grade3='$gd3',
							subject4='$sub4',
							grade4='$gd4',
							subject7='$sub7',
							grade7='$gd7',
							subject8='$sub8',
							grade8='$gd8',
							subject9='$sub9',
							grade9='$gd9',
							subject10='$sub10',
							grade10='$gd10'";

                        $rs_insert = mysqli_query($conn, $sql_insert);
                        if($rs_insert) {
							$studentData[]=$uin;
                        } else {
                            echo $conn->error;
                        }
                   } 
                /** Checking for Existence **/
               
                
                //}
            }
			$remark=Functions::resultVerification(array_unique($studentData),$username);
            echo $inserted." Records Inserted  \n";
            //echo $updated. " Records Updated \n";
        }
    }
    
} else {
    echo "Wrong File Format \n";
}

?>
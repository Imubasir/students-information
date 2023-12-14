<?php 
SESSION_START();
require_once ('../Db/connection.php');
require_once ('../Db/connection2.php');

$uin = $_POST['id'];
$userid = $_SESSION['uname'];
$data = array();
$dat=date('d-m-Y H:i:s');

$sql_results = "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, arms_pg.studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
FROM arms_pg.studentbiodata 
LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
WHERE studentbiodata.uin='$uin'";

$result = mysqli_query($conn, $sql_results);
$elect7='';
$egd7='';

$elect8='';
$egd8='';

$elect9='';
$egd9='';

$elect10='';
$egd10='';

$i=0;
if($result) {
	$temp_id='';
    while($row = mysqli_fetch_array($result)) {
		$uin=$row['uin'];
		$remark="Genuine";
		
		$data_no=explode("/",trim($row['student_no']));
		if($data_no[2]>10 && $data_no[2]<90){
			$par_check=1;
		}else{
			$par_check=0;
		}
		
		if($temp_id!==$uin && $par_check==1){
			$sql_remark="UPDATE arms_pg.studentbiodata SET qualification_status='Pending', modified_by='$userid', date_modified='$dat' WHERE uin='$uin'";
			$rs_remark=mysqli_query($conn2, $sql_remark);
			
			$sql_middle_filter="UPDATE arms_pg.studentbiodata SET middlename='' WHERE (middlename='N/A' OR middlename='N\A' OR middlename='NON' OR middlename='NIL' OR middlename='-' OR middlename='NONE') AND uin='$uin'";
			$rs_middle_filter=mysqli_query($conn2, $sql_middle_filter);
		}
		//$study_status=studyStatus($uin);
        
		$elective = array($row['wsub7']=>$row['wgd7'],$row['wsub8']=>$row['wgd8'],$row['wsub9']=>$row['wgd9'],$row['wsub10']=>$row['wgd10']);
        
        foreach($elective as $elect=>$egd){
			if(trim($row['ssub7'])!==''){
				if(strpos($elect, substr($row['ssub7'],0,4))!==false){
					$elect7=$elect;
					$egd7=$egd;
				}
			}
			if(trim($row['ssub8'])!==''){
				if(strpos($elect, substr($row['ssub8'],0,4))!==false){
					$elect8=$elect;
					$egd8=$egd;
				}
			}
			if(trim($row['ssub9'])!==''){
				if(strpos($elect, substr($row['ssub9'],0,4))!==false){
					$elect9=$elect;
					$egd9=$egd;
				}
			}
			if(trim($row['ssub10'])!==''){
				if(strpos($elect, substr($row['ssub10'],0,4))!==false){
					$elect10=$elect;
					$egd10=$egd;
				}
			}
		}
		//verification status
		if ($row['wgd1']!==$row['sgd1'] && $row['ssub1']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($row['wgd2']!==$row['sgd2'] && $row['ssub2']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($row['wgd3']!==$row['sgd3'] && $row['ssub3']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($row['wgd4']!==$row['sgd4'] && $row['ssub4']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($egd7!==$row['sgd7'] && $row['ssub7']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($egd8!==$row['sgd8'] && $row['ssub8']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($egd9!==$row['sgd9'] && $row['ssub9']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if ($egd10!==$row['sgd10'] && $row['ssub10']!==''){
			if($remark!=="Fake"){
				$remark="Fake";
			}
		}
		if(trim($row['surname'])==''){
			$remark="Fake";
		}else{
			if(strpos(str_replace('  ',' ',$row['wname']), trim(str_replace('  ',' ',$row['surname'])))!==false){
				$testname=0;	
			}else{
				if($remark!=="Fake"){
					$remark="Fake";
				}
			}
			if(strpos(str_replace('  ',' ',$row['wname']), trim(str_replace('  ',' ',$row['firstname'])))!==false){
				$testname=0;	
			}else{
				if($remark!=="Fake"){
					$remark="Fake";
				}
			}
			if(trim($row['middlename'])!=""){
				if(strpos(str_replace('  ',' ',$row['wname']), str_replace('  ',' ',trim($row['middlename'])))!==false){
					$testname=0;	
				}else{
					if($remark!=="Fake"){
						$remark="Fake";
					}
				}
			}
		}
		
		// if(trim($row['windexno'])!==''){
		// 	if($remark=='Fake'){
		// 		$sql_remark="UPDATE studentbiodata SET qualification_status='$remark', study_status='WITHDRAWN' WHERE uin='$uin' and qualification_status!='Fake'";
		// 	}else{
		// 		//status
		// 		$sql_biodata="SELECT indexno, uin, progname, entryyear FROM studentbiodata LEFT JOIN programme ON progid=sprogid WHERE uin='$uin'";
		// 		$rs_biodata=mysqli_query($conn, $sql_biodata);
					
		// 		while($row_biodata=mysqli_fetch_array($rs_biodata)){
		// 			$indexno1=$row_biodata['indexno'];
		// 			$programme=$row_biodata['progname'];
		// 			$entry_year=$row_biodata['entryyear'];
		// 		}
			
		// 		$prog=explode(" ",strtoupper($programme));
		// 		$duration=date("Y")-$entry_year;
			
		// 		$sql_grad="SELECT * FROM tbl_graduate WHERE indexno='$indexno1'";
		// 		$rs_grad=mysqli_query($conn, $sql_grad);
			
		// 		if($rs_grad->num_rows>0){
		// 			$study_status='GRADUATED';
		// 		}else{
		// 			switch(strtoupper(trim($prog[0]))){
		// 				case	'':
		// 					if($duration>7){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'BSC':
		// 					if($duration>6){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'BA':
		// 					if($duration>6){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'BED':
		// 					if($duration>6){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'BACHELOR':
		// 					if($duration>6){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'DIPLOMA':
		// 					if($duration>3){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'CERTIFICATE':
		// 					if($duration>2){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				case	'DOCTOR':
		// 					if($duration>8){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 					break;
		// 				default:
		// 					if($duration>7){
		// 						$study_status='FNG';
		// 					}else{
		// 						$study_status='ON-GOING';
		// 					}
		// 			}
		// 		}
		// 		$sql_remark="UPDATE studentbiodata SET qualification_status='$remark', study_status='$study_status' WHERE uin='$uin' and qualification_status!='Fake'";
		// 	}
		// }else{
			
			$sql_other_results="SELECT indexnum, surname, firstname, middlename, gradclass, graddate, entrylevel, cla, exam_date, progname FROM arms_pg.studentbiodata
			INNER JOIN arms_pg.tbl_graduate ON tbl_graduate.indexno=studentbiodata.indexno
			INNER JOIN tbl_other_results ON tbl_graduate.indexno=indexnum AND trans_id='$uin'
			INNER JOIN arms_pg.programme ON progid=sprogid";
			$rs_other_results=mysqli_query($conn2, $sql_other_results);
			$row_others=mysqli_fetch_assoc($rs_other_results);
			
			if($rs_other_results->num_rows>0){
				$programme=explode(" ", trim($row_others['progname']));
				$stuno=trim($row_others['indexnum']);
				if(strtoupper($programme[0])=='DIPLOMA'){
					$sql_gpa="SELECT cwa FROM tbl_cwa_gpa WHERE indexnum='$stuno' AND trimid=3 AND (levelid=2 OR levelid=3)";
				}else{
					$sql_gpa="SELECT cwa FROM tbl_cwa_gpa WHERE indexnum='$stuno' AND trimid=3 AND (levelid=4)";
				}
				$rs_gpa=mysqli_query($conn, $sql_gpa);
				while($row_gpa=mysqli_fetch_array($rs_gpa)){
					$cgpa=$row_gpa['cwa'];
				}
				switch(trim($row_others['entrylevel'])){
					case '1':
						if($cgpa<1.5){
							$remark='Fake';
						}else{
							$remark='Genuine';
						}
						break;
					case '2':
						if($cgpa<2.5){
							$remark='Fake';
						}else{
							$remark='Genuine';
						}
						break;	
				}
			}else{
				$sql_other_verified="SELECT uin, trans_id, cert_name, tbl_other_results.indexnum as sindexnum, tbl_other_verified.indexnum as vindexnum, tbl_other_results.exam_date as sexam_date, tbl_other_verified.exam_date as vexam_date, tbl_other_results.prog as sprog, tbl_other_verified.prog as vprog, tbl_other_results.cla as sclass, tbl_other_verified.class as vclass FROM tbl_other_verified
				INNER JOIN tbl_other_results ON uin=trans_id AND tbl_other_results.indexnum=tbl_other_verified.indexnum AND uin='$uin'";
				
				$rs_other_verified=mysqli_query($conn, $sql_other_verified);
				
				while($row_other_verified=mysqli_fetch_array($rs_other_verified)){
					$sexam_date=$row_other_verified['sexam_date'];
					$vexam_date=$row_other_verified['vexam_date'];
				
					$sprog=$row_other_verified['sprog'];
					$vprog=$row_other_verified['vprog'];
				
					$sclass=$row_other_verified['sclass'];
					$vclass=$row_other_verified['vclass'];
				
					$cert_name=$row_other_verified['cert_name'];
				}
				
				if($rs_other_verified->num_rows>0){
					
					if(trim($sprog)==trim($vprog) && trim($sclass)==trim($vclass)){
						
						$remark='Genuine';
						
						if(trim($row['surname'])==''){
							$remark="Fake";
						}else{
							if(strpos(str_replace('  ',' ',$cert_name), trim(str_replace('  ',' ',$row['surname'])))!==false){
								$testname=0;	
							}else{
								if($remark!=="Fake"){
									$remark="Fake";
								}
							}
							if(strpos(str_replace('  ',' ',$cert_name), trim(str_replace('  ',' ',$row['firstname'])))!==false){
								$testname=0;	
							}else{
								if($remark!=="Fake"){
									$remark="Fake";
								}
							}
							if(trim($row['middlename'])!=""){
								if(strpos(str_replace('  ',' ',$cert_name), str_replace('  ',' ',trim($row['middlename'])))!==false){
									$testname=0;	
								}else{
									if($remark!=="Fake"){
										$remark="Fake";
									}
								}
							}
						}
						
					}else{
						$remark='Fake';
					}
					
				}else{
					$remark='To be verified';
				}
				#$sql_remark="UPDATE studentbiodata SET qualification_status='$remark' WHERE uin='$uin' and qualification_status!='Fake'";
			}
			
			#$remark='To be verified';
			$sql_remark="UPDATE arms_pg.studentbiodata SET qualification_status='$remark' WHERE uin='$uin' and qualification_status!='Fake'";
		// }
		$rs_remark=mysqli_query($conn2,$sql_remark);
		$temp_id=$uin;
		
        //STUDENT DATA
        $data[$i]['sname'] = trim($row['firstname']).' '.trim($row['middlename']).' '.trim($row['surname']);
        $data[$i]['stdno'] = trim($row['student_no']);
        $data[$i]['uin'] = trim($row['uin']);
		$data[$i]['sindex'] = trim($row['sexam_month']).' - '.trim($row['sindexnumber']).' - '.trim($row['sexam_year']);
        
		$data[$i]['ssub1'] = trim($row['ssub1']);
		$data[$i]['ssub2'] = trim($row['ssub2']);
		$data[$i]['ssub3'] = trim($row['ssub3']);
		$data[$i]['ssub4'] = trim($row['ssub4']);
		
		$data[$i]['ssub7'] = trim($row['ssub7']);
		$data[$i]['ssub8'] = trim($row['ssub8']);
		$data[$i]['ssub9'] = trim($row['ssub9']);
		$data[$i]['ssub10'] = trim($row['ssub10']);
		
		$data[$i]['sgd1'] = trim($row['sgd1']);
		$data[$i]['sgd2'] = trim($row['sgd2']);
        $data[$i]['sgd3'] = trim($row['sgd3']);	
		$data[$i]['sgd4'] = trim($row['sgd4']);	
		
		$data[$i]['sgd7'] = trim($row['sgd7']);
        $data[$i]['sgd8'] = trim($row['sgd8']);	
		$data[$i]['sgd9'] = trim($row['sgd9']);
		$data[$i]['sgd10'] = trim($row['sgd10']);
      
        
        //WAEC DATA
        
        if(trim($row['ssub1'])!==''){
			$data[$i]['wsub1'] = trim($row['wsub1']);
			$data[$i]['wgd1'] = trim($row['wgd1']);
		}else{
			$data[$i]['wsub1'] = '';
			$data[$i]['wgd1'] = '';
		}
		if(trim($row['ssub2'])!==''){
			$data[$i]['wsub2'] = trim($row['wsub2']);
			$data[$i]['wgd2'] = trim($row['wgd2']);
		}else{
			$data[$i]['wsub2'] = '';
			$data[$i]['wgd2'] = '';
		}
		if(trim($row['ssub3'])!==''){
			$data[$i]['wsub3'] = trim($row['wsub3']);
			$data[$i]['wgd3'] = trim($row['wgd3']);	
		}else{
			$data[$i]['wsub3'] = '';
			$data[$i]['wgd3'] = '';	
		}
		if(trim($row['ssub4'])!==''){
			$data[$i]['wsub4'] = trim($row['wsub4']);
			$data[$i]['wgd4'] = trim($row['wgd4']);	
		}else{
			$data[$i]['wsub4'] = '';
			$data[$i]['wgd4'] = '';	
		}
		
		
		if(trim($row['ssub7'])!==''){
			$data[$i]['wsub7'] = trim($elect7);
			$data[$i]['wgd7'] = trim($egd7);
		}else{
			$data[$i]['wsub7'] = '';
			$data[$i]['wgd7'] = '';
		}
		if(trim($row['ssub8'])!==''){
			$data[$i]['wsub8'] = trim($elect8);
			$data[$i]['wgd8'] = trim($egd8);
		}else{
			$data[$i]['wsub8'] = '';
			$data[$i]['wgd8'] = '';
		}
		if(trim($row['ssub9'])!==''){
			$data[$i]['wsub9'] = trim($elect9);
			$data[$i]['wgd9'] = trim($egd9);	
		}else{
			$data[$i]['wsub9'] = '';
			$data[$i]['wgd9'] = '';	
		}
		if(trim($row['ssub10'])!==''){
			$data[$i]['wsub10'] = trim($elect10);
			$data[$i]['wgd10'] = trim($egd10);
		}else{
			$data[$i]['wsub10'] = '';
			$data[$i]['wgd10'] = '';
		}
		
        
       	$data[$i]['index'] = trim($row['windexno']);
        $data[$i]['wname'] = trim($row['wname']);
		$data[$i]['remark'] = $remark;
		
		$i++;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);

?>
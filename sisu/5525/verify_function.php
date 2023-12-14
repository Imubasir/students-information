<?php
	class Functions{
		//verification
		public static function resultVerification($studentID=null,$username){
			$dat=date('d-m-Y H:i:s');
			$temp_id='';
			foreach ($studentID as &$value){
			//while($row=mysql_fetch_array($result)) {
					
				//$uin=$row['trans_id'];
				$uin=$value;
				if($temp_id!==$uin){
					$sql_remark="UPDATE studentbiodata SET qualification_status='Pending', modified_by='$username', date_modified='$dat' WHERE trans_id='$uin'";
					$rs_remark=mysqli_query($conn, $sql_remark);
					
					$sql_middle_filter="UPDATE studentbiodata SET middlename='' WHERE (middlename='N/A' OR middlename='N\A' OR middlename='NON' OR middlename='NIL' OR middlename='-' OR middlename='NONE') AND uin='$uin'";
					$rs_middle_filter=mysqli_query($conn, $sql_middle_filter);
				}
					
				$sql_biodata="SELECT * FROM studentbiodata WHERE uin='$uin'";
				$rs_biodata=mysqli_query($conn, $sql_biodata);
						
				while($row_biodata=mysqli_fetch_array($rs_biodata)){
					$surname=$row_biodata['surname'];
					$middlename=$row_biodata['middlename'];
					$firstname=$row_biodata['firstname'];
					$fullname=$row_biodata['surname']." ".$row_biodata['middlename']." ".$row_biodata['firstname'];
				}
						
				$sql_results="select tbl_verified.indexno as windexno, tbl_shs_results.indexnumber as indexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, 				tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as 				wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, 				tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, 				tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, 				tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10 from tbl_shs_results LEFT JOIN 				tbl_verified  ON tbl_verified.uin=tbl_shs_results.trans_id and tbl_verified.indexno=tbl_shs_results.indexnumber WHERE tbl_shs_results.trans_id='$uin'";
				
				$rs_verify=mysqli_query($conn, $sql_results);
				
				while($row_verify=mysqli_fetch_array($rs_verify)){
					$nRecCount++;	
					$elective=array($row_verify['wsub7']=>$row_verify['wgd7'],$row_verify['wsub8']=>$row_verify['wgd8'],$row_verify['wsub9']=>$row_verify['wgd9'],$row_verify['wsub10']=>$row_verify['wgd10']);
					$remark="Genuine";
					/*
					foreach($elective as $elect=>$egd){
						if(strpos($elect, substr($row_verify['ssub7'],0,4))!==false){
							if($elect=='LIT-IN-ENGLISH'){
								$elect7='LITERATURE-IN-ENGLISH';
							}else if($elect=='LIT. IN ENGLISH'){
								$elect7='LITERATURE-IN-ENGLISH';
							}else if($elect=='MGT IN LIVING'){
								$elect7='MANAGEMENT-IN-LIVING';
							}else if($elect=='MGT. IN LIVING'){
								$elect7='MANAGEMENT-IN-LIVING';
							}else if($elect=='GEN KNOW IN ART'){
								$elect7='GENERAL KNOWLEDGE IN ART';
							}else{
								$elect7=$elect;
							}
							
							$egd7=$egd;
						}
						if(strpos($elect, substr($row_verify['ssub8'],0,4))!==false){
							if($elect=='LIT-IN-ENGLISH'){
								$elect8='LITERATURE-IN-ENGLISH';
							}else if($elect=='LIT. IN ENGLISH'){
								$elect8='LITERATURE-IN-ENGLISH';
							}else if($elect=='MGT IN LIVING'){
								$elect8='MANAGEMENT-IN-LIVING';
							}else if($elect=='MGT. IN LIVING'){
								$elect8='MANAGEMENT-IN-LIVING';
							}else if($elect=='GEN KNOW IN ART'){
								$elect8='GENERAL KNOWLEDGE IN ART';
							}else{
								$elect8=$elect;
							}
							$egd8=$egd;
						}
						if(strpos($elect, substr($row_verify['ssub9'],0,4))!==false){
							if($elect=='LIT-IN-ENGLISH'){
								$elect9='LITERATURE-IN-ENGLISH';
							}else if($elect=='LIT. IN ENGLISH'){
								$elect9='LITERATURE-IN-ENGLISH';
							}else if($elect=='MGT IN LIVING'){
								$elect9='MANAGEMENT-IN-LIVING';
							}else if($elect=='MGT. IN LIVING'){
								$elect9='MANAGEMENT-IN-LIVING';
							}else if($elect=='GEN KNOW IN ART'){
								$elect9='GENERAL KNOWLEDGE IN ART';
							}else{
								$elect9=$elect;
							}
							$egd9=$egd;
						}
						if(strpos($elect, substr($row_verify['ssub10'],0,4))!==false){
							if($elect=='LIT-IN-ENGLISH'){
								$elect10='LITERATURE-IN-ENGLISH';
							}else if($elect=='LIT. IN ENGLISH'){
								$elect10='LITERATURE-IN-ENGLISH';
							}else if($elect=='MGT IN LIVING'){
								$elect10='MANAGEMENT-IN-LIVING';
							}else if($elect=='MGT. IN LIVING'){
								$elect10='MANAGEMENT-IN-LIVING';
							}else if($elect=='GEN KNOW IN ART'){
								$elect10='GENERAL KNOWLEDGE IN ART';
							}else{
								$elect10=$elect;
							}
							$egd10=$egd;
						}
					}
					*/
					foreach($elective as $elect=>$egd){
						if(strpos($elect, substr($row_verify['ssub7'],0,4))!==false){
							$elect7=$elect;
							$egd7=$egd;
						}
						if(strpos($elect, substr($row_verify['ssub8'],0,4))!==false){
							$elect8=$elect;
							$egd8=$egd;
						}
						if(strpos($elect, substr($row_verify['ssub9'],0,4))!==false){
							$elect9=$elect;
							$egd9=$egd;
						}
						if(strpos($elect, substr($row_verify['ssub10'],0,4))!==false){
							$elect10=$elect;
							$egd10=$egd;
						}
					}
					
					if ($row_verify['wgd1']!==$row_verify['sgd1'] && $row_verify['ssub1']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($row_verify['wgd2']!==$row_verify['sgd2'] && $row_verify['ssub2']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($row_verify['wgd3']!==$row_verify['sgd3'] && $row_verify['ssub3']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($row_verify['wgd4']!==$row_verify['sgd4'] && $row_verify['ssub4']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($egd7!==$row_verify['sgd7'] && $row_verify['ssub7']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($egd8!==$row_verify['sgd8'] && $row_verify['ssub8']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($egd9!==$row_verify['sgd9'] && $row_verify['ssub9']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if ($egd10!==$row_verify['sgd10'] && $row_verify['ssub10']!==''){
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if(strpos($row_verify['wname'], str_replace('  ',' ',trim($surname)))!==false){
						$testname=0;	
					}else{
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if(strpos($row_verify['wname'], str_replace('  ',' ',trim($firstname)))!==false){
						$testname=0;	
					}else{
						if($remark!=="Fake"){
							$remark="Fake";
						}
					}
					if(trim($middlename)!=""){
						if(strpos($row_verify['wname'], str_replace('  ',' ',trim($middlename)))!==false){
							$testname=0;	
						}else{
							if($remark!=="Fake"){
								$remark="Fake";
							}
						}
					}
					$verificationRemark=$remark;
					
					if(trim($row_verify['windexno'])!==''){
						if($remark=='Fake'){
							$sql_remark="UPDATE studentbiodata SET qualification_status='$remark', study_status='WITHDRAWN' WHERE uin='$uin' and qualification_status!='Fake'";
						}else{
							$sql_remark="UPDATE studentbiodata SET qualification_status='$remark' WHERE uin='$uin' and qualification_status!='Fake'";
						}
					}else{
						$remark='To be verified';
						$sql_remark="UPDATE studentbiodata SET qualification_status='$remark' WHERE uin='$uin' and qualification_status!='Fake'";
					}
					//$sql_remark="UPDATE studentbiodata SET qualification_status='$remark' WHERE uin='$uin' AND qualification_status!='Fake'";
					$rs_remark=mysqli_query($con, $sql_remark);
					$temp_id=$uin;
									
				}
					
			}
			return $verificationRemark;
		}
	}
?>
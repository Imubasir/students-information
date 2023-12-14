<?php 
require_once ('../Db/connection.php');
$uin = $_POST['id'];
$transid = $_POST['transid'];
$data = array();

//$sql_results = "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname from tbl_verified, tbl_shs_results, studentbiodata where tbl_verified.uin='$uin' and tbl_verified.uin=tbl_shs_results.trans_id and tbl_verified.indexno = '$transid' and tbl_verified.indexno=tbl_shs_results.indexnumber and studentbiodata.uin = tbl_verified.uin";
$sql_results = "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname from tbl_verified, tbl_shs_results, studentbiodata where tbl_verified.uin='$uin' and tbl_verified.uin=tbl_shs_results.trans_id and tbl_verified.indexno=tbl_shs_results.indexnumber and studentbiodata.uin = tbl_verified.uin";

$result = mysqli_query($conn, $sql_results);
if($result) {
    while($row = mysqli_fetch_array($result)) {
        
$elective = array($row['wsub7']=>$row['wgd7'],$row['wsub8']=>$row['wgd8'],$row['wsub9']=>$row['wgd9'],$row['wsub10']=>$row['wgd10']);
        
        foreach($elective as $elect=>$egd){
						if(strpos($elect, substr($row['ssub7'],0,4))!==false){
							$elect7=$elect;
							$egd7=$egd;
						}
						if(strpos($elect, substr($row['ssub8'],0,4))!==false){
							$elect8=$elect;
							$egd8=$egd;
						}
						if(strpos($elect, substr($row['ssub9'],0,4))!==false){
							$elect9=$elect;
							$egd9=$egd;
						}
						if(strpos($elect, substr($row['ssub10'],0,4))!==false){
							$elect10=$elect;
							$egd10=$egd;
						}
					}
        //STUDENT DATA
        
        $data['ssub1'] = trim($row['ssub1']);
        $data['ssub2'] = trim($row['ssub2']);
        $data['ssub3'] = trim($row['ssub3']);
        $data['ssub4'] = trim($row['ssub4']);
        
        $data['ssub7'] = trim($row['ssub7']);
        $data['ssub8'] = trim($row['ssub8']);
        $data['ssub9'] = trim($row['ssub9']);
        $data['ssub10'] = trim($row['ssub10']);
        
        $data['sgd1'] = trim($row['sgd1']);
        $data['sgd2'] = trim($row['sgd2']);
        $data['sgd3'] = trim($row['sgd3']);
        $data['sgd4'] = trim($row['sgd4']);
        
        $data['sgd7'] = trim($row['sgd7']);
        $data['sgd8'] = trim($row['sgd8']);
        $data['sgd9'] = trim($row['sgd9']);
        $data['sgd10'] = trim($row['sgd10']);
        
        //WAEC DATA
        
        $data['wsub1'] = trim($row['wsub1']);
        $data['wsub2'] = trim($row['wsub2']);
        $data['wsub3'] = trim($row['wsub3']);
        $data['wsub4'] = trim($row['wsub4']);
        
        $data['wsub7'] = trim($elect7);
        $data['wsub8'] = trim($elect8);
        $data['wsub9'] = trim($elect9);
        $data['wsub10'] = trim($elect10);
        
        $data['wgd1'] = trim($row['wgd1']);
        $data['wgd2'] = trim($row['wgd2']);
        $data['wgd3'] = trim($row['wgd3']);
        $data['wgd4'] = trim($row['wgd4']);
        
        $data['wgd7'] = trim($egd7);
        $data['wgd8'] = trim($egd8);
        $data['wgd9'] = trim($egd9);
        $data['wgd10'] = trim($egd10);
        
        $data['name'] = trim($row['surname']).' '.trim($row['middlename']).' '.trim($row['firstname']);
        $data['stdno'] = trim($row['student_no']);
        $data['uin'] = trim($row['uin']);
        $data['index'] = trim($row['windexno']);
        $data['wname'] = trim($row['wname']);
    }
} else {
    echo $conn->error;
}

echo json_encode($data);

?>
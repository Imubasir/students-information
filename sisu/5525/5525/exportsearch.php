<?php 
require("../Db/connection.php");
if(isset($_POST['category'])){
	$category = $_POST['category'];
}else{
	$category = '';
}
$dat=date('d-m-Y H:i:s');

if(isset($_POST['student_uin'])) {
    $student_uin = $_POST['student_uin'];
} else {
    $student_uin = '';
}

if(isset($_POST['programme'])) {
    $programme = $_POST['programme'];
} else {
    $programme= '';
}

if(isset($_POST['graddate'])) {
    $graddate = $_POST['graddate'];
} else {
    $graddate = '';
}

if(isset($_POST['year'])) {
    $year = $_POST['year'];
} else {
    $year = '';
}

if(isset($_POST['class'])) {
    $class = $_POST['class'];
} else {
    $class = '';
}

if(isset($_POST['status'])) {
    $status = $_POST['status'];
} else {
    $status = '';
}

if($category == 'gradlist') {
    $query = '';

	if($student_uin != '' && $class != '' && $programme != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and gradclass = '$class' and studentbiodata.sprogid = '$programme' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if($class != '' && $programme != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where gradclass = '$class' and studentbiodata.sprogid = '$programme' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if($student_uin != '' && $programme != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and studentbiodata.sprogid = '$programme' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($student_uin != '' && $class != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and gradclass = '$class' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($student_uin != '' && $class != '' && $programme != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and gradclass = '$class' and studentbiodata.sprogid = '$programme' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($programme != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$programme' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($class != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.gradclass = '$class' and tbl_graduate.graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($class != '' && $programme != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where gradclass = '$class' and studentbiodata.sprogid = '$programme' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($student_uin != '' && $graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($student_uin != '' && $programme != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and studentbiodata.sprogid = '$programme' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($student_uin != '' && $class != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and gradclass = '$class' and studentbiodata.qualification_status != 'Fake' ";
	} 
	else if ($graddate != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	}
	else if ($programme != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$programme' and studentbiodata.qualification_status != 'Fake' ";
	}
	else if ($class != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where gradclass = '$class' and studentbiodata.qualification_status != 'Fake' ";
	}
	else if ($student_uin != '') {
	    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$student_uin' and studentbiodata.qualification_status != 'Fake' ";
	} else {
	    echo $student_uin.' '.$class.' '.$programme.' '.$graddate;
	}
    
    $grad_result = mysqli_query($conn, $query);
    $data = array();
    $final_data = array();

    if($grad_result) {
        while($row = mysqli_fetch_assoc($grad_result)) {
            $data[] = $row;
        }
    } else {
        echo $conn->error;
    }
    
    echo json_encode($data);
} else if($category == 'verif_det') {

	$query = '';

	if($student_uin != '' && $year != '' && $programme != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} 
	else if($year != '' && $programme != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.sprogid='$programme' AND studentbiodata.entryyear='$year' AND studentbiodata.qualification_status='$status'";
	} 
	else if($student_uin != '' && $programme != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} 
	else if ($student_uin != '' && $year != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	}
	else if ($student_uin != '' && $year != '' && $programme != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} 
	else if ($programme != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.sprogid='$programme' AND studentbiodata.qualification_status='$status'";
	} 
	else if ($year != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.qualification_status='$status' AND studentbiodata.entryyear='$year'";
	} 
	else if ($year != '' && $programme != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.sprogid='$programme' AND studentbiodata.entryyear='$year'";
	} 
	else if ($student_uin != '' && $status != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} 
	else if ($student_uin != '' && $programme != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} 
	else if ($student_uin != '' && $year != '') {
    
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} 
	else if ($status != '') {
    
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
		FROM studentbiodata 
		LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
		LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
		LEFT JOIN programme on studentbiodata.sprogid = programme.progid
		WHERE studentbiodata.qualification_status='$status";
	
	}
	else if ($programme != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
	FROM studentbiodata 
	LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
	LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
	LEFT JOIN programme on studentbiodata.sprogid = programme.progid
	WHERE studentbiodata.sprogid='$programme'";
	}
	else if ($year != '') {

	    $query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname, studentbiodata.entryyear 
	FROM studentbiodata 
	LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
	LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
	WHERE studentbiodata.entryyear='$year'";
	}
	else if ($student_uin != '') {
		$query.= "SELECT tbl_verified.indexno as windexno, tbl_verified.cand_name as wname, tbl_verified.subject1 as wsub1, tbl_verified.grade1 as wgd1, tbl_verified.subject2 as wsub2, tbl_verified.grade2 as wgd2, tbl_verified.subject3 as wsub3, tbl_verified.grade3 as wgd3, tbl_verified.subject4 as wsub4, tbl_verified.grade4 as wgd4, tbl_verified.subject7 as wsub7, tbl_verified.grade7 as wgd7, tbl_verified.subject8 as wsub8, tbl_verified.grade8 as wgd8, tbl_verified.subject9 as wsub9, tbl_verified.grade9 as wgd9, tbl_verified.subject10 as wsub10, tbl_verified.grade10 as wgd10, tbl_shs_results.subject1 as ssub1, tbl_shs_results.grade1 as sgd1, tbl_shs_results.subject2 as ssub2, tbl_shs_results.grade2 as sgd2, tbl_shs_results.subject3 as ssub3, tbl_shs_results.grade3 as sgd3, tbl_shs_results.subject4 as ssub4, tbl_shs_results.grade4 as sgd4, tbl_shs_results.subject7 as ssub7, tbl_shs_results.grade7 as sgd7, tbl_shs_results.subject8 as ssub8, tbl_shs_results.grade8 as sgd8, tbl_shs_results.subject9 as ssub9, tbl_shs_results.grade9 as sgd9, tbl_shs_results.subject10 as ssub10, tbl_shs_results.grade10 as sgd10, tbl_shs_results.exam_month as sexam_month, tbl_shs_results.exam_year as sexam_year, tbl_shs_results.indexnumber as sindexnumber, studentbiodata.uin as uin, studentbiodata.indexno as student_no, studentbiodata.firstname, studentbiodata.middlename, studentbiodata.surname 
	FROM studentbiodata 
	LEFT JOIN tbl_shs_results ON studentbiodata.uin=tbl_shs_results.trans_id
	LEFT JOIN tbl_verified ON tbl_verified.uin=tbl_shs_results.trans_id AND tbl_verified.indexno=tbl_shs_results.indexnumber
	WHERE studentbiodata.uin='$student_uin' OR studentbiodata.indexno='$student_uin'";
	} else {
	    echo $student_uin.' '.$year.' '.$programme.' '.$status;
	}
    
			$result = mysqli_query($conn, $query);
		    $data = array();
		    $final_data = array();
		
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
						$sql_remark="UPDATE studentbiodata SET qualification_status='Pending' WHERE uin='$uin'";
						$rs_remark=mysqli_query($conn, $sql_remark);
			
						$sql_middle_filter="UPDATE studentbiodata SET middlename='' WHERE (middlename='N/A' OR middlename='N\A' OR middlename='NON' OR middlename='NIL' OR middlename='-' OR middlename='NONE') AND uin='$uin'";
						$rs_middle_filter=mysqli_query($conn, $sql_middle_filter);
					}
        
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
		
					if(trim($row['windexno'])!==''){
						$sql_remark="UPDATE studentbiodata SET qualification_status='$remark' WHERE uin='$uin' and qualification_status!='Fake'";
					}else{
						$remark='To be verified';
						$sql_remark="UPDATE studentbiodata SET qualification_status='$remark' WHERE uin='$uin' and qualification_status!='Fake'";
					}
					$rs_remark=mysqli_query($conn,$sql_remark);
					$temp_id=$uin;
		
			        //STUDENT DATA
			        $data[$i]['sname'] = trim($row['surname']).' '.trim($row['middlename']).' '.trim($row['firstname']);
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
			    echo $conn->error;
			}
	    //echo json_encode($final_data);
		echo json_encode($data);
    
}else if ($category == 'waec') {
    
}else{
	echo 'Select Category';
}



?>
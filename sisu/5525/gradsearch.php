<?php
require_once('../Db/connection.php');

if(isset($_POST['grad_sid'])) {
    $sid = $_POST['grad_sid'];
} else {
    $sid = '';
}

if(isset($_POST['grad_name'])) {
    $name = $_POST['grad_name'];
} else {
    $name = '';
}

if(isset($_POST['grad_programme'])) {
    $prog = $_POST['grad_programme'];
} else {
    $prog = '';
}

if(isset($_POST['grad_graddate'])) {
    $graddate = $_POST['grad_graddate'];
} else {
    $graddate = '';
}

$query = '';

if($sid != '' && $name != '' && $prog != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND sprogid='$prog' AND graddate='$graddate' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if($name != '' && $prog != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND sprogid='$prog' AND graddate='$graddate'";
} 
else if($sid != '' && $prog != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE sprogid='$prog' AND graddate='$graddate' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if ($sid != '' && $name != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND graddate='$graddate' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if ($sid != '' && $name != '' && $prog != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND sprogid='$prog' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if ($prog != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE sprogid='$prog' AND graddate='$graddate'";
} 
else if ($name != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND graddate='$graddate'";
} 
else if ($name != '' && $prog != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND sprogid='$prog'";
} 
else if ($sid != '' && $graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and graddate = '$graddate' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE graddate='$graddate' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if ($sid != '' && $prog != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE sprogid='$prog' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if ($sid != '' && $name != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' AND (uin='$sid' OR studentbiodata.indexno='$sid')";
} 
else if ($graddate != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where graddate = '$graddate'";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE graddate='$graddate'";
}
else if ($prog != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE sprogid='$prog'";
}
else if ($name != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%'";
}
else if ($sid != '') {
    //$query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.qualification_status != 'Fake' ";
	$query .= "SELECT uin, studentbiodata.indexno, firstname, middlename, surname, certno, progname, gradclass, graddate, qualification_status FROM studentbiodata INNER JOIN tbl_graduate ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN  programme  ON sprogid  = progid WHERE uin = '$sid' OR studentbiodata.indexno='$sid'";
} else {
    echo $sid.' '.$name.' '.$prog.' '.$graddate;
}

$result = mysqli_query($conn, $query);
$data = array();

if($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

echo json_encode($data);

?>
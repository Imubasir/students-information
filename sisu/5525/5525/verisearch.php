<?php
require_once('../Db/connection.php');

if(isset($_POST['veri_sid'])) {
    $sid = $_POST['veri_sid'];
} else {
    $sid = '';
}

if(isset($_POST['veri_name'])) {
    $name = $_POST['veri_name'];
} else {
    $name = '';
}

if(isset($_POST['veri_programme'])) {
    $prog = $_POST['veri_programme'];
} else {
    $prog = '';
}

if(isset($_POST['year'])) {
    $year = $_POST['year'];
} else {
    $year = '';
}

if(isset($_POST['status'])) {
    $status = $_POST['status'];
} else {
    $status = '';
}

$query = '';


if ($sid != '' && $name != '' && $prog != '' && $status !='' && $year !='') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($year != '' && $status != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE entryyear='$year' AND sprogid='$prog' AND qualification_status='$status'";
}
else if ($sid != '' && $name != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $status != '' && $year != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $name != '' && $status!= '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $name != '' && $year != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $status != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $year != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' order by studentbiodata.uin asc ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($name != '' && $prog != '' && $status !='') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%' AND sprogid='$prog' AND qualification_status='$status'";
} 
else if ($name != '' && $prog != '' && $year !='') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%' AND sprogid='$prog' AND entryyear='$year'";
} 
else if ($year != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE entryyear='$year' AND sprogid='$prog'";
} 
else if ($status != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE qualification_status='$status' AND sprogid='$prog'";
} 
else if ($name != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%' AND sprogid='$prog'";
} 
else if ($name != '' && $year != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%' AND entryyear='$year'";
} 
else if ($name != '' && $status != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%' AND qualification_status='$status'";
} 
else if ($sid != '' && $prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE sprogid='$prog' AND (uin='$sid' OR indexno='$sid')";
} 
else if ($sid != '' && $name != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%' AND (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $status != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($sid != '' && $year != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' and cand_name LIKE '%{$name}%' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (uin='$sid' OR indexno='$sid')";
}
else if ($status != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE qualification_status='$status'";
}
else if ($year != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE entryyear='$year'";
}
else if ($prog != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where studentbiodata.sprogid = '$prog' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE sprogid='$prog'";
}
else if ($name != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where cand_name LIKE '%{$name}%' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE concat_ws(' ',firstname,middlename,surname) LIKE '%$name%'";
}
else if ($sid != '') {
    //$query .= "SELECT * FROM studentbiodata inner join tbl_verified on tbl_verified.uin = studentbiodata.uin inner join programme on studentbiodata.sprogid = programme.progid where tbl_verified.uin = '$sid' ";
	$query .= "SELECT uin, indexno, concat_ws(' ',firstname,middlename,surname) AS cand_name, progname, qualification_status, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE uin='$sid' OR indexno='$sid'";
}else {
    echo $sid.' '.$name.' '.$prog.' '.$year.' '.$status;
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
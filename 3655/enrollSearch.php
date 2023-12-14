<?php
require_once('../Db/connection2.php');

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
     $entryyear = $_POST['grad_graddate'];
} else {
     $entryyear = '';
}

$query = '';

if($sid != '' && $prog != '' &&  $entryyear != '') {
    //$query .= "SELECT * FROM studentbiodata
        //LEFT JOIN programme ON sprogid = progid LEFT JOIN tbl_campus ON programme.campus_id = tbl_campus.campus_id LEFT JOIN faculty ON facid = faculty.facultyid WHERE indexno = '$sid' and sprogid = '$prog' and entryyear = '$entryyear'";
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE (indexno = '$sid' OR uin = '$sid') and sprogid = '$prog' and entryyear = '$entryyear'";
} 
else if($prog != '' &&  $entryyear != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE sprogid = '$prog' and entryyear = '$entryyear' ";
}
else if ($sid != '' &&  $entryyear != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE (indexno = '$sid' OR uin = '$sid') and entryyear = '$entryyear' ";
} 
else if ($sid != '' && $prog != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE indexno = '$sid' and sprogid = '$prog'";
} 
else if ( $entryyear != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE entryyear = '$entryyear'";
} 
else if ($prog != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE sprogid = '$prog' ";
}
else if ($sid != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE (indexno = '$sid' OR uin = '$sid')";
} 
else if ($name != '') {
    $query .= "SELECT * FROM arms_pg.studentbiodata
        LEFT JOIN arms_pg.programme ON sprogid = progid LEFT JOIN arms.faculty ON facid = faculty.facultyid LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id WHERE surname = '$name' OR firstname = '$name' OR middlename = '$name'";
} 
 else {
    echo $sid.' '.$name.' '.$prog.' '. $entryyear;
}

$result = mysqli_query($conn2, $query);
$data = array();

if($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);

?>
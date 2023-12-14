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
// echo $sid.' '.$name.' '.$prog.' '.$graddate;
$query = '';

if($sid != '' && $name != '' && $prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if($name != '' && $prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if($sid != '' && $prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if ($sid != '' && $name != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and graddate = '$graddate' ";
} 
else if ($sid != '' && $name != '' && $prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
} 
else if ($prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if ($name != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and graddate = '$graddate' ";
} 
else if ($name != '' && $prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' and studentbiodata.sprogid = '$prog' ";
} 
else if ($sid != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and graddate = '$graddate' ";
} 
else if ($sid != '' && $prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' ";
} 
else if ($sid != '' && $name != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' ";
} 
else if ($graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where graddate = '$graddate' ";
}
else if ($prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' ";
}
else if ($name != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where concat_ws(' ', surname, middlename, firstname) LIKE '%{$name}%' ";
}
else if ($sid != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' ";
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
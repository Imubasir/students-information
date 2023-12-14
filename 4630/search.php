<?php
ini_set('memory_limit','2048M');
require_once('../Db/connection.php');
$stud_id = isset($_POST['stud_id']) ? $_POST['stud_id'] : "";
$prog_id = isset($_POST['prog_id']) ? $_POST['prog_id'] : "";
$grad_date = isset($_POST['grad_year']) ? date('F d, Y', strtotime($_POST['grad_year'])) : "";

if($grad_date == 'January 01, 1970') {
    $grad_date = '';
}

$sql = "";
if($stud_id != '' && $prog_id != '' & $grad_date != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE tbl_graduate.indexno = '$stud_id' and graddate = '$grad_date' and sprogid = '$prog_id' and qualification_status = 'Genuine'";
} else if ($stud_id != '' && $prog_id != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE tbl_graduate.indexno = '$stud_id' and sprogid = '$prog_id' and qualification_status = 'Genuine'";
} else if ($stud_id != '' && $grad_date != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE tbl_graduate.indexno = '$stud_id' and graddate = '$grad_date' and qualification_status = 'Genuine'";
} else if ($prog_id != '' && $grad_date != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE graddate = '$grad_date' and sprogid = '$prog_id' and qualification_status = 'Genuine'";
} else if ($stud_id != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE tbl_graduate.indexno = '$stud_id' and qualification_status = 'Genuine'";
} else if ($prog_id != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE sprogid = '$prog_id' and qualification_status = 'Genuine'";
} else if ($grad_date != '') {
    $sql .= "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme ON sprogid = progid WHERE graddate = '$grad_date' and qualification_status = 'Genuine'";
}

$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}
echo json_encode($data);
?>
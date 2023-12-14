<?php
require_once ('../Db/connection2.php');
$uin = $_POST['id'];

$sql = "SELECT arms_pg.studentbiodata.*, arms_pg.programme.*, arms.tbl_country.*, arms.region.*, arms.tbl_option.*, arms.faculty.*, arms.tbl_campus.*, arms.tbl_graduate.graddate, arms.tbl_graduate.gradclass, arms.tbl_graduate.issued, arms.tbl_graduate.certno, arms.tbl_graduate.issued_date FROM arms_pg.studentbiodata 
		LEFT JOIN arms_pg.programme on sprogid = progid 
        LEFT JOIN arms.tbl_country on studentbiodata.nationality = tbl_country.country_id 
        LEFT JOIN arms.region on studentbiodata.rob = region.regionid 
        LEFT JOIN arms.tbl_option on studentbiodata.option_id = tbl_option.optionid
         LEFT JOIN arms.faculty ON facid = faculty.facultyid 
         LEFT JOIN arms.tbl_campus ON tbl_campus.campus_id = fcampus_id
        LEFT JOIN arms.tbl_graduate ON arms_pg.studentbiodata.indexno = tbl_graduate.indexno 
         WHERE uin = '$uin' ";
$rs = mysqli_query($conn2, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);
?>
<?php
require_once ('../Db/connection.php');
$uin = $_POST['id'];

$sql = "SELECT studentbiodata.*, programme.*, tbl_country.*, region.*, tbl_option.*, faculty.*, tbl_campus.*, tbl_graduate.graddate, tbl_graduate.gradclass, tbl_graduate.issued, tbl_graduate.certno, tbl_graduate.issued_date FROM studentbiodata left join programme on sprogid = progid 
        left join tbl_country on studentbiodata.nationality = tbl_country.country_id 
        left JOIN region on studentbiodata.rob = region.regionid 
        LEFT JOIN tbl_option on studentbiodata.option_id = tbl_option.optionid
         LEFT JOIN faculty ON facid = faculty.facultyid 
         LEFT JOIN tbl_campus ON tbl_campus.campus_id = fcampus_id
        LEFT JOIN tbl_graduate ON studentbiodata.indexno = tbl_graduate.indexno WHERE uin = '$uin' ";
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
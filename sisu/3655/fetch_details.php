<?php
require_once ('../Db/connection2.php');
$uin = $_POST['id'];

$sql = "SELECT * FROM arms_pg.studentbiodata left join arms_pg.programme on sprogid = progid 
        left join arms.tbl_country on studentbiodata.nationality = arms.tbl_country.country_id 
        left JOIN arms.region on arms_pg.studentbiodata.rob = arms.region.regionid 
        LEFT JOIN arms_pg.tbl_option on arms_pg.studentbiodata.option_id = arms_pg.tbl_option.optionid WHERE uin = '$uin' ";
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
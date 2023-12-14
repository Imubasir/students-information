<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$sql_fetch1 = "SELECT arms.tbl_graduate.indexno, arms.tbl_graduate.gradclass, arms.tbl_graduate.graddate, arms.tbl_graduate.facname, arms.tbl_graduate.issued, arms.tbl_graduate.certno, arms.tbl_graduate.issued_date, arms.studentbiodata.surname, arms.studentbiodata.middlename, arms.studentbiodata.firstname, studentbiodata.sprogid, programme.progname, programme.progid FROM tbl_graduate LEFT JOIN arms.studentbiodata on arms.studentbiodata.indexno = arms.tbl_graduate.indexno LEFT JOIN arms.programme on sprogid=progid";

$sql_fetch2 = "SELECT tbl_graduate.indexno, tbl_graduate.gradclass, tbl_graduate.graddate, tbl_graduate.facname, tbl_graduate.issued, tbl_graduate.certno, tbl_graduate.issued_date, studentbiodata.surname, studentbiodata.middlename, studentbiodata.firstname, programme.progname FROM tbl_graduate LEFT JOIN studentbiodata on studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme on sprogid=progid";

$rs_1 = mysqli_query($conn, $sql_fetch1);
$rs_2 = mysqli_query($conn2, $sql_fetch2);

$data = array();
if($rs_1) {
    while($row = mysqli_fetch_assoc($rs_1)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

if($rs_2) {
    while($row_2 = mysqli_fetch_assoc($rs_2)) {
        $data[] = $row_2;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);
?>
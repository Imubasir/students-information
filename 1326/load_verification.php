<?php
require("../Db/connection2.php");
$dat=date('y');
// $dat=2018;
$sql = "SELECT uin, concat_ws(' ',firstname,middlename,surname) AS cand_name, indexno, qualification_status, progname, entryyear, currentlevel, study_status  FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE entryyear='$dat'";

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
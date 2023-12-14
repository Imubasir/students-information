<?php
require("../Db/connection.php");
require("../Db/connection2.php");

$id = $_POST['id'];

$sql = "SELECT * FROM tbl_graduate 
            LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno
            LEFT JOIN programme ON studentbiodata.sprogid = programme.progid 
            LEFT JOIN tbl_souvenir ON tbl_graduate.indexno = tbl_souvenir.student_id
            WHERE tbl_graduate.indexno = '$id'";

$data = array();

$rs = mysqli_query($conn, $sql);
$rs2 = mysqli_query($conn2, $sql);

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

if($rs2) {
    while($row = mysqli_fetch_assoc($rs2)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}
    
echo json_encode($data);
?>
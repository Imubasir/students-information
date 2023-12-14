<?php
require("../Db/connection.php");
require("../Db/connection2.php");
$id = $_POST['id'];
$cat = $_POST['cat'];

$sql = "SELECT CONCAT_WS(' ', firstname, middlename, surname) AS name, progname FROM studentbiodata LEFT JOIN programme on sprogid = progid WHERE indexno = '$id'";
$data = array();

if($cat == 'Undergraduate') {
    $sql_rs = mysqli_query($conn, $sql);
    if($sql_rs) {
        while($row = mysqli_fetch_assoc($sql_rs)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo 0;
    }
}else if($cat == 'Postgraduate'){
    $sql_rs_ = mysqli_query($conn2, $sql);
    if($sql_rs_) {
        while($row = mysqli_fetch_assoc($sql_rs_)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo 0;
    }
}



?>
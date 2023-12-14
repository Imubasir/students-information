<?php
require_once('../Db/connection.php');
$id=$_POST['id'];
//$title = $_POST['title'];
$data = array();
$sql = "SELECT t1.Sindexno, concat(t1.firstname,' ', IFNULL(t1.middlename,''),' ', t1.surname) AS name, if(t2.progname LIKE'DIP%','two-year', 'four-year')AS numyears,if(t2.progname LIKE'DIP%','', 'degree')AS deg,t2.fullname, t2.progname, if(t1.gender='Male','his', 'her') AS gender FROM arms.studentbiodata AS t1 LEFT JOIN arms.programme AS t2 ON t2.progid =t1.sprogid WHERE t1.Sindexno='$id'";

$data = array();
$rs = mysqli_query($conn, $sql);
if($rs) {
    while ($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}
echo json_encode($data);
?>
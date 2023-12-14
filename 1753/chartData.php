<?php
session_start();
require("../../php/connect.php");

$sql = "SELECT DISTINCT entryyear, COUNT(*) as value FROM `studentbiodata` group BY entryyear";
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
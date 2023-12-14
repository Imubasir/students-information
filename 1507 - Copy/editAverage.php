<?php
require("../Db/connection.php");

$id = $_POST['id'];

$sql = "SELECT * FROM tbl_cwa_gpa where indexnum = '$id' order by levelid asc, trimid asc";
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
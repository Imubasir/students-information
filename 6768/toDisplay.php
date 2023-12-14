<?php
require_once("../Db/connection.php");
$id = $_POST['id'];

$sql = "SELECT Distinct levelid from conass where indexno = '$id'";
$rs = mysqli_query($conn, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $data[] = $row['levelid'];
    }
} else {
    echo $conn->error;
}

echo json_encode($data);
 ?>
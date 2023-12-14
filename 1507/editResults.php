<?php
require("../Db/connection.php");

$id = $_POST['id'];
$lvl = $_POST['selLevel'];
$trim = $_POST['selTrimester'];

$sql = "SELECT * FROM conass where indexno = '$id' and levelid = '$lvl' and trimester = '$trim' ORDER BY coursecode1";
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
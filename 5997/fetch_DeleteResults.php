<?php 
require_once('../Db/connection2.php');
$id = $_POST['id'];

$sql = "SELECT * from conass where indexno = '$id' order by levelid asc, trimester asc";
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
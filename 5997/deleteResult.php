<?php 
require_once('../Db/connection2.php');
$id = $_POST['id'];
$code = $_POST['code'];
$level = $_POST['level'];

$sql = "DELETE FROM conass where indexno = '$id' and levelid = '$level' and coursecode1 = '$code'";
$rs = mysqli_query($conn2, $sql);

if($rs) {
   echo 1;
} else {
    echo $conn2->error;
}
?>
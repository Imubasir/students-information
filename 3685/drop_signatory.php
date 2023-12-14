<?php
require("../Db/connection.php");
$id = $_POST['id'];
$desig = $_POST['desig'];

$sql = "DELETE FROM tbl_sign where ID = '$id'";
$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
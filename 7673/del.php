<?php
require("../Db/connection.php");
$id = $_POST['id'];

$sql = "DELETE FROM tbl_campus where campus_id = '$id'";
$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}

?>
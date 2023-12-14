<?php
require("../Db/connection.php");
$name = $_POST['name'];
$desig = $_POST['desig'];

$sql = "INSERT into tbl_sign (fullname, post) values ('$name', '$desig')";
$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>
<?php
require_once('../Db/connection.php');
$sql = "SELECT * FROM tbl_sign WHERE status = 'Active' ";
$rs = mysqli_query($conn, $sql);
if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        echo $row['fullname'];
    }
}
?>
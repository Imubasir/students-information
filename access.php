<?php
session_start();
require('Db/connection.php');
$user = $_SESSION['uname'];

$sql = "SELECT fpage from tbl_pages where username = '$user'";
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
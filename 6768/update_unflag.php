<?php
session_start();
require('../Db/connection.php');

$id = $_POST['id'];

$sql = "UPDATE trial_transcript SET flag = '0' where trans_uin = '$id'";
$result = mysqli_query($conn, $sql);
if($result) {
echo '1';        
} else {
    echo $conn->error;
}

?>
<?php
session_start();
require('../Db/connection.php');
// $username = $_SESSION['uname'];
// $access=$_SESSION['access'];

$id = $_POST['id'];

$sql = "UPDATE trial_transcript SET flag = '1' where trans_uin = '$id'";
$result = mysqli_query($conn, $sql);
if($result) {
echo '1';        
} else {
    echo $conn->error;
}

?>
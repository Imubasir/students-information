<?php
require("../Db/connection.php");
$id = $_POST['id'];
$data = array();

$api_url = "".$id;
$response = file_get_contents($api_url);
$response = json_decode($response, TRUE);

if(empty($response)) {
    echo "Record Not Found";
} else {
    $s_id = $response[0]['student_id'];
}
$sql_fetch = "SELECT * FROM tbl_graduate 
                LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno
                LEFT JOIN programme ON studentbiodata.sprogid = programme.progid 
                LEFT JOIN tbl_souvenir ON tbl_graduate.indexno = tbl_souvenir.student_id
                WHERE tbl_graduate.indexno = '$s_id'";

$sql_rs = mysqli_query($conn, $sql_fetch);
if($sql_rs) {
    while($row = mysqli_fetch_assoc($sql_rs)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

echo json_encode($data);
?>
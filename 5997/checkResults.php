<?php 
require_once('../Db/connection2.php');
$id = $_POST['id'];

$sql = "SELECT conass.indexno, uin, studentbiodata.indexno, surname, middlename, firstname, progname FROM studentbiodata left join conass on conass.indexno = studentbiodata.indexno left join programme on studentbiodata.sprogid = programme.progid where studentbiodata.indexno = '$id' OR uin='$id' LIMIT 1";
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
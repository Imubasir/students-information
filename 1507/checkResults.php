<?php 
require_once('../Db/connection.php');
$id = $_POST['id'];

$sql = "SELECT conass.indexno, uin, studentbiodata.indexno, tbl_graduate.graddate, surname, middlename, firstname, progname FROM studentbiodata left join conass on conass.indexno = studentbiodata.indexno left join programme on studentbiodata.sprogid = programme.progid left join tbl_graduate on tbl_graduate.indexno = conass.indexno where studentbiodata.indexno = '$id' OR uin='$id' LIMIT 1";
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
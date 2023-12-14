<?php
require_once ("../Db/connection.php");
$id = $_POST['id'];

$sql1 = "SELECT * FROM conass where indexno = '$id' and levelid = '1' and trimester = '1' order by levelid, trimester ASC";
$sql2 = "SELECT * FROM conass where indexno = '$id' and levelid = 1 and trimester = 2 order by levelid, trimester ASC";
$sql3 = "SELECT * FROM conass where indexno = '$id' and levelid = 1 and trimester = 3 order by levelid, trimester ASC";

$sql4 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 1 order by levelid, trimester ASC";
$sql5 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 2 order by levelid, trimester ASC";
$sql6 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 3 order by levelid, trimester ASC";

$sql7 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 1 order by levelid, trimester ASC";
$sql8 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 2 order by levelid, trimester ASC";
$sql9 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 3 order by levelid, trimester ASC";

$sql10 = "SELECT * FROM conass where indexno = '$id' and levelid = 4 and trimester = 1 order by levelid, trimester ASC";
$sql11 = "SELECT * FROM conass where indexno = '$id' and levelid = 4 and trimester = 2 order by levelid, trimester ASC";
$sql12 = "SELECT * FROM conass where indexno = '$id' and levelid = 4 and trimester = 3 order by levelid, trimester ASC";

$first = array();

$rs1 = mysqli_query($conn, $sql1);
if($rs1) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $first[] = $row;
    }
}

$rs2 = mysqli_query($conn, $sql2);
if($rs2) {
    while($row = mysqli_fetch_assoc($rs2)) {
        $first[] = $row;
    }
}

$rs3 = mysqli_query($conn, $sql3);
if($rs3) {
    while($row = mysqli_fetch_assoc($rs3)) {
        $first[] = $row;
    }
}

$rs4 = mysqli_query($conn, $sql4);
if($rs4) {
    while($row = mysqli_fetch_assoc($rs4)) {
        $first[] = $row;
    }
}

$rs5 = mysqli_query($conn, $sql5);
if($rs5) {
    while($row = mysqli_fetch_assoc($rs5)) {
        $first[] = $row;
    }
}

$rs6 = mysqli_query($conn, $sql6);
if($rs6) {
    while($row = mysqli_fetch_assoc($rs6)) {
        $first[] = $row;
    }
}

$rs7 = mysqli_query($conn, $sql7);
if($rs7) {
    while($row = mysqli_fetch_assoc($rs7)) {
        $first[] = $row;
    }
}

$rs8 = mysqli_query($conn, $sql8);
if($rs8) {
    while($row = mysqli_fetch_assoc($rs8)) {
        $first[] = $row;
    }
}

$rs9 = mysqli_query($conn, $sql9);
if($rs9) {
    while($row = mysqli_fetch_assoc($rs9)) {
        $first[] = $row;
    }
}

$rs10 = mysqli_query($conn, $sql10);
if($rs10) {
    while($row = mysqli_fetch_assoc($rs10)) {
        $first[] = $row;
    }
}

$rs11 = mysqli_query($conn, $sql11);
if($rs11) {
    while($row = mysqli_fetch_assoc($rs11)) {
        $first[] = $row;
    }
}

$rs12 = mysqli_query($conn, $sql12);
if($rs12) {
    while($row = mysqli_fetch_assoc($rs12)) {
        $first[] = $row;
    }
}

echo json_encode($first);
?>
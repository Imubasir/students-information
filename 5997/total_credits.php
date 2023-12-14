<?php
require_once("../Db/connection2.php");
$id = $_POST['id'];

$sql = "select levelid, trimester, sum(credits) as tt from conass where levelid = 1 and trimester=1 and indexno='$id'";
$sql2 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 1 and trimester=2 and indexno='$id'";
$sql3 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 1 and trimester=3 and indexno='$id'";

$sql4 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 2 and trimester=1 and indexno='$id'";
$sql5 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 2 and trimester=2 and indexno='$id'";
$sql6 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 2 and trimester=3 and indexno='$id'";

$sql7 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 3 and trimester=1 and indexno='$id'";
$sql8 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 3 and trimester=2 and indexno='$id'";
$sql9 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 3 and trimester=3 and indexno='$id'";

$sql10 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 4 and trimester=1 and indexno='$id'";
$sql11 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 4 and trimester=2 and indexno='$id'";
$sql12 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 4 and trimester=3 and indexno='$id'";

$sql13 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 5 and trimester=1 and indexno='$id'";
$sql14 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 5 and trimester=2 and indexno='$id'";
$sql15 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 5 and trimester=3 and indexno='$id'";

$sql16 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 6 and trimester=1 and indexno='$id'";
$sql17 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 6 and trimester=2 and indexno='$id'";
$sql18 = "select levelid, trimester, sum(credits) as tt from conass where levelid = 6 and trimester=3 and indexno='$id'";


$data = array();

$rs1 = mysqli_query($conn2, $sql);
if($rs1) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $data[] = $row;
    }
}

$rs2 = mysqli_query($conn2, $sql2);
if($rs2) {
    while($row = mysqli_fetch_assoc($rs2)) {
        $data[] = $row;
    }
}

$rs3 = mysqli_query($conn2, $sql3);
if($rs3) {
    while($row = mysqli_fetch_assoc($rs3)) {
        $data[] = $row;
    }
}

$rs4 = mysqli_query($conn2, $sql4);
if($rs4) {
    while($row = mysqli_fetch_assoc($rs4)) {
        $data[] = $row;
    }
}

$rs5 = mysqli_query($conn2, $sql5);
if($rs5) {
    while($row = mysqli_fetch_assoc($rs5)) {
        $data[] = $row;
    }
}

$rs6 = mysqli_query($conn2, $sql6);
if($rs6) {
    while($row = mysqli_fetch_assoc($rs6)) {
        $data[] = $row;
    }
}

$rs7 = mysqli_query($conn2, $sql7);
if($rs7) {
    while($row = mysqli_fetch_assoc($rs7)) {
        $data[] = $row;
    }
}

$rs8 = mysqli_query($conn2, $sql8);
if($rs8) {
    while($row = mysqli_fetch_assoc($rs8)) {
        $data[] = $row;
    }
}

$rs9 = mysqli_query($conn2, $sql9);
if($rs9) {
    while($row = mysqli_fetch_assoc($rs9)) {
        $data[] = $row;
    }
}

$rs10 = mysqli_query($conn2, $sql10);
if($rs10) {
    while($row = mysqli_fetch_assoc($rs10)) {
        $data[] = $row;
    }
}

$rs11 = mysqli_query($conn2, $sql11);
if($rs11) {
    while($row = mysqli_fetch_assoc($rs11)) {
        $data[] = $row;
    }
}

$rs12 = mysqli_query($conn2, $sql12);
if($rs12) {
    while($row = mysqli_fetch_assoc($rs12)) {
        $data[] = $row;
    }
}

$rs13 = mysqli_query($conn2, $sql13);
if($rs13) {
    while($row = mysqli_fetch_assoc($rs13)) {
        $data[] = $row;
    }
}

$rs14 = mysqli_query($conn2, $sql14);
if($rs14) {
    while($row = mysqli_fetch_assoc($rs14)) {
        $data[] = $row;
    }
}

$rs15 = mysqli_query($conn2, $sql15);
if($rs15) {
    while($row = mysqli_fetch_assoc($rs15)) {
        $data[] = $row;
    }
}

$rs16 = mysqli_query($conn2, $sql16);
if($rs16) {
    while($row = mysqli_fetch_assoc($rs16)) {
        $data[] = $row;
    }
}

$rs17 = mysqli_query($conn2, $sql17);
if($rs17) {
    while($row = mysqli_fetch_assoc($rs17)) {
        $data[] = $row;
    }
}

$rs18 = mysqli_query($conn2, $sql18);
if($rs18) {
    while($row = mysqli_fetch_assoc($rs18)) {
        $data[] = $row;
    }
}

echo json_encode($data);


?>
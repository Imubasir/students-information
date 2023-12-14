<?php
require_once ("../Db/connection.php");
$id = $_POST['id'];

//$sql_dip="select * from studentbiodata,programme,tbl_option where progid=sprogid and option_id=optionid and Sindexno='$id'";

$sql1 = "SELECT * FROM conass where indexno = '$id' and levelid = '1' and trimester = '1' and grade !='DF' order by levelid, trimester, coursecode1 ASC";
$sql2 = "SELECT * FROM conass where indexno = '$id' and levelid = 1 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql3 = "SELECT * FROM conass where indexno = '$id' and levelid = 1 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql4 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql5 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql6 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql7 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql8 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql9 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql10 = "SELECT * FROM conass where indexno = '$id' and levelid = 4 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql11 = "SELECT * FROM conass where indexno = '$id' and levelid = 4 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql12 = "SELECT * FROM conass where indexno = '$id' and levelid = 4 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql13 = "SELECT * FROM conass where indexno = '$id' and levelid = 5 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql14 = "SELECT * FROM conass where indexno = '$id' and levelid = 5 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql15 = "SELECT * FROM conass where indexno = '$id' and levelid = 5 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql16 = "SELECT * FROM conass where indexno = '$id' and levelid = 6 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql17 = "SELECT * FROM conass where indexno = '$id' and levelid = 6 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql18 = "SELECT * FROM conass where indexno = '$id' and levelid = 6 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql_dip = "SELECT * from studentbiodata, programme, tbl_option where progid=sprogid and option_id=optionid and Sindexno='$id'";

$first = array();

    $rs1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($rs1) > 0) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs2 = mysqli_query($conn, $sql2);
if($rs2) {
    while($row = mysqli_fetch_assoc($rs2)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs3 = mysqli_query($conn, $sql3);
if($rs3) {
    while($row = mysqli_fetch_assoc($rs3)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs4 = mysqli_query($conn, $sql4);
if($rs4) {
    while($row = mysqli_fetch_assoc($rs4)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs5 = mysqli_query($conn, $sql5);
if($rs5) {
    while($row = mysqli_fetch_assoc($rs5)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs6 = mysqli_query($conn, $sql6);
if($rs6) {
    while($row = mysqli_fetch_assoc($rs6)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs7 = mysqli_query($conn, $sql7);
if($rs7) {
    while($row = mysqli_fetch_assoc($rs7)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs8 = mysqli_query($conn, $sql8);
if($rs8) {
    while($row = mysqli_fetch_assoc($rs8)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs9 = mysqli_query($conn, $sql9);
if($rs9) {
    while($row = mysqli_fetch_assoc($rs9)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs10 = mysqli_query($conn, $sql10);
if($rs10) {
    while($row = mysqli_fetch_assoc($rs10)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs11 = mysqli_query($conn, $sql11);
if($rs11) {
    while($row = mysqli_fetch_assoc($rs11)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

$rs12 = mysqli_query($conn, $sql12);
if($rs12) {
    while($row = mysqli_fetch_assoc($rs12)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}
    
    $rs13 = mysqli_query($conn, $sql13);
if($rs13) {
    while($row = mysqli_fetch_assoc($rs13)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}
    $rs14 = mysqli_query($conn, $sql14);
if($rs14) {
    while($row = mysqli_fetch_assoc($rs14)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs15 = mysqli_query($conn, $sql15);
if($rs15) {
    while($row = mysqli_fetch_assoc($rs15)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs16 = mysqli_query($conn, $sql16);
if($rs16) {
    while($row = mysqli_fetch_assoc($rs16)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs17 = mysqli_query($conn, $sql17);
if($rs17) {
    while($row = mysqli_fetch_assoc($rs17)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs18 = mysqli_query($conn, $sql18);
if($rs18) {
    while($row = mysqli_fetch_assoc($rs18)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}


$rs19 = mysqli_query($conn, $sql_dip);
if($rs19) {
    while($row = mysqli_fetch_assoc($rs19)) {
        $first[] = $row;
    }
} else {
    echo $conn->error;
}

echo json_encode($first);
?>

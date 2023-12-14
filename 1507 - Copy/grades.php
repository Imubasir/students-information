<?php
require_once ("../Db/connection.php");
$id = $_POST['id'];

$sql1 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 1 and trimester = 1 and grade !='DF' order by coursecode1, session";
$sql2 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 1 and trimester = 2 and grade !='DF' order by coursecode1, session";
$sql3 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 1 and trimester = 3 and grade !='DF' order by coursecode1, session";

$sql4 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 2 and trimester = 1 and grade !='DF' order by coursecode1, session";
$sql5 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 2 and trimester = 2 and grade !='DF' order by coursecode1, session";
$sql6 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 2 and trimester = 3 and grade !='DF' order by coursecode1, session";

$sql7 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 3 and trimester = 1 and grade !='DF' order by coursecode1, session";
$sql8 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 3 and trimester = 2 and grade !='DF' order by coursecode1, session";
$sql9 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 3 and trimester = 3 and grade !='DF' order by coursecode1, session";

$sql10 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 4 and trimester = 1 and grade !='DF' order by coursecode1, session";
$sql11 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 4 and trimester = 2 and grade !='DF' order by coursecode1, session";
$sql12 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 4 and trimester = 3 and grade !='DF' order by coursecode1, session";

$sql13 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 5 and trimester = 1 and grade !='DF' order by coursecode1, session";
$sql14 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 5 and trimester = 2 and grade !='DF' order by coursecode1, session";
$sql15 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 5 and trimester = 3 and grade !='DF' order by coursecode1, session";

$sql16 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 6 and trimester = 1 and grade !='DF' order by coursecode1, session";
$sql17 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 6 and trimester = 2 and grade !='DF' order by coursecode1, session";
$sql18 = "SELECT * FROM conass, course where coursecode = coursecode1 and indexno = '$id' and levelid = 6 and trimester = 3 and grade !='DF' order by coursecode1, session";

$sql_dip = "SELECT * from studentbiodata, programme, tbl_option where progid=sprogid and option_id=optionid and indexno='$id'";
$overall = array();
$biodata = array();
$ff = array();
$fs = array();
$ft = array();

$sf = array();
$ss = array();
$st = array();

$tf = array();
$ts = array();
$tt = array();

$ftf = array();
$fts = array();
$ftt = array();

$fff = array();
$ffs = array();
$fft = array();

$stf = array();
$sts = array();
$stt = array();

    $rs1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($rs1) > 0) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $ff[] = $row;
    }
} else {
    echo $conn->error;
}

$rs2 = mysqli_query($conn, $sql2);
if($rs2) {
    while($row = mysqli_fetch_assoc($rs2)) {
        $fs[] = $row;
    }
} else {
    echo $conn->error;
}

$rs3 = mysqli_query($conn, $sql3);
if($rs3) {
    while($row = mysqli_fetch_assoc($rs3)) {
        $ft[] = $row;
    }
} else {
    echo $conn->error;
}

$rs4 = mysqli_query($conn, $sql4);
if($rs4) {
    while($row = mysqli_fetch_assoc($rs4)) {
        $sf[] = $row;
    }
} else {
    echo $conn->error;
}

$rs5 = mysqli_query($conn, $sql5);
if($rs5) {
    while($row = mysqli_fetch_assoc($rs5)) {
        $ss[] = $row;
    }
} else {
    echo $conn->error;
}

$rs6 = mysqli_query($conn, $sql6);
if($rs6) {
    while($row = mysqli_fetch_assoc($rs6)) {
        $st[] = $row;
    }
} else {
    echo $conn->error;
}

$rs7 = mysqli_query($conn, $sql7);
if($rs7) {
    while($row = mysqli_fetch_assoc($rs7)) {
        $tf[] = $row;
    }
} else {
    echo $conn->error;
}

$rs8 = mysqli_query($conn, $sql8);
if($rs8) {
    while($row = mysqli_fetch_assoc($rs8)) {
        $ts[] = $row;
    }
} else {
    echo $conn->error;
}

$rs9 = mysqli_query($conn, $sql9);
if($rs9) {
    while($row = mysqli_fetch_assoc($rs9)) {
        $tt[] = $row;
    }
} else {
    echo $conn->error;
}

$rs10 = mysqli_query($conn, $sql10);
if($rs10) {
    while($row = mysqli_fetch_assoc($rs10)) {
        $ftf[] = $row;
    }
} else {
    echo $conn->error;
}

$rs11 = mysqli_query($conn, $sql11);
if($rs11) {
    while($row = mysqli_fetch_assoc($rs11)) {
        $fts[] = $row;
    }
} else {
    echo $conn->error;
}

$rs12 = mysqli_query($conn, $sql12);
if($rs12) {
    while($row = mysqli_fetch_assoc($rs12)) {
        $ftt[] = $row;
    }
} else {
    echo $conn->error;
}
    
    $rs13 = mysqli_query($conn, $sql13);
if($rs13) {
    while($row = mysqli_fetch_assoc($rs13)) {
        $fff[] = $row;
    }
} else {
    echo $conn->error;
}
    $rs14 = mysqli_query($conn, $sql14);
if($rs14) {
    while($row = mysqli_fetch_assoc($rs14)) {
        $ffs[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs15 = mysqli_query($conn, $sql15);
if($rs15) {
    while($row = mysqli_fetch_assoc($rs15)) {
        $fft[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs16 = mysqli_query($conn, $sql16);
if($rs16) {
    while($row = mysqli_fetch_assoc($rs16)) {
        $stf[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs17 = mysqli_query($conn, $sql17);
if($rs17) {
    while($row = mysqli_fetch_assoc($rs17)) {
        $sts[] = $row;
    }
} else {
    echo $conn->error;
}

    $rs18 = mysqli_query($conn, $sql18);
if($rs18) {
    while($row = mysqli_fetch_assoc($rs18)) {
        $stt[] = $row;
    }
} else {
    echo $conn->error;
}


$rs19 = mysqli_query($conn, $sql_dip);
if($rs19) {
    while($row = mysqli_fetch_assoc($rs19)) {
        $biodata[] = $row;
    }
} else {
    echo $conn->error;
}

$overall['first_first'] = $ff;
$overall['first_second'] = $fs;
$overall['first_third'] = $ft;
$overall['second_first'] = $sf;
$overall['second_second'] = $ss;
$overall['second_third'] = $st;
$overall['third_first'] = $tf;
$overall['third_second'] = $ts;
$overall['third_third'] = $tt;
$overall['fourth_first'] = $ftf;
$overall['fourth_second'] = $fts;
$overall['fourth_third'] = $ftt;
$overall['fifth_first'] = $fff;
$overall['fifth_second'] = $ffs;
$overall['fifth_third'] = $fft;
$overall['sixth_first'] = $stf;
$overall['sixth_second'] = $sts;
$overall['sixth_third'] = $stt;
$overall['biodata'] = $biodata;

echo json_encode($overall);

?>

<?php
require_once ("../Db/connection2.php");
$id = $_POST['id'];

//$sql_dip="select * from studentbiodata,programme,tbl_option where progid=sprogid and option_id=optionid and indexno='$id'";

$sql1 = "SELECT * FROM conass where indexno = '$id' and levelid = '1' and trimester = '1' and grade !='DF' order by levelid, trimester, coursecode1 ASC";
$sql2 = "SELECT * FROM conass where indexno = '$id' and levelid = 1 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql3 = "SELECT * FROM conass where indexno = '$id' and levelid = 1 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql4 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql5 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql6 = "SELECT * FROM conass where indexno = '$id' and levelid = 2 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";

$sql7 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 1 and grade !='DF' order by levelid, trimester ASC";
$sql8 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 2 and grade !='DF' order by levelid, trimester ASC";
$sql9 = "SELECT * FROM conass where indexno = '$id' and levelid = 3 and trimester = 3 and grade !='DF' order by levelid, trimester ASC";


$sql_dip = "SELECT * from studentbiodata, programme, tbl_option where progid=sprogid and option_id=optionid and indexno='$id'";

$first = array();

    $rs1 = mysqli_query($conn2, $sql1);
if(mysqli_num_rows($rs1) > 0) {
    while($row = mysqli_fetch_assoc($rs1)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs2 = mysqli_query($conn2, $sql2);
if($rs2) {
    while($row = mysqli_fetch_assoc($rs2)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs3 = mysqli_query($conn2, $sql3);
if($rs3) {
    while($row = mysqli_fetch_assoc($rs3)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs4 = mysqli_query($conn2, $sql4);
if($rs4) {
    while($row = mysqli_fetch_assoc($rs4)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs5 = mysqli_query($conn2, $sql5);
if($rs5) {
    while($row = mysqli_fetch_assoc($rs5)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs6 = mysqli_query($conn2, $sql6);
if($rs6) {
    while($row = mysqli_fetch_assoc($rs6)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs7 = mysqli_query($conn2, $sql7);
if($rs7) {
    while($row = mysqli_fetch_assoc($rs7)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs8 = mysqli_query($conn2, $sql8);
if($rs8) {
    while($row = mysqli_fetch_assoc($rs8)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

$rs9 = mysqli_query($conn2, $sql9);
if($rs9) {
    while($row = mysqli_fetch_assoc($rs9)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

// $rs10 = mysqli_query($conn2, $sql10);
// if($rs10) {
//     while($row = mysqli_fetch_assoc($rs10)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }

// $rs11 = mysqli_query($conn2, $sql11);
// if($rs11) {
//     while($row = mysqli_fetch_assoc($rs11)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }

// $rs12 = mysqli_query($conn2, $sql12);
// if($rs12) {
//     while($row = mysqli_fetch_assoc($rs12)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }
    
//     $rs13 = mysqli_query($conn2, $sql13);
// if($rs13) {
//     while($row = mysqli_fetch_assoc($rs13)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }
//     $rs14 = mysqli_query($conn2, $sql14);
// if($rs14) {
//     while($row = mysqli_fetch_assoc($rs14)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }

//     $rs15 = mysqli_query($conn2, $sql15);
// if($rs15) {
//     while($row = mysqli_fetch_assoc($rs15)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }

//     $rs16 = mysqli_query($conn2, $sql16);
// if($rs16) {
//     while($row = mysqli_fetch_assoc($rs16)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }

//     $rs17 = mysqli_query($conn2, $sql17);
// if($rs17) {
//     while($row = mysqli_fetch_assoc($rs17)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }

//     $rs18 = mysqli_query($conn2, $sql18);
// if($rs18) {
//     while($row = mysqli_fetch_assoc($rs18)) {
//         $first[] = $row;
//     }
// } else {
//     echo $conn2->error;
// }


$rs19 = mysqli_query($conn2, $sql_dip);
if($rs19) {
    while($row = mysqli_fetch_assoc($rs19)) {
        $first[] = $row;
    }
} else {
    echo $conn2->error;
}

echo json_encode($first);
// print_r($first);
?>

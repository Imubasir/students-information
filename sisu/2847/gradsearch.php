<?php
require('../Db/connection.php');
require('../Db/connection2.php');

if(isset($_POST['grad_sid'])) {
    $sid = $_POST['grad_sid'];
} else {
    $sid = '';
}

if(isset($_POST['grad_category'])) {
     $grad_category = $_POST['grad_category'];
} else {
     $grad_category = '';
}

if(isset($_POST['grad_programme'])) {
    $prog = $_POST['grad_programme'];
} else {
    $prog = '';
}

if(isset($_POST['grad_graddate'])) {
    $graddate = $_POST['grad_graddate'];
} else {
    $graddate = '';
}


$data_ug = array();
if($grad_category != '' && $sid == '' && $prog == '' && $graddate == '') {
    if($grad_category == 'Undergraduate') {

$query = "SELECT * FROM tbl_graduate left join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno left join  programme  on studentbiodata.sprogid  = programme.progid";        
$result_ug = mysqli_query($conn, $query);

if($result_ug) {
    while($row_ug = mysqli_fetch_assoc($result_ug)) {
        $data_ug[] = $row_ug;
    }
} else {
    echo $conn->error;
}
echo json_encode($data_ug);

    } else if($grad_category == 'Postgraduate') {
        $query = "SELECT * FROM tbl_graduate left join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno left join  programme  on studentbiodata.sprogid  = programme.progid";        
$result_ = mysqli_query($conn2, $query);
$data = array();

if($result_) {
    while($row = mysqli_fetch_assoc($result_)) {
        $data[] = $row;
    }
} else {
    echo $conn2->error;
}

    echo json_encode($data);

    }
}

else if($grad_category == 'Undergraduate') {
    $query = '';

if($sid != '' && $prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if($prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
}
else if ($sid != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid'  and graddate = '$graddate' ";
} 
else if ($sid != '' && $prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' ";
}
else if ($graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where graddate = '$graddate' ";
} 
else if ($prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' ";
} 
else if ($sid != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' ";
}

    $result = mysqli_query($conn, $query);
$data = array();

if($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

echo json_encode($data);

} 

else if($grad_category == 'Postgraduate') {
    $query = '';

if($sid != '' && $prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if($prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
}
else if ($sid != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid'  and graddate = '$graddate' ";
} 
else if ($sid != '' && $prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' ";
}
else if ($graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where graddate = '$graddate' ";
} 
else if ($prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' ";
} 
else if ($sid != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' ";
}


    $result = mysqli_query($conn2, $query);
$data = array();

if($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo $conn2->error;
}

echo json_encode($data);

} else {
    $query = '';

if($sid != '' && $prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
} 
else if($prog != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' and graddate = '$graddate' ";
}
else if ($sid != '' && $graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid'  and graddate = '$graddate' ";
} 
else if ($sid != '' && $prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' and studentbiodata.sprogid = '$prog' ";
}
else if ($graddate != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where graddate = '$graddate' ";
} 
else if ($prog != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where studentbiodata.sprogid = '$prog' ";
} 
else if ($sid != '') {
    $query .= "SELECT * FROM tbl_graduate inner join studentbiodata on tbl_graduate.indexno = studentbiodata.indexno inner join  programme  on studentbiodata.sprogid  = programme.progid where tbl_graduate.indexno = '$sid' ";
}

    $result = mysqli_query($conn, $query);
    $result_ = mysqli_query($conn2, $query);
$data = array();

if($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo $conn->error;
}

if($result_) {
    while($row_ = mysqli_fetch_assoc($result)) {
        $data[] = $row_;
    }
} else {
    echo $conn->error;
}

echo json_encode($data);

}



?>
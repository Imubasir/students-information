<?php
require_once ('../Db/connection.php');

if(isset($_POST['loan_sid'])) {
    $sid = $_POST['loan_sid'];
} else {
    $sid = '';
}

if(isset($_POST['loan_name'])) {
    $name = $_POST['loan_name'];
} else {
     $name = '';
}

if(isset($_POST['loan_programme'])) {
    $prog = $_POST['loan_programme'];
} else {
    $prog = '';
}

if(isset($_POST['loan_acadYr'])) {
     $entryyear = $_POST['loan_acadYr'];
} else {
     $entryyear = '';
}


$sql = "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid";
$query = '';

if($sid != '' && $prog != '' &&  $entryyear != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (indexno = '$sid' OR uin = '$sid') and sprogid = '$prog' and entryyear = '$entryyear'";
} 
else if($prog != '' &&  $entryyear != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE sprogid = '$prog' and entryyear = '$entryyear' ";
}
else if ($sid != '' &&  $entryyear != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (indexno = '$sid' OR uin = '$sid') and entryyear = '$entryyear' ";
} 
else if ($sid != '' && $prog != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (indexno = '$sid' OR uin = '$sid') and sprogid = '$prog'";
} 
else if ( $entryyear != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE entryyear = '$entryyear'";
} 
else if ($prog != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE sprogid = '$prog' ";
}
else if ($sid != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE (indexno = '$sid' OR uin = '$sid')";
} 
else if ($name != '') {
    $query .= "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid WHERE surname = '$name' OR firstname = '$name' OR middlename = '$name'";
} 
 else {
    
}

$rs = mysqli_query($conn, $query);
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
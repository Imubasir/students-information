<?php
require( '../Db/connection.php' );
require( '../Db/connection2.php' );

$category = isset( $_POST['std_cat'] )? $_POST['std_cat']: '';
$stdNo = isset( $_POST['std_no'] )? $_POST['std_no'] : '';
$stdName = isset( $_POST['std_name'] )? $_POST['std_name'] : '';
$stdProg = isset( $_POST['std_prog'] )? $_POST['std_prog'] : '';
$stdGrad = isset( $_POST['std_grad'] )? $_POST['std_grad'] : '';
$data = array();

if ( $category != '' && $stdNo != '' && $stdName != '' && $stdProg != '' && $stdGrad != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE tbl_graduate.indexno = '$stdNo' and graddate = '$stdGrad'";
} else if ( $category != '' && $stdName != '' && $stdProg != '' && $stdGrad != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE (surname = '$stdName' || middlename = '$stdName' || firstname = '$stdName') and graddate = '$stdGrad'";
} else if ( $category != '' && $stdNo != '' && $stdProg != '' && $stdGrad != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE WHERE tbl_graduate.indexno = '$stdNO' and graddate = '$stdGrad'";
} else if ( $category != '' && $stdNo != '' && $stdName != '' && $stdGrad != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE tbl_graduate.indexno = '$stdNo' and graddate = '$stdGrad'";
} else if ( $category != '' && $stdNo != '' && $stdName != '' && $stdProg != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE tbl_graduate.indexno = '$stdNo'";
} else if ( $category != '' && $stdNo != '' && $stdName != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE tbl_graduate.indexno = '$stdNo' and (surname = '$stdName' || middlename = '$stdName' || firstname = '$stdName')";
} else if ( $category != '' && $stdProg != '' && $stdGrad != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE studentbiodata.sprogid = '$stdProg' and graddate = '$stdGrad'";
} else if ( $category != '' && $stdNo != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE tbl_graduate.indexno = '$stdNo'";
} else if ( $category != '' && $stdName != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE (surname = '$stdName' || middlename = '$stdName' || firstname = '$stdName')";
} else if ( $category != '' && $stdGrad != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE graddate = '$stdGrad'";
} else if ( $stdProg != '' ) {
    $query = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata ON tbl_graduate.indexno = studentbiodata.indexno LEFT JOIN programme ON studentbiodata.sprogid = programme.progid WHERE studentbiodata.sprogid = '$stdProg'";
} else {
    
}

if ( $category == 'undergraduate' ) {
    $result = mysqli_query( $conn, $query );
    while( $row = mysqli_fetch_assoc( $result ) ) {
        $data[] = $row;
    }
} else if ($category = 'postgraduate') {
    $result = mysqli_query($conn2, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
 }

echo json_encode($data);
?>

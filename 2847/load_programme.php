<?php
require( '../Db/connection.php' );
require( '../Db/connection2.php' );
$val = $_POST['value'];
$data = array();

$query = "Select * from programme order by progname ASC";
if ( $val == 'undergraduate' ) {
    $rs = mysqli_query( $conn, $query );
} else if ( $val == 'postgraduate' ) {
    $rs = mysqli_query( $conn2, $query );
}

while( $row = mysqli_fetch_assoc( $rs )) {
    $data[] = $row;
}

echo json_encode( $data );

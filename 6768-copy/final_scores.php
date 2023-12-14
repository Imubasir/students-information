<?php
require_once('../Db/connection.php');
$id = $_POST['id'];

$finals = "SELECT w, gp, credits from conass WHERE indexno = '$id'";
$final_result = mysqli_query($conn, $finals);

$first = array();
$total_credits = 0;
$total_gp = 0;
$total_w = 0;

if($final_result) {
	
    while($row = mysqli_fetch_assoc($final_result)) {
        $total_credits += $row['credits'];
        $total_w += $row['w'];
        $total_gp += $row['gp'];

    }

    $first['tc'] = $total_credits;
    $first['tw'] = $total_w;
    $first['tg'] = $total_gp;
}

echo json_encode($first);
?>
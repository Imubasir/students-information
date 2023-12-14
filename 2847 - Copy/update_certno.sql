$date_issued = date('d-M-Y H:i:s');
$sql = "UPDATE tbl_graduate SET issued = '1', certno = '$certno', issued_by = '$username', issued_date = '$date_issued' WHERE indexno = '$indexno'";

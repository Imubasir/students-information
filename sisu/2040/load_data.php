<?php
    require_once('../Db/connection.php');
    $sql = "SELECT indexno, trans_uin, `name`, assignedto, category, service_cat1, service_cat2, service_cat3, service_cat4, service_cat5, service_type, Req_No_Rem, action_date, first_name, middle_name, last_name, delivery_mode, delivery_addrss, trial_transcript.status, submitted_date FROM trial_transcript inner join tbl_schedule on trans_uin = trans_id inner join tbl_user_profile on assignedto = username order by submitted_date desc";
    $result = mysqli_query($conn, $sql);
    $data = array();

    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo $conn->error;
    }

echo json_encode($data);
?>
<?php
session_start();
require_once('../Db/connection.php');
require_once('../Db/connection2.php');

$username = $_SESSION['uname'];
$access=$_SESSION['access'];

$curl = curl_init();
$invoice = $_POST['invoice'];

curl_setopt_array($curl, array(
  CURLOPT_URL => 'ghapes.org/api/request/document/process',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('key' => 'UDS-GH'),
  CURLOPT_HTTPHEADER => array(
    'key: UDS-GH',
    'token: 5acc983aab5a146abbfd715de67bb12009e1c0ebba533e07c4e08be76fcd559d'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);
// print_r($data);
$today = date("Y-m-d");

for ($i=0; $i < count($data); $i++) { 
  // $check_inv = $data[$i]['invoice_no'];

  if ($invoice == $data[$i]['invoice_no']) {
    $time = $data[$i]['invoice_no'];
    $stud_id = $data[$i]['student_id'];
    $name = $data[$i]['name'];
    $service_data = $data[$i]['service'];
    $services = explode("-", $service_data);
    $service = $services[0];

    $il = "";
    $il_q = "";

    $visa = "";
    $visa_q = "";

    $ep = "";
    $ep_q = "";

    $trans = "";
    $trans_q = "";

    $cf = "";
    $cf_q = "";

    $trans = "";
    if(trim($service) == "TRANSCRIPT") {
      $trans = "Transcript";
      $trans_q = $data[$i]['qty'];
    }

    $ep = "";
    if (trim($service) == "ENGLISH PROFICIENCY") {
      $ep = "English Proficiency";
      $ep_q = $data[$i]['qty'];
    }

    $cf = "";
    if (trim($service) == "CONFIRMATORY LETTER") {
      $cf = "Confirmatory Letter";
      $cf_q = $data[$i]['qty'];
    }

    $il = "";
    if (trim($service) == "INTRODUCTORY LETTER") {
      $il = "Introductory Letter";
      $il_q = $data[$i]['qty'];
    }

    $req_type = $services[1];
    $category = check_category($stud_id);
    $request_date = $data[$i]['request_date'];
    $expected_date = $data[$i]['expected_date'];
    $req_del = $data[$i]['postal_service'];
    $req_del_addrs = $data[$i]['postal_address'];
    $email = $data[$i]['email'];
    $contact = $data[$i]['contact'];
    $country = isset($data[$i]['country']) ? $data[$i]['country'] : '';
    $request_len = 0;

    if($stud_id == '') {

    } else {

      $check = "SELECT * FROM trial_transcript WHERE trans_uin = '$invoice' and indexno = '$stud_id'";
      $check_rs = mysqli_query($conn, $check);

      if($check_rs->num_rows > 0) {
        if($category == 'Undergraduate') {
          $profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM studentbiodata LEFT JOIN programme on sprogid = programme.progid WHERE indexno = '$stud_id'";
          $rs_profile = mysqli_query($conn, $profile);
          if($rs_profile) {
            while($r = mysqli_fetch_assoc($rs_profile)) {
              $name = $r['name'];
              $progid = $r['sprogid'];
            }

            $sql = "UPDATE trial_transcript SET name='$name', programme='$progid', service_type='$req_type', service_cat1='$trans', quantity1='$trans_q', service_cat2='$ep', quantity2='$ep_q', service_cat3='$il', quantity3='$il_q', service_cat4='$cf', quantity4='$cf_q', service_cat5='$visa', quantity5='$visa_q', country='$country', delivery_mode='$req_del', delivery_addrss='$req_del_addrs', Req_No_Rem=Req_No_Rem+1, status='Being Processed', category='$category', email='$email', contact='$contact' WHERE trans_uin = '$invoice' and indexno = '$stud_id'";
            $rs = mysqli_query($conn, $sql);
          }

        } else if ($category == 'Postgraduate') {
          $profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM arms_pg.studentbiodata LEFT JOIN arms_pg.programme on sprogid = programme.progid WHERE indexno = '$stud_id'";
          $rs_profile = mysqli_query($conn2, $profile);
          if($rs_profile) {
            while($r = mysqli_fetch_assoc($rs_profile)) {
              $name = $r['name'];
              $progid = $r['sprogid'];
            }
            $sql = "UPDATE trial_transcript SET name='$name', programme='$progid', service_type='$req_type', service_cat1='$trans', quantity1='$trans_q', service_cat2='$ep', quantity2='$ep_q', service_cat3='$il', quantity3='$il_q', service_cat4='$cf', quantity4='$cf_q', service_cat5='$visa', quantity5='$visa_q', country='$country', delivery_mode='$req_del', delivery_addrss='$req_del_addrs', Req_No_Rem=Req_No_Rem+1, status='Being Processed', category='$category', email='$email', contact='$contact' WHERE trans_uin = '$invoice' and indexno = '$stud_id' ";
            $rs = mysqli_query($conn, $sql);
          }
        }

      } else {

        $code = rand(10000000, 100000000);
        if ($category == 'Undergraduate') {
          $profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM studentbiodata LEFT JOIN programme on sprogid = programme.progid WHERE indexno = '$stud_id'";
          $rs_profile = mysqli_query($conn, $profile);
          if($rs_profile) {
            while($r = mysqli_fetch_assoc($rs_profile)) {
              $name = $r['name'];
              $progid = $r['sprogid'];
            }

            $sql = "INSERT INTO trial_transcript (trans_uin, indexno, name, programme, email, contact, service_type, service_cat1, quantity1, service_cat2, quantity2, service_cat3, quantity3, service_cat4, quantity4, service_cat5, quantity5, country, delivery_mode, delivery_addrss, expected_date, Req_No_Rem, status, category, verify_code) values ('$time', '$stud_id', '$name', '$progid', '$email', '$contact', '$req_type', '$trans', '$trans_q', '$ep', '$ep_q', '$il', '$il_q', '$cf', '$cf_q', '$visa', '$visa_q', '$country', '$req_del', '$req_del_addrs', '$expected_date', '$request_len'+1, 'Being Processed', '$category', '$code')";
            var_dump($sql);

            $rs = mysqli_query($conn, $sql);
            if($rs) {
              $sql_assign="SELECT DISTINCT username from tbl_user_profile where status='1' and not exists (SELECT assignedto from tbl_schedule where username=assignedto and date_added='$today')";
              $rs_assign=mysqli_query($conn, $sql_assign);
              if(mysqli_num_rows($rs_assign)<=0){
                $sql="SELECT count(assignedto) as num, assignedto from tbl_schedule where date_added='$today' group by assignedto order by num DESC";
                $results = mysqli_query($conn, $sql);
                if($results) {
                  while($row1 = mysqli_fetch_assoc($results)) {
                    $assign=$row1['assignedto'];
                  }
                }
              }else{
                while($row2=mysqli_fetch_assoc($rs_assign)) {
                  $assign=$row2['username'];
                }
              }
              $sql_add="INSERT INTO tbl_schedule(date_added, added_by, assignedto, action_date, remark, indexnum, cat, trans_id) values('$today', '$username', '$assign','$today', 'Being processed','$stud_id', '$category', '$time')";
              $rs_add = mysqli_query($conn, $sql_add);
              if($rs_add) {
                $event = "New Request Added. Transaction ID: ".$time;
                $log_insert = "INSERT INTO `tbl_log` (`event`, `username`, `access_lvl`) values ('$event', '$username', '$access')";
                $log_rs = mysqli_query($conn, $log_insert);
                if($log_rs) {
                  echo 1;
                } else {
                  echo $conn->error;
                }
              } else {
                echo $conn->error;
              }
            } else {
              echo $conn->error;
            }
          } else {
            echo $conn->error;
          }
        } else if($category == 'Postgraduate') {
          $profile = "SELECT DISTINCT CONCAT_WS(' ', firstname, middlename, surname) AS name, sprogid FROM arms_pg.studentbiodata LEFT JOIN arms_pg.programme on sprogid = programme.progid WHERE indexno = '$stud_id'";
          $rs_profile = mysqli_query($conn2, $profile);
          if($rs_profile) {
            while($r = mysqli_fetch_assoc($rs_profile)) {
              $name = $r['name'];
              $progid = $r['sprogid'];
            }
      // $time = time();
            $sql = "INSERT INTO trial_transcript (trans_uin, indexno, `name`, programme, email, contact, service_type, service_cat1, quantity1, service_cat2, quantity2, service_cat3, quantity3, service_cat4, quantity4, service_cat5, quantity5, country, delivery_mode, delivery_addrss, expected_date, Req_No_Rem, status, category, verify_code) values ('$time', '$stud_id', '$name', '$progid', '$email', '$contact', '$req_type', '$trans', '$trans_q', '$ep', '$ep_q', '$il', '$il_q', '$cf', '$cf_q', '$visa', '$visa_q', '$country', '$req_del', '$req_del_addrs', '$expected_date', '$request_len'+1, 'Being Processed', '$category', '$code')";
            $rs = mysqli_query($conn, $sql);
            if($rs) {
              $sql_assign="SELECT DISTINCT username from tbl_user_profile where status='1' and not exists (SELECT assignedto from tbl_schedule where username=assignedto and date_added='$today')";
              $rs_assign=mysqli_query($conn, $sql_assign);
              if(mysqli_num_rows($rs_assign)<=0){
                $sql="SELECT count(assignedto) as num, assignedto from tbl_schedule where date_added='$today' group by assignedto order by num DESC";
                $results = mysqli_query($conn, $sql);
                if($results) {
                  while($row1 = mysqli_fetch_assoc($results)) {
                    $assign=$row1['assignedto'];
                  }
                }

              }else{
                while($row2=mysqli_fetch_assoc($rs_assign)) {
                  $assign=$row2['username'];
                }

              }
              $sql_add="INSERT INTO tbl_schedule(date_added, added_by, assignedto, action_date, remark, indexnum, cat, trans_id) values('$today', '$username', '$assign', '$today', 'Being processed','$stud_id', '$category', '$time')";
              $rs_add = mysqli_query($conn, $sql_add);
              if($rs_add) {
                $event = "New Request Added. Transaction ID: ".$time;
                $log_insert = "INSERT INTO `tbl_log` (`event`, `username`, `access_lvl`) values ('$event', '$username', '$access')";
                $log_rs = mysqli_query($conn, $log_insert);
                if($log_rs) {
                  echo 1;
                } else {
                  echo $conn->error;
                }
              } else {
                echo $conn->error;
              }

            } else {
              echo $conn->error;
            }
          }
        }

      }

    }

  } else {
    continue;
  }

}
// End of for loop


function check_category ($stud_id) {
  $start = substr($stud_id, 0, 3);

  if($start == "UDS") {
    return 'Postgraduate';
  } else {
    return 'Undergraduate';
  }
}

?>
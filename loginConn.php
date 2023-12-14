<?php
session_start();
require_once("Db/connection.php");
 $_SESSION['username'] = $_POST['username'];
 $_SESSION['access'] = $_POST['access'];
  
 $username=$_SESSION['username'];
 $pass= md5($_POST['pass']);
 $access=$_SESSION['access'];

$query =$conn->prepare("SELECT * from tbl_login left join tbl_user_dept on tbl_login.access_lvl = tbl_user_dept.dept_id left join tbl_user_profile on tbl_user_profile.username = tbl_login.username where tbl_login.username = ? and tbl_login.password = ? and tbl_user_dept.dept_id= ? ");

$query->bind_param("sss", $username, $pass, $access);
  $r = $query->execute();
  $result = $query->get_result();
 if($result->num_rows == 1){

    $now = date("Y-m-d H:i:s");
    
    $activity = $username." logged in";
     
     $action = $now. "\t". $activity. "\t". $username. "\r\n";
    
     
    $sql1 = "INSERT INTO tbl_log (event, username, access_lvl) values ('$activity', '$username', '$access')";
    $sql2 = "UPDATE tbl_login SET is_active= '1', last_logged_in = '$now' where username = '$username' ";

    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);

  if($result1 == TRUE && $result2 == TRUE){
  	 while($row = mysqli_fetch_assoc($result)){
          $_SESSION['uname'] = $row['username'];
          $_SESSION['FNAME']=$row['first_name'];
    	    $_SESSION['LNAME']=$row['last_name'];
    	    $_SESSION['sid'] = $row['staff_ID'];
          $_SESSION['dept'] = $row['dept_descr'];
          $_SESSION['picture'] = $row['picture'];

	      $_SESSION['timeout'] = time();
        
	      echo 1;
        }
         }
  
  }else if ($result->num_rows == 0){
  	echo 0;
  }else{
  	echo "Error: ".$conn->error;
  }
?>
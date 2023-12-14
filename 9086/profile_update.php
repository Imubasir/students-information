<?php 
session_start();
require('../Db/connection.php');

	  $user = $_SESSION['uname'];
      $email=$_POST['email']; 
      $password= md5($_POST['pass']);
      $access = $_SESSION['access'];
    
      $activity = $user."Profile Edited";

      if($_FILES['file']){
      $target_dir = "../uploads/";
      $target_file = $target_dir.basename($_FILES['file']['name']);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $extension_arr = array("jpg", "png", "gif");
          
      if(in_array($imageFileType, $extension_arr)) {
          
      move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$target_file);
          
      $sql = "UPDATE tbl_user_profile set picture = '$target_file' where username = '$user' ";
      $sql2 = "UPDATE tbl_login set password = '$password' where username = '$user' ";
      $sql3 = "INSERT INTO tbl_log(event, username, access_lvl) values ('$activity', '$user', '$access')";
          
      $result = mysqli_query($conn, $sql);
      if($result) {
        $result2 = mysqli_query($conn, $sql2);
          if($result2) {
            $result3 = mysqli_query($conn, $sql3);
              if($result3) {
                     $now = date("Y-m-d H:i:s");     
                     $action = $now. "\t". $activity. "\t". $user. "\r\n";

                      if(file_exists('../soms_log.txt')) {
                        file_put_contents('../soms_log.txt', $action, FILE_APPEND);
                      }

                      $_SESSION['picture'] = $target_file;
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
      $sql2 = "UPDATE tbl_login set password = '$password' where username = '$user' ";
      $sql3 = "INSERT INTO tbl_log(event, username, access_lvl) values ('$activity', '$user', '$access')";
          
        $result2 = mysqli_query($conn, $sql2);
          if($result2) {
            $result3 = mysqli_query($conn, $sql3);
              if($result3) {
                     $now = date("Y-m-d H:i:s");     
                     $action = $now. "\t". $activity. "\t". $user. "\r\n";

                      if(file_exists('../soms_log.txt')) {
                        file_put_contents('../soms_log.txt', $action, FILE_APPEND);
                      }

                      $_SESSION['picture'] = $target_file;
                         echo 1;
              } else {
                  echo $conn->error;
              }
          } else {
                  echo $conn->error;
              }
          
      }

      }else{
            echo "Image Not Set";
      }






 ?>

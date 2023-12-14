<?php
session_start();
require_once('../Db/connection.php');

$fname = $_POST['f_name'];
$mname = $_POST['m_name'];
$lname = $_POST['l_name'];
$sid = $_POST['s_id'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$title = $_POST['title'];
$dept = $_POST['dept'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$status = $_POST['status'];
$user = $_SESSION['uname'];
$username = $fname.strtoupper(substr($lname, 2)).rand(100, 1000);
$passDefault = md5("12345678");

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$path = '../uploads/';

if($_FILES['image']) {
    $img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

// can upload same image using rand function
$final_image = rand(1000,1000000).$img;

// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
 
if(move_uploaded_file($tmp,$path)) 
{
    $sql = "INSERT INTO tbl_user_profile (staff_ID, first_name, middle_name, last_name, dob, title, email, gender, phone, picture, department, username, `status`, added_by) values ('$sid', '$fname', '$mname', '$lname', '$dob', '$title', '$email', '$gender', '$phone', '$path', '$dept', '$username', '$status', '$user')";
    
    $rs = mysqli_query($conn, $sql);
    if($rs) {
        $insert = "INSERT INTO tbl_login(staff_ID, access_lvl, username, pass_status, `password`, added_by) VALUES ('$sid', '$dept',  '$username', '0', '$passDefault', '$user') ";
        
        $insert_rs = mysqli_query($conn, $insert);
        if($insert_rs) {
            echo 1;
        } else {
            echo $conn->error;
        }
    } else{
        echo $conn->error;
    } 
        
    
} else {
    echo "Image Not Moved";
    }
} else {
    $sql = "INSERT INTO tbl_user_profile (staff_ID, first_name, middle_name, last_name, dob, title, email, gender, phone, department, username, `status`, added_by) values ('$sid', '$fname', '$mname', '$lname', '$dob', '$title', '$email', '$gender', '$phone', '$dept', '$username', '$status', '$user')";
    
    $rs = mysqli_query($conn, $sql);
    if($rs) {
        $insert = "INSERT INTO tbl_login (staff_ID, access_lvl, username, pass_status, `password`, added_by) VALUES ('$sid', '$dept',  '$username', '0', '$passDefault', '$user') ";

        $insert_rs = mysqli_query($conn, $insert);

        if($insert_rs) {
            echo 1;
        } else {
            echo $conn->error;
        }
    } else{
        echo $conn->error;
    } 
}
}
?>
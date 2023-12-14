<?php 
session_start();
session_start();
require_once('../Db/connection.php');
 $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
 $path = '../uploads/'; // upload directory

        $fname = $_POST['e_f_name'];
        $mname = $_POST['e_m_name'];
        $lname = $_POST['e_l_name'];
        $sid = $_POST['e_s_id'];
        $dob = $_POST['e_dob'];
        $gender = $_POST['e_gender'];
        $title = $_POST['e_title'];
        $dept = $_POST['e_dept'];
        $email = $_POST['e_email'];
        $phone = $_POST['e_phone'];
        $status = $_POST['e_status'];
        $key = $_POST['key'];

        $user = $_SESSION['uname'];
        $today = date('Y-m-d H:i:s');


if($_FILES['e_image']) {
    $img = $_FILES['e_image']['name'];
    $tmp = $_FILES['e_image']['tmp_name'];
    
     $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;

    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 
    $path = $path.strtolower($final_image); 

    if(move_uploaded_file($tmp,$path)) 
    { 
        

        $sql = "UPDATE tbl_user_profile SET first_name = '$fname', middle_name= '$mname', last_name = '$lname', staff_ID = '$sid', dob = '$dob', gender = '$gender', title= '$title', department = '$dept', email = '$email', `status`='$status', picture = '$path', phone = '$phone', modified_by='$user', date_modified='$today' where username = '$key' ";

        $rs = mysqli_query($conn, $sql);
        if($rs) {
            echo 1;
        } else {
            echo $conn->error;
        }
    }
   } else {

        $sql = "UPDATE tbl_user_profile SET first_name = '$fname', middle_name= '$mname', last_name = '$lname', staff_ID = '$sid', dob = '$dob', gender = '$gender', title= '$title', department = '$dept', email = '$email', `status`='$status', phone = '$phone', modified_by='$user', date_modified='$today' where username = '$key'";

        $rs = mysqli_query($conn, $sql);
        if($rs) {
            echo 1;
        } else {
            echo $conn->error;
        }
   }
}
?>

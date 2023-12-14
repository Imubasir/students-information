 <?php
require('../Db/connection.php');
$user = $_POST['id'];

$sql = "SELECT * FROM tbl_pages WHERE username = '$user' and fpage = 7";
$result = mysqli_query($conn, $sql);

if($result->num_rows>0){
	echo 1;
}else{
	echo 0;
}
?>
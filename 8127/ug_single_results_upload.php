<?php
session_start();
require("../Db/connection.php");
$indexno = $_POST['indexno'];
$course = $_POST['course'];
$course_title = $_POST['course_title'];
$mark = $_POST['mark'];
$grade = $_POST['grade'];
$credits = $_POST['credit'];
$level = $_POST['level'];
$trimester = $_POST['trimester'];
$session = $_POST['academic_yr'];
$user = $_SESSION['uname'];

if ($grade=="A+"){
	    $gp=5*($credits);
	}elseif ($grade=="A") {
	    $gp=4.5*($credits);
	}elseif ($grade=="B+"){
	    $gp=4*($credits);
	}elseif ($grade=="B"){
	    $gp=3.5*($credits);
	}elseif ($grade=="C+"){
	    $gp=3*($credits);
	}elseif ($grade=="C"){
	    $gp=2.5*($credits);
	}elseif ($grade=="D+"){
	    $gp=2*($credits);
	}elseif ($grade=="D"){
	    $gp=1.5*($credits);
	}else {
	    $gp=0*($credits);
	}

	$w=($credits)*($mark);

	$sql_course="select * from course where coursecode='$course'";
    $rscourse=mysqli_query($conn, $sql_course);
    
    if ($rscourse->num_rows<=0) {
		$updatecourse="INSERT INTO course(coursecode, coursetitle, credit, added_by) VALUES ('$course', '$course_title', '$credits', '$user')";
		$rep=mysqli_query($conn, $updatecourse);
	}

	$sql_insert = "INSERT INTO conass (indexno, levelid, trimester, session, coursecode1, credits, mark, grade, w, gp, course_title, added_by) values ('$indexno', '$level', '$trimester', '$session', '$course', '$credits', '$mark', '$grade', '$w', '$gp', '$course_title', '$user')";

	$sql_rs = mysqli_query($conn, $sql_insert);
	if($sql_rs) {

		$event = "New Course Uploaded for: Student ID:".$indexno." CourseCode: ".$course;
		$user = $_SESSION['uname'];
		$access = $_SESSION['dept'];
		
		$sql_log = "INSERT INTO tbl_log(event, username, access_lvl) VALUES ('$event', '$user', '$access')";

		$rs = mysqli_query($conn, $sql_log);
		if($rs) {
			echo 1;
		} else {
			echo $conn->error;
		}
	} else {
		echo $conn->error;
	}
?>
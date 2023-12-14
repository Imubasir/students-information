<?php
	include('../Db/connection.php');
	//Passed Request information...
	$variable = $_POST['index'];

	$sql_assign="select distinct username from user where status='t' and not exists (select assignedto from tbl_schedule where username=assignedto and date_added='$today')";
	$rs_assign=mysql_query($sql_assign) or die(mysql_error());

	if(mysql_num_rows($rs_assign)<=0){
		$sql="select count(assignedto) as num, assignedto from tbl_schedule where date_added='$today' group by assignedto order by num asc";
		$results = mysql_query($sql) or die(mysql_error());
		$row1=mysql_fetch_assoc($results);
		$assign=$row1['assignedto'];
	}else{
		$row2=mysql_fetch_assoc($rs_assign);
		$assign=$row2['username'];
		//echo $assign;
	}

	
		$sql_add="INSERT INTO tbl_schedule(date_added,time_added,added_by,assignedto,action_date,remark,indexnum,cat,cpy) values('$today','$now','$username', '$assign','$today','Being processed','$indexnum','$cat','$copies')";
		if (!mysql_query($sql_add)){
			mysql_error();
			exit;
			}else{
				$event="Transcript request with index numbder ".$indexnum." for ".$copies." copy(ies)";
			$log="insert into log(event,tdate,ttime,username) values('$event','$today','$now','$username')";
			$rslog=mysql_query($log) or die(mysql_error());
			echo "<META HTTP-EQUIV=\"refresh\" content=\"0; URL=./\"> ";	
			echo "<script> alert('Request sent successfully')</script>";
			exit;
			} 
?>
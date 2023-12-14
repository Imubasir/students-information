<?php
require_once('../Db/connection.php');
require_once('../Db/connection2.php');
$id = $_POST['id'];

$sql = "SELECT surname, middlename, firstname, studentbiodata.indexno, gender, dob, sprogid, option_id, pic_id, progname, gradclass, graddate, optionid, option_title FROM arms_pg.studentbiodata LEFT JOIN arms_pg.programme on arms_pg.studentbiodata.sprogid = programme.progid LEFT JOIN tbl_graduate on arms_pg.studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN tbl_option on arms_pg.studentbiodata.option_id = tbl_option.optionid WHERE studentbiodata.indexno = '$id'";
$rs = mysqli_query($conn2, $sql);
$data = array();

if($rs) {
    while($row = mysqli_fetch_assoc($rs)) {
        $name = $row['firstname'].' '.$row['middlename'].' '.$row['surname'];
        $indexno = $row['indexno'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $progname = $row['progname'];
        $major = $row['option_title'];
        $class = $row['gradclass'];
        $data['graddate'] = $row['graddate'];

        $data['gradclass'] = $class;

        $ex=explode(" ",trim($progname));
        if($ex[0] == "MASTER") {
            $size=sizeof($ex);
            $idm ='';
            for($i=2;$i<$size;$i++) {
                $idm=$idm." ".trim($ex[$i]);
            }
            if ($major=="NONE"){
                $major1="( ".$idm." )";
            }else{
                //$major1=$idm." ( ".$major." )";
                $major1=" ( ".$major." )";
                //echo $ex[0]." (".$idm." )"
            }
        } else {
            $size=sizeof($ex);
            $idm ='';
            for($i=1;$i<$size;$i++) {
                $idm=$idm." ".trim($ex[$i]);
            }
            if ($major=="NONE"){
                $major1="( ".$idm." )";
            }else{
                //$major1=$idm." ( ".$major." )";
                $major1=" ( ".$major." )";
                //echo $ex[0]." (".$idm." )"
            }
        }

        $data['name'] = $name;
        $data['index'] = $indexno;
        $data['sex'] = $gender;
        $data['dob'] = $dob;
        $data['prog'] = $ex[0]." (".$idm." )";
        // $data['major'] = $major1;
        
    }
}
echo json_encode($data);
?>
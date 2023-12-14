<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";

require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '7' ";
$result = mysqli_query($conn, $sql);
if($result->num_rows>0){
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title."Undergraduate Enrollment" ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!--PNotify-->
    <link href="../vendor/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendor/pnotify/dist/pnotify.buttons.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="view.css" rel="stylesheet" type="text/css">

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styling plus plugins -->

    <style type="text/css">
        .detail_row {
            cursor: pointer;
        }
        .act_label {
            font-size: 15px;
            font-weight: bold;
        }
        .act_data {
            font-size: 15px;
            font-weight: bold;
            color: darkgreen;
            padding-right: 5px;
        }
        #act_table {
            border-collapse: separate;
            border-spacing: 4px;
        }
    </style>
</head>


<body id="page-top">


    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="../1753"><img src="../images/favicon.png" width="30px" height="30px"> UIMIS </a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <span id="tcount" class="badge badge-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                    <div id="taskBox">
                        <a class="dropdown-item" href="#">No Tasks to show</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../5798">View All Tasks</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span id="mcount" class="badge badge-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <div id="messageBox">
                        <a class="dropdown-item" href="#">No Notifications to show</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../3062">View All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../7673">Settings</a>
                    <a class="dropdown-item" href="../8015">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">

            <div class="card-header user-header alt bg-dark">
                <div class="media">

                    <div class="media-body">
                        <img class="align-self-center rounded-circle mr-3" src="<?php echo $_SESSION['picture'] ?>" onerror='if(this.src != "../images/avatar.png") this.src = "../images/avatar.png" ' width="70px" height="70px">
                        <h4 class="text-light display-6"><?php echo $_SESSION['FNAME']." ".$_SESSION['LNAME']; ?></h4>
                        <p><?php echo $_SESSION['dept'] ?></p>
                    </div>
                </div>
            </div>
            <br />

            <h3 style="padding-left: 15px;color: #fff;text-transform: uppercase;letter-spacing: .5px;font-weight: 700;font-size: 11px;margin-bottom: 0;margin-top: 0;text-shadow: 1px 1px #000;">GENERAL</h3>

            <!--Dashboard-->
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="home_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="dashboard_tab" class="dropdown-item" href="../1753/"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>

            <a id="profile_tab" class="dropdown-item" href="../5503"><i class="fas fa-fw fa-user"></i> Profile</a>

            <a id="inbox_tab" class="dropdown-item" href="../3062"><i class="fas fa-fw fa-envelope"></i> Inbox</a>

            <a id="notification_tab" class="dropdown-item" href="../2365"><i class="far fa-bell"></i> Notification</a>                                   
          </div>
        </li>           
           <!--End of Dashboard-->

           <!--Undergraduate-->
           <li class="nav-item dropdown active keep-open">
          <a class="nav-link dropdown-toggle index" href="#" id="undergraduate_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i>
            <span>Undergraduate</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="certification_tab" class="dropdown-item" href="../5525"> Certification</a>

            <a id="ug_course_tab" class="dropdown-item" href="../6693"> Courses</a>

            <a id="ug_enrollment_tab" class="dropdown-item active" href="../5065"> Enrollments</a>

            <a id="ug_programme_tab" class="dropdown-item" href="../9734"> Programmes</a>

            <a id="ug_result_tab" class="dropdown-item" href="../1507"> Results</a>                                
          </div>
        </li>
           <!--End of Undergraduate-->

           <!--Postgraduate-->
           <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="postgraduate_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-graduate"></i>
            <span>Postgraduate</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <!-- <a class="dropdown-item" href="../1326"> Certification</a> -->

            <a id="pg_course_tab" class="dropdown-item" href="../3394"> Courses</a>

            <a id="pg_enrollment_tab" class="dropdown-item" href="../3655"> Enrollments</a>

            <a id="pg_programme_tab" class="dropdown-item" href="../7738"> Programmes</a>

            <a id="pg_result_tab" class="dropdown-item" href="../5997"> Results</a>                                
          </div>
        </li>
           <!--End of Postgraduate-->

           <!--Transcript-->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="services_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-archive"></i>
            <span>Services</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="ug_services_tab" class="dropdown-item" href="../6768">UG Services</a>

            <a id="pg_services_tab" class="dropdown-item" href="../7473">PG Services</a>

            <a id="certificate_tab" class="dropdown-item" href="../2847">Certificate</a>

            <a id="signatory_tab" class="dropdown-item" href="../3685">Signatory</a>

            <a id="task_tab" class="dropdown-item" href="../5798">Task Scheduler</a>

            <a id="request_tab" class="dropdown-item" href="../2040">Request</a>                                   
          </div>
        </li>
        <!--End of Transcript-->

        <!--Analytics-->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="analytics_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-chart-line"></i>
            <span>Analytics</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="general_tab" class="dropdown-item" href="../8324">General</a>

            <a id="ncte_tab" class="dropdown-item" href="../5026">NCTE</a>
          </div>
        </li>
        <!--End of Analytics-->

        <!--Settings-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="settings_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Settings</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="campus_tab" class="dropdown-item" href="../7673"><i class="far fa-building"></i> Campus</a>

            <a id="course_tab" class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

            <a id="department_tab" class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>
            
            <a id="programme_tab" class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>
            
            <a id="upload_tab" class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

            <a id="edit_tab" class="dropdown-item" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

            <a id="users_tab" class="dropdown-item" href="../1242"><i class="fas fa-user-plus"></i> Users</a>

            <a id="log_tab" class="dropdown-item" href="../8015"><i class="fas fa-fw fa-clock"></i > Log</a>
          </div>
        </li>

        </ul>

        <!-- End of Sidebar-->


        <div id="content-wrapper">
            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <!-- /.container-fluid -->
                <div class="card mb-3 animated fadeInRight">
                    <div class="card-header">
                        <span  style="float:right;"><button class="btn btn-sm btn-success" onclick="enrolSearch()">Custom Search</button></span>
                        <i class=""></i>Undergraduate Enrollment
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="enrollTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>UIN</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Faculty</th>
                                        <th>Campus</th>
                                        <th>Entry Year</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: uppercase;" id="enrollBody">
                                    <?php
                                    // require_once('../Db/connection.php');
                                    $dat = date('Y');
                                    $sql = "SELECT * FROM studentbiodata LEFT JOIN programme ON sprogid = progid  LEFT JOIN faculty ON facid = faculty.facultyid LEFT JOIN tbl_campus ON fcampus_id = tbl_campus.campus_id WHERE entryyear = '$dat' ORDER BY entryyear";

                                    $rs = mysqli_query($conn, $sql);
                                    if($rs) {
                                        $count = 0;
                                        while($row = mysqli_fetch_assoc($rs)) {
                                            $count++;
                                            ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['uin'] ?></td>
                                        <td><?php echo $row['indexno'] ?></td>
                                        <td onclick = "view_details('<?php echo $row['uin'] ?>')" class="detail_row" data-toggle = 'tooltip' title='Click to View More'><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['surname'] ?></td>
                                        <td><?php echo $row['progname'] ?></td>
                                        <td><?php echo $row['facultyname'] ?></td>
                                        <td><?php echo $row['campus_descr'] ?></td>
                                        <td><?php echo $row['entryyear'] ?></td>
                                        <?php 
                                            if($row['firstname'] == '' || $row['surname'] == '') {
                                                ?>
                                                <td><button class="btn btn-success btn-sm" onclick="refresh('<?php echo $row['uin'] ?>')">Refresh</button></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td></td>
                                                <?php
                                            }
                                        ?>
                                        
                                        
                                    </tr>

                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- <div id="load_1" style="text-align: center;">
                            <img src='../images/Cube.gif' width="100px" height="100px">
                        </div> -->
                    </div>
                </div>


                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span id="footerDate"></span>
                        </div>
                    </div>
                </footer>


            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button onclick="logout()" class="btn btn-primary">Logout</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Modal-->
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Student Biodata</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="printable">
                        <div style="text-align:center;">
                            <h3>UNIVERSITY FOR DEVELOPMENT STUDIES</h3>
                            <h4>Student Profile</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-9">
                                <table class="table_profile">
                                    <tr>
                                        <td style="width: 20%">
                                            <label>UIN:</label>
                                        </td>
                                        <td style="width: 25%">
                                            <span id="uin"></span>
                                        </td>
                                        <td style="width: 20%">
                                            <label>Gender:</label>
                                        </td>
                                        <td style="width: 25%">
                                            <span id="gender"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Student ID:</label>
                                        </td>
                                        <td>
                                            <span id="stud_id"></span>
                                        </td>
                                        <td>
                                            <label>Nationality:</label>
                                        </td>
                                        <td>
                                            <span id="country"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Student Name:</label>
                                        </td>
                                        <td>
                                            <span id="stud_name"></span>
                                        </td>
                                        <td>
                                            <label>Qualification Status:</label>
                                        </td>
                                        <td>
                                            <span id="qualification"></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Date of Birth:</label>
                                        </td>
                                        <td>
                                            <span id="dob"></span>
                                        </td>
                                        <td>
                                            <label>Study Status:</label>
                                        </td>
                                        <td>
                                            <span id="study_status"></span>
                                        </td>
                                    </tr>

                                    
                                </table>
                            </div>
                            <div class="col-3">
                                <img id="profile_pic" src="../images/avatar.png" width="150px" height="150px">
                            </div>

                        </div>
                        
                        <div style="text-align:center;padding: 20px;">
                            <h5 class="one">Personal Profile</h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table_profile">
                                    <tr>
                                        <td style="width: 20%"><label>Place of Birth:</label></td>
                                        <td style="width: 25%"><span id="pob"></span></td>
                                        <td style="width: 20%"><label>Region of Birth:</label></td>
                                        <td style="width: 25%"><span id="rob"></span></td>
                                    </tr>
                                    <tr>
                                        <td><label>Home Town:</label></td>
                                        <td><span id="htown"></span></td>
                                        <td><label>Home Address:</label></td>
                                        <td><span id="hme_addrs"></span></td>
                                    </tr>
                                    <tr>
                                        <td><label>Disability Status:</label></td>
                                        <td><span id="dis_status"></span></td>
                                        <td><label>Disability Description:</label></td>
                                        <td><span id="dis_descr"></span></td>
                                    </tr>
                                    <tr>
                                        <td><label>Guardian Name:</label></td>
                                        <td><span id="gurd_name"></span></td>
                                        <td><label>Contact:</label></td>
                                        <td><span id="contact"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div style="text-align:center;padding: 20px;">
                            <h5 class="one">Academic Profile</h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table_profile">
                                    <tr>
                                        <td style="width: 20%">
                                            <label>Programme:</label>
                                        </td>
                                        <td style="width: 25%"><span id="prog"></span></td>
                                        <td style="width: 20%"><label>Programme Option:</label></td>
                                        <td style="width: 25%"><span id="prog_opt"></span></td>
                                    </tr>
                                    <tr id="grad_info">
                                        <td>
                                            <label>Graduation Date:</label>
                                        </td>
                                        <td>
                                            <span id="graddate"></span>
                                        </td>
                                        <td>
                                            <label>Class:</label>
                                        </td>
                                        <td>
                                            <span id="gradclass"></span>
                                        </td>
                                        
                                    </tr>
                                    <tr id="grad_info2">
                                        <td>
                                            <label>Certificate Number:</label>
                                        </td>
                                        <td>
                                            <span id="cert_no"></span>
                                        </td>
                                        
                                        <td>
                                            <label>Date Issued:</label>
                                        </td>
                                        <td>
                                            <span id="issued_award"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Admission Year:</label>
                                        </td>
                                        <td><span id="admin_year"></span></td>
                                        <td><label>Entry Level:</label></td>
                                        <td><span id="entry_lvl"></span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Inst. Email:</label>
                                        </td>
                                        <td><span id="inst_email" style="text-transform: lowercase;"></span></td>
                                        <td><label>Current Level:</label></td>
                                        <td><span id="cur_lvl"></span></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Admission Category:</label>
                                        </td>
                                        <td><span id="admn_cat" style="text-transform: uppercase;"></span></td>
                                        <td><label>Campus</label></td>
                                        <td><span id="campus"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div style="text-align:center;padding: 20px;" id="acad_header">
                            <h5 class="one">Academic History</h5>
                        </div>
                        <div class="row">
                            <div class="col-12" id="acad_content">
                                <table class="table_profile table table-hover table-striped">
                                    <thead>
                                        <th>Level</th>
                                        <th>Trimester</th>
                                        <th>CGPA/CWA</th>
                                        <th>GPA</th>
                                    </thead>
                                    <tbody id="acad_history">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="text-align:center;padding: 20px;" id="inst_header">
                            <h5 class="one">Institutions Attended</h5>
                        </div>
                        <div class="row" id="inst_content">
                            <div class="col-12">
                                <table class="table_profile table table-hover table-striped" id="inst_table">
                                    <thead>
                                        <th>Institution</th>
                                        <th>Region</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Position</th>
                                    </thead>
                                    <tbody id="inst_body">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="text-align:center;padding: 20px;" id="empl_header">
                            <h5 class="one">Employment History</h5>
                        </div>
                        <div class="row" id="empl_content">
                            <div class="col-12">
                                <table class="table_profile table table-hover table-striped" id="empl_table">
                                    <thead>
                                        <th>Institution</th>
                                        <th>Address</th>
                                        <th>Position</th>
                                        <th>From</th>
                                        <th>To</th>
                                    </thead>
                                    <tbody id="empl_body">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="text-align:center;padding: 20px;" id="shs_content_header">
                            <h5 class="one">SHS Results</h5>
                        </div>
                        <div class="row" id="shs_content_2">
                            <div class="col-12">
                                <table class="table_profile table table-hover table-striped" id="shs_rs_table">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">Index No.</th>
                                        <th colspan="3">Candidate Version</th>
                                        <th colspan="3">WAEC Version</th>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Grade</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody id="veri_Body">
                                    
                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button onclick="print()" class="btn btn-primary">Print</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollment Search Modal-->
        <div class="modal fade" id="enrollSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-graduate"></i> Enrollment Custom Search</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="enrollForm">
                            <div class="form-group">
                                <div class="form-label-group" style="text-transform: uppercase;">
                                    <input type="text" class="form-control" name="grad_sid">
                                    <label>Student ID</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group" style="text-transform: uppercase;">
                                    <input type="text" class="form-control" name="grad_name">
                                    <label>Name</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <select name="grad_programme" class="form-control" style="text-transform: uppercase;">
                                        <option disabled selected value="">Select Programme</option>
                                        <?php
                                                // require_once('../Db/connection.php');
                                                $sql = "SELECT * FROM programme order by progname";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['progid'] ?>"><?php echo $row['progname'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <select name="grad_graddate" class="form-control" style="text-transform: uppercase;">
                                        <option disabled selected value="">Entry Year</option>
                                        <?php
                                                // require_once('../Db/connection.php');
                                                $sql = "SELECT DISTINCT entryyear FROM studentbiodata order by entryyear DESC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['entryyear'] ?>"><?php echo $row['entryyear'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button id="enrollsearchBtn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="../vendor/datatables/jquery.dataTables.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>
        <!-- Demo scripts for this page-->
        <script src="../js/demo/datatables-demo.js"></script>
        <!--PNotify-->
        <script src="../vendor/pnotify/dist/pnotify.js"></script>
        <!-- FullCalendar -->
        <script src="../vendor/moment/min/moment.min.js"></script>
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js "></script>
        <!-- Custom Theme Scripts -->
        <script src="../js/custom.min.js"></script>
        <script src="../js/cleanup.js"></script>
        <script src="function.js"></script>
        <script src="../js/access.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                keep_open("keep-open,index");

                $("#enrollTable").DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdf',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7]
                            }
                        }
                    ]
                });
                
            });

        </script>

</body>

</html>
<?php
}else{
//  header('Location: ../1753');
    echo "<script type='text/javascript'>window.history.back()</script>";
}
?>
<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";

require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '9' ";
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

    <title><?php echo $title."Undergraduate Results" ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

    <!--PNotify-->
    <link href="../vendor/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendor/pnotify/dist/pnotify.buttons.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- Custom styling plus plugins -->
    
    <style type="text/css">
        label {
            font-weight: bold;
            font-size: 15px;
        }
        .info {
            font-weight: bold;
            color: black;
            font-size: 15px;
        }

        #banner {
        position: absolute;
        top: 30%;
        left: 20%;
        color: red;
        font-size: 100px;
        opacity: 0.5;
        pointer-events: none;
        -webkit-transform: rotate(-40deg);
        -moz-transform: rotate(-40deg);
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

            <a id="ug_enrollment_tab" class="dropdown-item" href="../5065"> Enrollments</a>

            <a id="ug_programme_tab" class="dropdown-item" href="../9734"> Programmes</a>

            <a id="ug_result_tab" class="dropdown-item active" href="../1507"> Results</a>                                
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
            <a id="pg_certification_tab" class="dropdown-item" href="../1326"> Certification</a>

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
              
            <a id="uni_halls" class="dropdown-item" href="../6540"><i class="fas fa-hotel"></i> University Halls</a>

            <a id="course_tab" class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

            <a id="department_tab" class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>
            
            <a id="programme_tab" class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>
            
            <a id="upload_tab" class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

            <a id="edit_tab" class="dropdown-item" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

            <a id="gen_edit" class="dropdown-item" href="../8081"><i class="fas fa-edit"></i> General Edits</a>

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
                        Home
                    </li>
                    <li class="breadcrumb-item active">Undergraduate Results</li>
                </ol>

                <!-- /.container-fluid -->
                <div class="card mb-3 animated fadeInRight">
                    <div class="card-header">
                        <!-- <span style="float: right;"><button class="btn btn-sm btn-success" id="uploadBtn">Upload Results</button><button style="display: none" class="btn btn-sm btn-success" id="backBtn">Back</button></span> -->
                        <i class=""></i>Undergraduate Results
                    </div>

                    <div class="card-body" id="rcardBody">
                        <center>
                            <div id="searchBox" style="width: 70%;">
                                <div class="input-group">
                                    <label style="font-size:16px;padding:5px">Search Criteria: </label>
                                    <input type="text" aria-label="First name" class="form-control" placeholder="Student ID" id="id">
                                    <button class="btn btn-sm btn-success" id="search"> Search</button>
                                </div>
                            </div>
                        </center>
                        <hr>
                        <div style="text-align:center;font-weight:bolder; font-size:15px"><span>Search Results:</span></div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="resultsTable">
                                <thead>
                                    <tr>
                                        <th>UIN</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="resultsBody">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- <div class="card-body" style="display: none;" id="ucardBody">
                        <div style="width: 70%;margin-left: 15%;text-align: center;">
                            <form>
                                <div class="form-group">
                                    <input type="file" name="upload" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="template()">??? Click To View/Download Template ???</button>

                        </div>


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

        <!-- Results Select Edit Modal-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Results for <span id="editfor"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="resultsEditForm">
                            <div class="form-group">
                                <label>Select Level:</label>
                                <select class="form-control" name="selLevel" id="selLevel">
                                    <option selected="" disabled="">Select Level</option>
                                    <option value="1">First Year</option>
                                    <option value="2">Second Year</option>
                                    <option value="3">Third Year</option>
                                    <option value="4">Fourth Year</option>
                                    <option value="5">Fifth Year</option>
                                    <option value="6">Sixth Year</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Trimester:</label>
                                <select class="form-control" name="selTrimester" id="selTrimester">
                                    <option selected="" disabled="">Select Trimester</option>
                                    <option value="1">First Trimester</option>
                                    <option value="2">Second Trimester</option>
                                    <option value="3">Third Trimester</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button id="editBtn" type="button" class="btn btn-success btn-sm">Edit</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Results Edit Modal-->
        <div class="modal fade" id="resultseditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Results for <span id="editresfor"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="resultsForm">
                            <table class="table table-bordered" id="showResultsTable">
                                <thead>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                    <th>Total Mark</th>
                                    <th>Session</th>
                                    <th></th>
                                </thead>
                                <tbody id="editResultsTable">
                                    
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                        <button id="UpdateBtn" class="btn btn-success">Edit</button>

                    </div>
                </div>
            </div>
        </div>

 <!-- Average Edit Modal-->
        <div class="modal fade" id="editAverageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Averages for <span id="editAveragefor"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="resultsForm">
                            <table class="table table-bordered" id="showAverageTable">
                                <thead>
                                    <th>Level</th>
                                    <th>Trimester</th>
                                    <th>CGPA</th>
                                    <th>GPA</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody id="editAverageBody">
                                    
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                        <button id="UpdateAverageBtn" class="btn btn-success">Edit</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Template Modal-->
        <div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View/Download Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="templateTable">
                                <thead>
                                <th>Assid</th>
                                <th>Indexno</th>
                                <th>Level</th>
                                <th>Trimester</th>
                                <th>Course Code</th>
                                <th>Credits</th>
                                <th>Mark</th>
                                <th>Grade</th>
                                <th>W</th>
                                <th>GP</th>
                                <th>Course Title</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Ok</button>

                    </div>
                </div>
            </div>
        </div>

        <!--View Results-->
        <div class="modal fade" id="view_results" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <img  id="profile_pic1" class="align-self-center rounded-circle mr-3" src="" onerror="if(this.src != '../images/avatar.png') this.src = '../images/avatar.png' " width="50px" height="50px">
                        <h4 class="modal-title" id="exampleModalLabel"> Results View</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div id="printable" class="modal-body" style="color: black;">
                            
                                <table style="width: 100%">
                                    <thead>

                            <tr style="line-height: initial;border-bottom: 2px solid black;">
                                <td style="width:125px;height:104px"><img src="../images/uds_logo.png" alt="img" width="130px" height="130px" /></td>

                                <td colspan="4" class="style1"><div style="text-align:center;margin-left: -100px"><span class="style53">UNIVERSITY FOR DEVELOPMENT STUDIES</span><br>
                                        <span class="style53">Academic Affairs Section</span><br>
                                        <span class="style2"><span class="style54">P.O. Box TL 1350  Tamale, Ghana  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tel: 03720-93382/26633/26634</span><br>
                                          <span class="style54">Web: <span class="style52">www.uds.edu.gh &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="style6">Email:</span> academicaffairs@uds.edu.gh</span><span class="style55"></span><br>
                                        <span class="style4">STATEMENT OF RESULTS</span>
                                </span></span></div></td>
                            </tr>
                                        
                                    <tr>
                                        <td style="width: 15%"><label>UIN:</label></td>
                                        <td  style="width: 30%" class="info" id="uin"></td>
                                        
                                        <td style="width: 15%"><label>Gender:</label></td>
                                        <td style="width: 30%" class="info" id="gender"></td>
                                        
                                        <td style="width: 10%;" rowspan="3"><img id="profile_pic2" src="../images/avatar.png"  onerror='if(this.src != "../images/avatar.png") this.src = "../images/avatar.png"' width="100px" height="100px"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Student ID:</label></td>
                                        <td class="info" id="s_id"></td>
                                        
                                        <td><label>Campus:</label></td>
                                        <td class="info" id="campus"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Student Name:</label></td>
                                        <td class="info" id="name"></td>
                                        
                                        <td><label>Programme:</label></td>
                                        <td class="info" id="prog"></td>
                                    </tr>

                                    <tr id="banner_row" style="visibility: hidden;">
                                    <td colspan="5">
                                        <div id="banner" style="border: 3px solid red;padding: 5px;text-align: center;letter-spacing: 20px;border-radius: 10px;">**FAKE**</div>
                                    </td>
                                </tr>
`
                            <!-- <tr style="text-align:center;width: 100%">*******************************************************************************************************</tr> -->
                                    </thead>

                            <tbody>
                                
                                <tr>
                                    <td colspan="5" id="gradesTable">
                                        <center><img src="../images/loader.gif" width="50px" height="50px"> Loading...</center>
                                    </td>
                                </tr>
                                
                            </tbody>
                                </table>
                            
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Dismiss</button>
                        <button class="btn btn-sm btn-primary" onclick="print()"> Print</button>

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
        <script src="../vendor/chart.js/Chart.min.js"></script>
        <script src="../vendor/datatables/jquery.dataTables.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>
        <!-- Demo scripts for this page-->
        <script src="../js/demo/datatables-demo.js"></script>
        <script src="../js/demo/chart-area-demo.js"></script>
        <!--PNotify-->
        <script src="../vendor/pnotify/dist/pnotify.js"></script>
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
        <!-- FullCalendar -->
        <script src="../vendor/moment/min/moment.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js "></script>
        <!-- Custom Theme Scripts -->
        <script src="../js/custom.min.js"></script>
        <script src="../js/cleanup.js"></script>
        <script src="../js/access.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var status = localStorage.getItem('status');

                if (status == 'login') {
                    new PNotify({
                        title: 'Login Successful',
                        text: 'Logged in as ' + '<?php echo $_SESSION["FNAME"]." ".$_SESSION["LNAME"] ?>',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }

                localStorage.setItem('status', '');

                keep_open("keep-open,index");

                $("#resultsTable").DataTable();
                $("#showResultsTable").DataTable();
                
                $("#templateTable").DataTable({
                    dom: 'Bfrtip',
                    paging: false,
                    searching: false,
                    buttons: [{
                            extend: 'pdf',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                        },
                        {
                            extend: 'excel',
                        }
                    ]
                });

                $("#search").on('click', function() {
                    var id = $("#id").val();

                    $.ajax({
                        type: 'POST',
                        url: 'checkResults.php',
                        data: 'id=' + id,

                        success: function(response) {
                            var data = JSON.parse(response);
                            // console.log(data);
                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                                var uin = data[i].uin;
                                var id = data[i].indexno;
                                var name = data[i].firstname+" "+data[i].middlename+" "+data[i].surname;
                                var graddate = moment(data[i].graddate).format("YYYY");
                                var prog = data[i].progname;
                                if(graddate >= '2019') {
                                    var refresh = "<button id='ref_btn' class='btn btn-sm btn-info' onclick ='refresh_results(\"" + id + "\")'>Refresh Results</button>";
                                } else {
                                    var refresh = '';
                                }

                                var btn = "<div class='dropdown'><button class='btn btn-sm btn-danger dropdown-toggle' type='button' data-toggle='dropdown'><i class='fa fa-trash'></i> Delete<span class='caret'></span></button><ul class='dropdown-menu'><li class='dropdown-item'><a onclick ='editResults(\"" + id + "\")'>Results</a></li><li class='dropdown-item'><a onclick ='editAverages(\"" + id + "\")'>Averages</a></li></ul></div>";

                                html += "<tr><td>" + uin + "</td><td>" + id + "</td><td>" + name + "</td><td>" + prog + "</td><td>"+refresh+"</td><td><button class='btn btn-sm btn-success' onclick ='viewResults(\"" + id + "\")'>View Results</button></td><td>"+btn+"</td></tr>";
                            }
                            document.getElementById("resultsBody").innerHTML = html;
                        }
                    })
                })
            });

            function viewResults(id) {
                $("#view_results").modal('show');
                document.getElementById("banner_row").style.visibility = 'hidden';
                $.ajax({
                    type: 'POST',
                    url: 'fetch_results.php',
                    data: 'id=' + id,

                    success: function(response) {
                        // console.log(response);
                        var data = JSON.parse(response);
                        //console.log(data);
                        //Personal Information
                        for(var i = 0; i<data.length; i++) {
                            
                            var uin = data[i].uin;
                            var id = data[i].indexno;
                            var name = data[i].firstname+" "+data[i].middlename+" "+data[i].surname;
                            var gender = data[i].gender;
                            var prog = data[i].progname;
                            var pic = data[i].pic_id;
                            var campus = data[i].campus_descr;
                            
                            document.getElementById("uin").innerHTML = uin;
                            document.getElementById("s_id").innerHTML = id;
                            document.getElementById("name").innerHTML = name;
                            document.getElementById("gender").innerHTML = gender;
                            document.getElementById("prog").innerHTML = prog;
                            document.getElementById("campus").innerHTML = campus;
                            document.getElementById("profile_pic1").src = '../pics/'+ pic;
                            document.getElementById("profile_pic2").src = '../pics/'+ pic;
                            
                            
                            grades(id);
                        }
                    }
                })

            }
            
function grades(id) {
    $("#view_results").modal('show');
    $("#gradesTable").html("<center><img src='../images/loader.gif' width='50px' height='50px'> Loading...</center>");
    $.ajax({
        type: 'POST',
        url: 'grades.php',
        data: 'id=' + id,

        success: function(response) {
            var data = JSON.parse(response);
            var prog = data['biodata'][0].progname;
            var _prog = prog.split(" ");
            for (var i = 0; i < _prog.length; i++) {
                var __prog = _prog[0];
            }

            // Create Headers (Level and Trimester) for Diploma.
            if (__prog.trim() == "DIPLOMA") {

                var html1 = '';
                var header = "<table style='width:100%;border-bottom: 2px solid black;' class='table inner_tbl'><thead class='inner_thead'><tr><th>Course Code</th><th style='width:60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";
                // var header = "";
                var session1 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='one'>FIRST YEAR</h5></div>";

                html1 += "<label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html1 += header;

                var html2 = '';
                html2 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html2 += header;

                var html3 = '';
                html3 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html3 += header;

                //SECOND YEAR
                var session2 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two'>SECOND YEAR</h5></div>";

                var html4 = '';
                html4 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html4 += header;

                var html5 = '';
                html5 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html5 += header;

                var html6 = '';
                html6 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html6 += header;

                //THIRD YEAR
                var session3 = "<div id='thirdyear' class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='three'>THIRD YEAR</h5></div>";

                var html7 = '';
                html7 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html7 += header;

                var html8 = '';
                html8 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>SECOND TRIMESTER</label>";
                html8 += header;

                var html9 = '';
                html9 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html9 += header;

                // trans_profile(indexno);

                 // FIRST YEAR FIRST TRIMESTER
                for (var i = 0; i < data['first_first'].length; i++) {
                    var trimester = data['first_first'][i].trimester;
                    var level = data['first_first'][i].levelid;

                    var title = data['first_first'][i].course_title;
                    var code = data['first_first'][i].coursecode1;
                    var credits = data['first_first'][i].credits;
                    var grade = data['first_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_first'][i].coursecode1 && tempgrade == data['first_first'][i].grade) {
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                        continue;
                    } else if (tempcode == data['first_first'][i].coursecode1 && tempgrade != data['first_first'][i].grade) {
                        grade += "**";
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_first'][i].coursecode1;
                    var tempgrade = data['first_first'][i].grade;

                    var one_one = true;
                        html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR SECOND TRIMESTER
                for (var i = 0; i < data['first_second'].length; i++) {
                    var trimester = data['first_second'][i].trimester;
                    var level = data['first_second'][i].levelid;

                    var title = data['first_second'][i].course_title;
                    var code = data['first_second'][i].coursecode1;
                    var credits = data['first_second'][i].credits;
                    var grade = data['first_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_second'][i].coursecode1 && tempgrade == data['first_second'][i].grade) {
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                        continue;
                    } else if (tempcode == data['first_second'][i].coursecode1 && tempgrade != data['first_second'][i].grade) {
                        grade += "**";
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_second'][i].coursecode1;
                    var tempgrade = data['first_second'][i].grade;

                    var one_two = true;
                        html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR THIRD TRIMESTER
                for (var i = 0; i < data['first_third'].length; i++) {
                    var trimester = data['first_third'][i].trimester;
                    var level = data['first_third'][i].levelid;

                    var title = data['first_third'][i].course_title;
                    var code = data['first_third'][i].coursecode1;
                    var credits = data['first_third'][i].credits;
                    var grade = data['first_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_third'][i].coursecode1 && tempgrade == data['first_third'][i].grade) {
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                        continue;
                    } else if (tempcode == data['first_third'][i].coursecode1 && tempgrade != data['first_third'][i].grade) {
                        grade += "**";
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_third'][i].coursecode1;
                    var tempgrade = data['first_third'][i].grade;

                    var one_three = true;
                        html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr></tr>";
                }

                // SECOND YEAR FIRST TRIMESTER
                for (var i = 0; i < data['second_first'].length; i++) {
                    var trimester = data['second_first'][i].trimester;
                    var level = data['second_first'][i].levelid;

                    var title = data['second_first'][i].course_title;
                    var code = data['second_first'][i].coursecode1;
                    var credits = data['second_first'][i].credits;
                    var grade = data['second_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_first'][i].coursecode1 && tempgrade == data['second_first'][i].grade) {
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                        continue;
                    } else if (tempcode == data['second_first'][i].coursecode1 && tempgrade != data['second_first'][i].grade) {
                        grade += "**";
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_first'][i].coursecode1;
                    var tempgrade = data['second_first'][i].grade;

                    var two_one = true;
                        html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR SECOND TRIMESTER
                for (var i = 0; i < data['second_second'].length; i++) {
                    var trimester = data['second_second'][i].trimester;
                    var level = data['second_second'][i].levelid;

                    var title = data['second_second'][i].course_title;
                    var code = data['second_second'][i].coursecode1;
                    var credits = data['second_second'][i].credits;
                    var grade = data['second_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_second'][i].coursecode1 && tempgrade == data['second_second'][i].grade) {
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                        continue;
                    } else if (tempcode == data['second_second'][i].coursecode1 && tempgrade != data['second_second'][i].grade) {
                        grade += "**";
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_second'][i].coursecode1;
                    var tempgrade = data['second_second'][i].grade;

                    var two_two = true;
                        html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR THIRD TRIMESTER
                for (var i = 0; i < data['second_third'].length; i++) {
                    var trimester = data['second_third'][i].trimester;
                    var level = data['second_third'][i].levelid;

                    var title = data['second_third'][i].course_title;
                    var code = data['second_third'][i].coursecode1;
                    var credits = data['second_third'][i].credits;
                    var grade = data['second_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_third'][i].coursecode1 && tempgrade == data['second_third'][i].grade) {
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                        continue;
                    } else if (tempcode == data['second_third'][i].coursecode1 && tempgrade != data['second_third'][i].grade) {
                        grade += "**";
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_third'][i].coursecode1;
                    var tempgrade = data['second_third'][i].grade;

                    var two_three = true;
                        html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR FIRST TRIMESTER
                for (var i = 0; i < data['third_first'].length; i++) {
                    var trimester = data['third_first'][i].trimester;
                    var level = data['third_first'][i].levelid;

                    var title = data['third_first'][i].course_title;
                    var code = data['third_first'][i].coursecode1;
                    var credits = data['third_first'][i].credits;
                    var grade = data['third_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_first'][i].coursecode1 && tempgrade == data['third_first'][i].grade) {
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                        continue;
                    } else if (tempcode == data['third_first'][i].coursecode1 && tempgrade != data['third_first'][i].grade) {
                        grade += "**";
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_first'][i].coursecode1;
                    var tempgrade = data['third_first'][i].grade;

                    var three_one = true;
                    html7 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR SECOND TRIMESTER
                for (var i = 0; i < data['third_second'].length; i++) {
                    var trimester = data['third_second'][i].trimester;
                    var level = data['third_second'][i].levelid;

                    var title = data['third_second'][i].course_title;
                    var code = data['third_second'][i].coursecode1;
                    var credits = data['third_second'][i].credits;
                    var grade = data['third_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_second'][i].coursecode1 && tempgrade == data['third_second'][i].grade) {
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                        continue;
                    } else if (tempcode == data['third_second'][i].coursecode1 && tempgrade != data['third_second'][i].grade) {
                        grade += "**";
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_second'][i].coursecode1;
                    var tempgrade = data['third_second'][i].grade;

                    var three_two = true;
                        html8 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR THIRD TRIMESTER
                for (var i = 0; i < data['third_third'].length; i++) {
                    var trimester = data['third_third'][i].trimester;
                    var level = data['third_third'][i].levelid;

                    var title = data['third_third'][i].course_title;
                    var code = data['third_third'][i].coursecode1;
                    var credits = data['third_third'][i].credits;
                    var grade = data['third_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_third'][i].coursecode1 && tempgrade == data['third_third'][i].grade) {
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                        continue;
                    } else if (tempcode == code && tempgrade != data['third_third'][i].grade) {
                        grade += "**";
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_third'][i].coursecode1;
                    var tempgrade = data['third_third'][i].grade;

                    var three_three = true;
                        html9 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                //Add Summary of GPA, CC and CGPA.

                var summary1 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa1'></span> </td></tr>";
                var summary2 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa2'></span> </td></tr>";
                var summary3 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa3'></span> </td></tr>";

                var summary4 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa4'></span> </td></tr>";
                var summary5 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa5'></span> </td></tr>";
                var summary6 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa6'></span> </td></tr>";

                var summary7 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa7'></span> </td></tr>";
                var summary8 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa8'></span> </td></tr>";
                var summary9 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa9'></span> </td></tr>";


                html1 += summary1 + "</tbody></table><br>";
                html2 += summary2 + "</tbody></table><br>";
                html3 += summary3 + "</tbody></table><br>";

                html4 += summary4 + "</tbody></table><br>";
                html5 += summary5 + "</tbody></table><br>";
                html6 += summary6 + "</tbody></table><br>";

                html7 += summary7 + "</tbody></table><br>";
                html8 += summary8 + "</tbody></table><br>";
                html9 += summary9 + "</tbody></table><br>";

                var end = "</div>";

                var main = '';

                $.ajax({
                    type: 'POST',
                    url: 'toDisplay.php',
                    data: 'id=' + id,

                    success: function(json) {
                        // main += trans_header;
                        if (json.includes(1)) {
                            main += session1;
                            if(one_one == true) {
                                main += html1;
                            } else {

                            }
                            if(one_two == true) {
                                main += html2;
                            } else {

                            }
                            if(one_three == true) {
                                main += html3;
                            } else {

                            }
                        }
                        if (json.includes(2)) {
                            main += session2;
                            if(two_one == true) {
                                main += html4;
                            } else {

                            }
                            if(two_two == true) {
                                main += html5;
                            } else {

                            }
                            if(two_three == true) {
                                main += html6;
                            } else {
                                
                            }
                        }
                        if (json.includes(3)) {
                            main += session3;
                            if(three_one == true) {
                                main += html7;
                            } else {

                            }
                            if(three_two == true) {
                                main += html8;
                            } else {

                            }
                            if(three_three == true) {
                                main += html9;
                            } else {
                                
                            }
                        }
                        main += end;
                        averages(id);
                        total_credits(id);
                        // signatory();
                        document.getElementById("gradesTable").innerHTML = main;
                    }
                });

            } else {

                var html1 = '';
                var header = "<table style='width:100%;border-bottom: 2px solid black;' class='table inner_tbl'><thead class='inner_thead'><tr><th>Course Code</th><th style='width:60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";
                var session1 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='one'>FIRST YEAR</h5></div>";

                html1 += "<label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html1 += header;

                var html2 = '';
                html2 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html2 += header;

                var html3 = '';
                html3 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html3 += header;

                //SECOND YEAR
                var session2 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two'>SECOND YEAR</h5></div>";

                var html4 = '';
                html4 += "<label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html4 += header;

                var html5 = '';
                html5 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html5 += header;

                var html6 = '';
                html6 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html6 += header;

                //THIRD YEAR
                var session3 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='three'>THIRD YEAR</h5></div>";

                var html7 = '';
                html7 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html7 += header;

                var html8 = '';
                html8 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html8 += header;

                var html9 = '';
                html9 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html9 += header;

                //Fourth
                var  session4 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>FOURTH YEAR</h5></div>";

                var html10 = '';
                html10 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html10 += header;

                var html11 = '';
                html11 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html11 += header;

                var html12 = '';
                html12 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html12 += header;

                //Fifth
                var session5 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>FIFTH YEAR</h5></div>";

                var html13 = '';
                html13 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html13 += header;

                var html14 = '';
                html14 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html14 += header;

                var html15 = '';
                html15 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html15 += header;

                //Sixth
                var session6 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>SIXTH YEAR</h5></div>";

                var html16 = '';
                html16 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html16 += header;

                var html17 = '';
                html17 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html17 += header;

                var html18 = '';
                html18 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html18 += header;


                // trans_profile(indexno);

                // FIRST YEAR FIRST TRIMESTER
                for (var i = 0; i < data['first_first'].length; i++) {
                    var trimester = data['first_first'][i].trimester;
                    var level = data['first_first'][i].levelid;

                    var title = data['first_first'][i].course_title;
                    var code = data['first_first'][i].coursecode1;
                    var credits = data['first_first'][i].credits;
                    var grade = data['first_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_first'][i].coursecode1 && tempgrade == data['first_first'][i].grade) {
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                        continue;
                    } else if (tempcode == data['first_first'][i].coursecode1 && tempgrade != data['first_first'][i].grade) {
                        grade += "**";
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_first'][i].coursecode1;
                    var tempgrade = data['first_first'][i].grade;

                    var one_one = true;
                        html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR SECOND TRIMESTER
                for (var i = 0; i < data['first_second'].length; i++) {
                    var trimester = data['first_second'][i].trimester;
                    var level = data['first_second'][i].levelid;

                    var title = data['first_second'][i].course_title;
                    var code = data['first_second'][i].coursecode1;
                    var credits = data['first_second'][i].credits;
                    var grade = data['first_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_second'][i].coursecode1 && tempgrade == data['first_second'][i].grade) {
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                        continue;
                    } else if (tempcode == data['first_second'][i].coursecode1 && tempgrade != data['first_second'][i].grade) {
                        grade += "**";
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_second'][i].coursecode1;
                    var tempgrade = data['first_second'][i].grade;

                    var one_two = true;
                        html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR THIRD TRIMESTER
                for (var i = 0; i < data['first_third'].length; i++) {
                    var trimester = data['first_third'][i].trimester;
                    var level = data['first_third'][i].levelid;

                    var title = data['first_third'][i].course_title;
                    var code = data['first_third'][i].coursecode1;
                    var credits = data['first_third'][i].credits;
                    var grade = data['first_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_third'][i].coursecode1 && tempgrade == data['first_third'][i].grade) {
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                        continue;
                    } else if (tempcode == data['first_third'][i].coursecode1 && tempgrade != data['first_third'][i].grade) {
                        grade += "**";
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_third'][i].coursecode1;
                    var tempgrade = data['first_third'][i].grade;

                    var one_three = true;
                        html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr></tr>";
                }

                // SECOND YEAR FIRST TRIMESTER
                for (var i = 0; i < data['second_first'].length; i++) {
                    var trimester = data['second_first'][i].trimester;
                    var level = data['second_first'][i].levelid;

                    var title = data['second_first'][i].course_title;
                    var code = data['second_first'][i].coursecode1;
                    var credits = data['second_first'][i].credits;
                    var grade = data['second_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_first'][i].coursecode1 && tempgrade == data['second_first'][i].grade) {
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                        continue;
                    } else if (tempcode == data['second_first'][i].coursecode1 && tempgrade != data['second_first'][i].grade) {
                        grade += "**";
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_first'][i].coursecode1;
                    var tempgrade = data['second_first'][i].grade;

                    var two_one = true;
                        html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR SECOND TRIMESTER
                for (var i = 0; i < data['second_second'].length; i++) {
                    var trimester = data['second_second'][i].trimester;
                    var level = data['second_second'][i].levelid;

                    var title = data['second_second'][i].course_title;
                    var code = data['second_second'][i].coursecode1;
                    var credits = data['second_second'][i].credits;
                    var grade = data['second_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_second'][i].coursecode1 && tempgrade == data['second_second'][i].grade) {
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                        continue;
                    } else if (tempcode == data['second_second'][i].coursecode1 && tempgrade != data['second_second'][i].grade) {
                        grade += "**";
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_second'][i].coursecode1;
                    var tempgrade = data['second_second'][i].grade;

                    var two_two = true;
                        html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR THIRD TRIMESTER
                for (var i = 0; i < data['second_third'].length; i++) {
                    var trimester = data['second_third'][i].trimester;
                    var level = data['second_third'][i].levelid;

                    var title = data['second_third'][i].course_title;
                    var code = data['second_third'][i].coursecode1;
                    var credits = data['second_third'][i].credits;
                    var grade = data['second_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_third'][i].coursecode1 && tempgrade == data['second_third'][i].grade) {
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                        continue;
                    } else if (tempcode == data['second_third'][i].coursecode1 && tempgrade != data['second_third'][i].grade) {
                        grade += "**";
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_third'][i].coursecode1;
                    var tempgrade = data['second_third'][i].grade;

                    var two_three = true;
                        html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR FIRST TRIMESTER
                for (var i = 0; i < data['third_first'].length; i++) {
                    var trimester = data['third_first'][i].trimester;
                    var level = data['third_first'][i].levelid;

                    var title = data['third_first'][i].course_title;
                    var code = data['third_first'][i].coursecode1;
                    var credits = data['third_first'][i].credits;
                    var grade = data['third_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_first'][i].coursecode1 && tempgrade == data['third_first'][i].grade) {
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                        continue;
                    } else if (tempcode == data['third_first'][i].coursecode1 && tempgrade != data['third_first'][i].grade) {
                        grade += "**";
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_first'][i].coursecode1;
                    var tempgrade = data['third_first'][i].grade;

                    var three_one = true;
                    html7 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR SECOND TRIMESTER
                for (var i = 0; i < data['third_second'].length; i++) {
                    var trimester = data['third_second'][i].trimester;
                    var level = data['third_second'][i].levelid;

                    var title = data['third_second'][i].course_title;
                    var code = data['third_second'][i].coursecode1;
                    var credits = data['third_second'][i].credits;
                    var grade = data['third_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_second'][i].coursecode1 && tempgrade == data['third_second'][i].grade) {
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                        continue;
                    } else if (tempcode == data['third_second'][i].coursecode1 && tempgrade != data['third_second'][i].grade) {
                        grade += "**";
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_second'][i].coursecode1;
                    var tempgrade = data['third_second'][i].grade;

                    var three_two = true;
                        html8 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR THIRD TRIMESTER
                for (var i = 0; i < data['third_third'].length; i++) {
                    var trimester = data['third_third'][i].trimester;
                    var level = data['third_third'][i].levelid;

                    var title = data['third_third'][i].course_title;
                    var code = data['third_third'][i].coursecode1;
                    var credits = data['third_third'][i].credits;
                    var grade = data['third_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_third'][i].coursecode1 && tempgrade == data['third_third'][i].grade) {
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                        continue;
                    } else if (tempcode == code && tempgrade != data['third_third'][i].grade) {
                        grade += "**";
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_third'][i].coursecode1;
                    var tempgrade = data['third_third'][i].grade;

                    var three_three = true;
                        html9 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FOURTH YEAR FIRST TRIMESTER
                for (var i = 0; i < data['fourth_first'].length; i++) {
                    var trimester = data['fourth_first'][i].trimester;
                    var level = data['fourth_first'][i].levelid;

                    var title = data['fourth_first'][i].course_title;
                    var code = data['fourth_first'][i].coursecode1;
                    var credits = data['fourth_first'][i].credits;
                    var grade = data['fourth_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['fourth_first'][i].coursecode1 && tempgrade == data['fourth_first'][i].grade) {
                        tempcode = data['fourth_first'][i].coursecode1;
                        tempgrade = data['fourth_first'][i].grade;
                        continue;
                    } else if (tempcode == data['fourth_first'][i].coursecode1 && tempgrade != data['fourth_first'][i].grade) {
                        grade += "**";
                        tempcode = data['fourth_first'][i].coursecode1;
                        tempgrade = data['fourth_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fourth_first'][i].coursecode1;
                    var tempgrade = data['fourth_first'][i].grade;

                    var four_one = true;
                        html10 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                 // FOURTH YEAR SECOND TRIMESTER
                for (var i = 0; i < data['fourth_second'].length; i++) {
                    var trimester = data['fourth_second'][i].trimester;
                    var level = data['fourth_second'][i].levelid;

                    var title = data['fourth_second'][i].course_title;
                    var code = data['fourth_second'][i].coursecode1;
                    var credits = data['fourth_second'][i].credits;
                    var grade = data['fourth_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['fourth_second'][i].coursecode1 && tempgrade == data['fourth_second'][i].grade) {
                        tempcode = data['fourth_second'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fourth_second'][i].coursecode1 && tempgrade != data['fourth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['fourth_second'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fourth_second'][i].coursecode1;
                    var tempgrade = data['fourth_second'][i].grade;

                    var four_two = true;
                        html11 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                 // FOURTH YEAR THIRD TRIMESTER
                for (var i = 0; i < data['fourth_third'].length; i++) {
                    var trimester = data['fourth_third'][i].trimester;
                    var level = data['fourth_third'][i].levelid;

                    var title = data['fourth_third'][i].course_title;
                    var code = data['fourth_third'][i].coursecode1;
                    var credits = data['fourth_third'][i].credits;
                    var grade = data['fourth_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['fourth_third'][i].coursecode1 && tempgrade == data['fourth_second'][i].grade) {
                        tempcode = data['fourth_third'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fourth_third'][i].coursecode1 && tempgrade != data['fourth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['fourth_third'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fourth_third'][i].coursecode1;
                    var tempgrade = data['fourth_second'][i].grade;

                    var four_three = true;
                        html12 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                 // FIFT YEAR FIRST TRIMESTER
                for (var i = 0; i < data['fifth_first'].length; i++) {
                    var trimester = data['fifth_first'][i].trimester;
                    var level = data['fifth_first'][i].levelid;

                    var title = data['fifth_first'][i].course_title;
                    var code = data['fifth_first'][i].coursecode1;
                    var credits = data['fifth_first'][i].credits;
                    var grade = data['fifth_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['fifth_first'][i].coursecode1 && tempgrade == data['fifth_first'][i].grade) {
                        tempcode = data['fifth_first'][i].coursecode1;
                        tempgrade = data['fifth_first'][i].grade;
                        continue;
                    } else if (tempcode == data['fifth_first'][i].coursecode1 && tempgrade != data['fifth_first'][i].grade) {
                        grade += "**";
                        tempcode = data['fifth_first'][i].coursecode1;
                        tempgrade = data['fifth_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fifth_first'][i].coursecode1;
                    var tempgrade = data['fifth_first'][i].grade;

                    var five_one = true;
                        html13 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIFT YEAR SECOND TRIMESTER
                for (var i = 0; i < data['fifth_second'].length; i++) {
                    var trimester = data['fifth_second'][i].trimester;
                    var level = data['fifth_second'][i].levelid;

                    var title = data['fifth_second'][i].course_title;
                    var code = data['fifth_second'][i].coursecode1;
                    var credits = data['fifth_second'][i].credits;
                    var grade = data['fifth_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['fifth_second'][i].coursecode1 && tempgrade == data['fifth_second'][i].grade) {
                        tempcode = data['fifth_second'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fifth_second'][i].coursecode1 && tempgrade != data['fifth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['fifth_second'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fifth_second'][i].coursecode1;
                    var tempgrade = data['fifth_second'][i].grade;

                    var five_two = true;
                        html14 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIFT YEAR THIRD TRIMESTER
                for (var i = 0; i < data['fifth_third'].length; i++) {
                    var trimester = data['fifth_third'][i].trimester;
                    var level = data['fifth_third'][i].levelid;

                    var title = data['fifth_third'][i].course_title;
                    var code = data['fifth_third'][i].coursecode1;
                    var credits = data['fifth_third'][i].credits;
                    var grade = data['fifth_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['fifth_third'][i].coursecode1 && tempgrade == data['fifth_third'][i].grade) {
                        tempcode = data['fifth_third'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fifth_third'][i].coursecode1 && tempgrade != data['fifth_third'][i].grade) {
                        grade += "**";
                        tempcode = data['fifth_third'][i].coursecode1;
                        tempgrade = data['fifth_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fifth_third'][i].coursecode1;
                    var tempgrade = data['fifth_third'][i].grade;

                    var five_three = true;
                        html15 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SIXTH YEAR FIRST TRIMESTER
                for (var i = 0; i < data['sixth_first'].length; i++) {
                    var trimester = data['sixth_first'][i].trimester;
                    var level = data['sixth_first'][i].levelid;

                    var title = data['sixth_first'][i].course_title;
                    var code = data['sixth_first'][i].coursecode1;
                    var credits = data['sixth_first'][i].credits;
                    var grade = data['sixth_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['sixth_first'][i].coursecode1 && tempgrade == data['sixth_first'][i].grade) {
                        tempcode = data['sixth_first'][i].coursecode1;
                        tempgrade = data['sixth_first'][i].grade;
                        continue;
                    } else if (tempcode == data['sixth_first'][i].coursecode1 && tempgrade != data['sixth_first'][i].grade) {
                        grade += "**";
                        tempcode = data['sixth_first'][i].coursecode1;
                        tempgrade = data['sixth_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['sixth_first'][i].coursecode1;
                    var tempgrade = data['sixth_first'][i].grade;

                    var six_one = true;
                        html16 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SIXTH YEAR SECOND TRIMESTER
                for (var i = 0; i < data['sixth_second'].length; i++) {
                    var trimester = data['sixth_second'][i].trimester;
                    var level = data['sixth_second'][i].levelid;

                    var title = data['sixth_second'][i].course_title;
                    var code = data['sixth_second'][i].coursecode1;
                    var credits = data['sixth_second'][i].credits;
                    var grade = data['sixth_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['sixth_second'][i].coursecode1 && tempgrade == data['sixth_second'][i].grade) {
                        tempcode = data['sixth_second'][i].coursecode1;
                        tempgrade = data['sixth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['sixth_second'][i].coursecode1 && tempgrade != data['sixth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['sixth_second'][i].coursecode1;
                        tempgrade = data['sixth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['sixth_second'][i].coursecode1;
                    var tempgrade = data['sixth_second'][i].grade;

                    var six_two = true;
                        html17 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SIXTH YEAR THIRD TRIMESTER
                for (var i = 0; i < data['sixth_third'].length; i++) {
                    var trimester = data['sixth_third'][i].trimester;
                    var level = data['sixth_third'][i].levelid;

                    var title = data['sixth_third'][i].course_title;
                    var code = data['sixth_third'][i].coursecode1;
                    var credits = data['sixth_third'][i].credits;
                    var grade = data['sixth_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['sixth_third'][i].coursecode1 && tempgrade == data['sixth_third'][i].grade) {
                        tempcode = data['sixth_third'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                    } else if (tempcode == data['sixth_third'][i].coursecode1 && tempgrade != data['sixth_third'][i].grade) {
                        grade += "**";
                        tempcode = data['sixth_third'][i].coursecode1;
                        tempgrade = data['sixth_third'][i].grade;
                        continue;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['sixth_third'][i].coursecode1;
                    var tempgrade = data['sixth_third'][i].grade;

                    var six_three = true;
                        html18 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                //First Year Summary
                var summary1 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa1'></span> </td></tr>";
                var summary2 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa2'></span> </td></tr>";
                var summary3 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa3'></span> </td></tr>";
                //SECOND YEAR Summary
                var summary4 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa4'></span> </td></tr>";
                var summary5 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa5'></span> </td></tr>";
                var summary6 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa6'></span> </td></tr>";
                //THIRD YEAR Summary
                var summary7 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa7'></span> </td></tr>";
                var summary8 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa8'></span> </td></tr>";
                var summary9 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa9'></span> </td></tr>";
                //FOURTH YEAR Summary
                var summary10 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc10'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa10'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa10'></span> </td></tr>";
                var summary11 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc11'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa11'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa11'></span> </td></tr>";
                var summary12 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc12'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa12'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa12'></span> </td></tr>";
                //FIFTH YEAR Summary
                var summary13 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: CC: <span id='cc13'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa13'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa13'></span> </td></tr>";
                var summary14 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc14'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa14'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa14'></span> </td></tr>";
                var summary15 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc15'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa15'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa15'></span> </td></tr>";
                //SIXTH YEAR Summary
                var summary16 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc16'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa16'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa16'></span> </td></tr>";
                var summary17 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc17'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa17'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa17'></span> </td></tr>";
                var summary18 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc18'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa18'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa18'></span> </td></tr>";

                total_credits(id);

                html1 += summary1 + "</tbody></table><br>" /*</tr>"*/ ;
                html2 += summary2 + "</tbody></table><br>" /*</tr>"*/ ;
                html3 += summary3 + "</tbody></table><br>" /*</tr>"*/ ;
                html4 += summary4 + "</tbody></table><br>" /*</tr>"*/ ;
                html5 += summary5 + "</tbody></table><br>" /*</tr>"*/ ;
                html6 += summary6 + "</tbody></table><br>" /*</tr>"*/ ;
                html7 += summary7 + "</tbody></table><br>" /*</tr>"*/ ;
                html8 += summary8 + "</tbody></table><br>" /*</tr>"*/ ;
                html9 += summary9 + "</tbody></table><br>" /*</tr>"*/ ;
                html10 += summary10 + "</tbody></table><br>" /*</tr>"*/ ;
                html11 += summary11 + "</tbody></table><br>" /*</tr>"*/ ;
                html12 += summary12 + "</tbody></table><br>" /*</tr>"*/ ;
                html13 += summary13 + "</tbody></table><br>" /*</tr>"*/ ;
                html14 += summary14 + "</tbody></table><br>" /*</tr>"*/ ;
                html15 += summary15 + "</tbody></table><br>" /*</tr>"*/ ;
                html16 += summary16 + "</tbody></table><br>" /*</tr>"*/ ;
                html17 += summary17 + "</tbody></table><br>" /*</tr>"*/ ;
                html18 += summary18 + "</tbody></table><br>" /*</tr>"*/ ;


                var end = "</div>";

                var main = '';
                $.ajax({
                    type: 'POST',
                    url: 'toDisplay.php',
                    data: 'id=' + id,

                    success: function(json) {
                        // console.log(json);
                        if (json.includes(1)) {
                            main += session1;
                            if(one_one == true) {
                                main += html1;
                            } else {

                            }
                            if(one_two == true) {
                                main += html2;
                            } else {

                            }
                            if(one_three == true) {
                                main += html3;
                            } else {

                            }
                        }
                        if (json.includes(2)) {
                            main += session2;
                            if(two_one == true) {
                                main += html4;
                            } else {

                            }
                            if(two_two == true) {
                                main += html5;
                            } else {

                            }
                            if(two_three == true) {
                                main += html6;
                            } else {

                            }
                        }
                        if (json.includes(3)) {
                            main += session3;
                            if(three_one == true) {
                                main += html7;
                            } else {

                            }
                            if(three_two == true) {
                                main += html8;
                            } else {

                            }
                            if(three_three == true) {
                                main += html9;
                            } else {

                            }
                        }
                        if (json.includes(4)) {
                            main += session4;
                            if(four_one == true) {
                                main += html10;
                            } else {

                            }
                            if(four_two == true) {
                                main += html11;
                            } else {

                            }
                            if(four_three == true) {
                                main += html12;
                            } else {

                            }
                        }
                        if (json.includes(5)) {
                            main += session5;
                            if(five_one == true) {
                                main += html13;
                            } else {

                            }
                            if(five_two == true) {
                                main += html14;
                            } else {

                            }
                            if(five_three == true) {
                                main += html15;
                            } else {

                            }
                        }
                        if (json.includes(6)) {
                            main += session6;
                            if(six_one == true) {
                                main += html16;
                            } else {

                            }
                            if(six_two == true) {
                                main += html17;
                            } else {

                            }
                            if(six_three == true) {
                                main += html18;
                            } else {

                            }
                        }
                        main += end;
                        document.getElementById("gradesTable").innerHTML = main;
                        averages(id);
                        watermark(id);
                        // signatory();
                    }
                });

            }

function averages(id) {
    $.ajax({
        type: 'POST',
        url: 'averages.php',
        data: 'id=' + id,

        success: function(response) {

            var data = JSON.parse(response);
            // console.log(data);
            for (var i = 0; i < data.length; i++) {
                var levelid = data[i].levelid;
                var trimid = data[i].trimid;
                var cwa = Number(data[i].cwa).toFixed(2);
                var present = Number(data[i].present).toFixed(2);
                var progname = data[i].progname;

                var _prog = progname.split(" ");
                for (var a = 0; a < _prog.length; a++) {
                    var __prog = _prog[0];
                }

                if (levelid == '1' && trimid == '1') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa1").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa1").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa1").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa1").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa1").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa1").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa1").innerHTML = "GPA: " + present;
                                    // alert(present);
                                }
                                document.getElementById("cgpa1").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '1' && trimid == '2') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa2").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa2").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa2").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa2").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa2").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa2").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa2").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa2").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '1' && trimid == '3') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa3").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa3").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa3").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa3").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa3").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa3").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa3").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa3").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '2' && trimid == '1') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa4").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa4").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa4").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa4").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa4").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa4").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa4").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa4").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '2' && trimid == '2') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa5").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa5").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa5").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa5").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa5").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa5").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa5").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa5").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '2' && trimid == '3') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa6").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa6").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa6").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa6").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa6").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa6").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa6").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa6").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '3' && trimid == '1') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa7").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa7").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa7").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa7").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa7").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa7").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa7").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa7").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '3' && trimid == '2') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa8").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa8").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa8").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa8").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa8").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa8").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa8").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa8").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '3' && trimid == '3') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa9").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa9").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa9").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa9").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa9").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa9").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa9").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa9").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '4' && trimid == '1') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa10").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa10").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa10").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa10").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '4' && trimid == '2') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa11").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa11").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa11").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa11").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '4' && trimid == '3') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa12").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa12").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa12").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa12").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '5' && trimid == '1') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa13").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa13").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa13").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa13").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '5' && trimid == '2') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa14").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa14").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa14").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa14").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '5' && trimid == '3') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa15").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa15").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa15").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa15").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '6' && trimid == '1') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa16").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa16").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa16").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa16").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '6' && trimid == '2') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa17").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa17").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa17").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa17").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '6' && trimid == '3') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa18").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa18").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa18").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa18").innerHTML = "CGPA: " + cwa;
                        }
                    }
                }

                if (__prog == "DIPLOMA") {
                    if (cwa > 5) {
                        $(".label_cgpa").html("Final TWA:");
                        // $("#final_cgpa").html(final_cgpa);
                    } else {
                        $(".label_cgpa").html("Final CGPA:");
                    }
                } else {
                    if (cwa != "") {
                        if (cwa > 5) {
                            $(".label_cgpa").html("Final TWA:");
                        } else {
                            $(".label_cgpa").html("Final CGPA:");
                        }
                    }
                }

                if (__prog == "DIPLOMA") {
                    if (levelid == '2' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    } else if (levelid == '3' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }

                    }
                } else {
                    if (levelid == '4' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    } else if (levelid == '6' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }

                    }
                }


            }
        }
    });
}

function total_credits(id) {
    $.ajax({
        type: 'POST',
        url: 'total_credits.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json);
            var counter = 0;
            for (var i = 0; i < data.length; i++) {
                var levelid = data[i].levelid;
                var trimid = data[i].trimester;
                var tt = new Number(data[i].tt);
                var cc = tt;
                counter += cc;

                if (levelid == '1' && trimid == '1') {
                    document.getElementById("cc1").innerHTML = counter;
                } else if (levelid == '1' && trimid == '2') {
                    document.getElementById("cc2").innerHTML = counter;
                } else if (levelid == '1' && trimid == '3') {
                    document.getElementById("cc3").innerHTML = counter;
                } else if (levelid == '2' && trimid == '1') {
                    document.getElementById("cc4").innerHTML = counter;
                } else if (levelid == '2' && trimid == '2') {
                    document.getElementById("cc5").innerHTML = counter;
                } else if (levelid == '2' && trimid == '3') {
                    document.getElementById("cc6").innerHTML = counter;
                } else if (levelid == '3' && trimid == '1') {
                    document.getElementById("cc7").innerHTML = counter;
                } else if (levelid == '3' && trimid == '2') {
                    document.getElementById("cc8").innerHTML = counter;
                } else if (levelid == '3' && trimid == '3') {
                    document.getElementById("cc9").innerHTML = counter;
                } else if (levelid == '4' && trimid == '1') {
                    document.getElementById("cc10").innerHTML = counter;
                } else if (levelid == '4' && trimid == '2') {
                    document.getElementById("cc11").innerHTML = counter;
                } else if (levelid == '4' && trimid == '3') {
                    document.getElementById("cc12").innerHTML = counter;
                } else if (levelid == '5' && trimid == '1') {
                    document.getElementById("cc13").innerHTML = counter;
                } else if (levelid == '5' && trimid == '2') {
                    document.getElementById("cc14").innerHTML = counter;
                } else if (levelid == '5' && trimid == '3') {
                    document.getElementById("cc15").innerHTML = counter;
                } else if (levelid == '6' && trimid == '1') {
                    document.getElementById("cc16").innerHTML = counter;
                } else if (levelid == '6' && trimid == '2') {
                    document.getElementById("cc17").innerHTML = counter;
                } else if (levelid == '6' && trimid == '3') {
                    document.getElementById("cc18").innerHTML = counter;
                }
            }
        }
    })
}


        } //End of success
    })

            }

function print() {
    printJS({
        printable: 'printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "style.css"]
    })
}

            $("#uploadBtn").on('click', function() {
                document.getElementById("ucardBody").style.display = 'block';
                document.getElementById("rcardBody").style.display = 'none';

                document.getElementById("uploadBtn").style.display = 'none';
                document.getElementById("backBtn").style.display = 'block';
            })

            $("#backBtn").on('click', function() {
                document.getElementById("ucardBody").style.display = 'none';
                document.getElementById("rcardBody").style.display = 'block';

                document.getElementById("uploadBtn").style.display = 'block';
                document.getElementById("backBtn").style.display = 'none';
            })

            function template () {
                $("#templateModal").modal('show');
            }

            function refresh_results (id) {
                $("#ref_btn").html("Updating   <img src='../images/ellipse.gif' width='25px' height='25px'>");
                $.ajax({
                    type: 'POST',
                    url:'read_results.php',
                    data: 'Faculty='+id,

                    success: function(response) {
                        // console.log(response);
                        $("#ref_btn").html("Refresh Results");
                        new PNotify({
                            title: "Success",
                            text: response,
                            type: 'info',
                            styling: 'bootstrap3'
                        })

                    }

                })
            }

    function editResults (id) {
        $("#editModal").modal('show');
        $("#editfor").html(id);

        $("#editBtn").unbind('click').on('click', function () {
        // $("#showResultsTable").dataTable().fnDestroy();

        var form = document.querySelector("#resultsEditForm");
        var formdata = new FormData(form);
        formdata.append("id", id);

            $.ajax({
                type: 'POST',
                url: 'editResults.php',
                data: formdata,
                cache: false,
                processData: false,
                contentType: false,

                success: function(json) {
                    var data = JSON.parse(json);
                    var html = '';

                    for (var i = 0; i < data.length; i++) {
                        var assid = data[i].assid;
                        var code = data[i].coursecode1;
                        var credit = data[i].credits;
                        var mark = data[i].mark;
                        var title = data[i].course_title;
                        var session = data[i].session;

                        html += "<tr><td>"+code+"</td><td>"+title+"</td><td>"+credit+"</td><td>"+mark+"</td><td>"+session+"</td><td><img onclick='dele(\"" + id + "," + code + ","+assid+"\")' src='../images/delete-button.png' width='20px' height='20px'/></td></tr>";
                    }
                            $('#editModal').one('hidden.bs.modal', function() {
                                $('#resultseditModal').modal('show'); 
                            }).modal('hide');
                    $("#editResultsTable").html(html);
                    $("#editresfor").html(id);
                    $("#resultsEditForm").trigger('reset');
                    $("#editModal").modal('hide');

                }
            })
            })
    }

    function editAverages(id) {
        $("#editAverageModal").modal('show');
        $("#editAveragefor").html(id);

        $.ajax({
            type: 'POST',
            url: 'editAverage.php',
            data: 'id='+id,

            success: function(json) {
                console.log(json);
                var data = JSON.parse(json);
                var html = "";
                for (var i = 0; i < data.length; i++) {
                    var levelid = data[i].levelid;
                    var trim = data[i].trimid;
                    var cwa = data[i].cwa;
                    var present = data[i].present;

                    if(data[i].levelid == '1') {
                        var level = '100';
                    } else if(data[i].levelid == '2') {
                        var level = '200';
                    } else if(data[i].levelid == '3') {
                        var level = '300';
                    } else if(data[i].levelid == '4') {
                        var level = '400';
                    } else if(data[i].levelid == '5') {
                        var level = '500';
                    } else if(data[i].levelid == '6') {
                        var level = '600';
                    } else if(data[i].levelid == '7') {
                        var level = '700';
                    } else {
                        var level = data[i].levelid;
                    }

                    html += "<tr><td>"+level+"</td><td>"+trim+"</td><td>"+cwa+"</td><td>"+present+"</td><td><img onclick='deleAverage(\"" + id + "," + levelid + ","+trim+"\")' src='../images/delete-button.png' width='20px' height='20px'/></td></tr>";
                }
                $("#editAverageBody").html(html);
            }
        })
    }
        </script>

        <script type="text/javascript">
            function dele (id) {
                var params = id.split(",");
                var id = params[0];
                var code = params[1];
                var assid = params[2];
                $.ajax({
                    type: 'POST',
                    url: 'delCode.php',
                    data: 'id='+id+'&code='+code+'&assid='+assid,

                    success: function(response) {
                        if(response == 1) {
                            new PNotify({
                                title: 'Success',
                                text: 'Course Deleted',
                                type: 'success',
                                styling: 'bootstrap3'
                            })
                            // $("#resultseditModal").modal('hide');
                            // editResults(id);
                        } else {
                            new PNotify({
                                title: 'Error',
                                text: response,
                                type: 'error',
                                styling: 'bootstrap3'
                            })
                        }
                    } 
                })
            } 

            function deleAverage (id) {
                var params = id.split(",");
                var id = params[0];
                var level = params[1];
                var trim = params[2];
                $.ajax({
                    type: 'POST',
                    url: 'delAverage.php',
                    data: 'id='+id+'&lvl='+level+'&trim='+trim,

                    success: function(response) {
                        if(response == 1) {
                            new PNotify({
                                title: 'Success',
                                text: 'Average Deleted',
                                type: 'success',
                                styling: 'bootstrap3'
                            })
                            // $("#editAverageModal").modal('hide');
                        } else {
                            new PNotify({
                                title: 'Error',
                                text: response,
                                type: 'error',
                                styling: 'bootstrap3'
                            })
                        }
                    } 
                })
            }

            function watermark (studentid) {
                var value = '';
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'watermark.php',
                    data: 'id='+studentid,

                    success: function(json) {
                        if(json == 'Fake') {
                            document.getElementById("banner_row").style.visibility = 'visible';
                        } else {
                            document.getElementById("banner_row").style.visibility = 'hidden';
                        }
                    }
                })
            } 
        </script>

</body>

</html>
<?php
}else{
//  header('Location: ../1753');
    echo "<script type='text/javascript'>window.history.back()</script>";
}
?>

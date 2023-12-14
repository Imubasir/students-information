<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";

// require("../Db/connection.php");
// $user = $_SESSION['uname'];
// $sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '7' ";
// $result = mysqli_query($conn, $sql);
// if($result->num_rows>0){
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title."Edit Profile" ?></title>
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
    <link href="../vendor/jQuery-Smart-Wizard/styles/smart_wizard.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- Custom styling plus plugins -->
    <style type="text/css">
        .wizard_verticle .stepContainer {
            width: 80%;
            float: left;
            padding: 0 10px;
            height: 400px;
        }

        .actionBar {
            width: 100%;
            border-top: 1px solid #ddd;
            padding: 10px 5px;
            text-align: right;
            margin-top: 10px
        }

        .actionBar .buttonDisabled {
            cursor: not-allowed;
            pointer-events: none;
            opacity: .65;
            filter: alpha(opacity=65);
            box-shadow: none
        }

        .actionBar a {
            margin: 0 3px
        }

        .wizard_verticle .wizard_content {
            width: 80%;
            float: left;
            padding-left: 20px
        }

        .wizard_verticle ul.wizard_steps {
            display: table;
            list-style: none;
            position: relative;
            width: 20%;
            float: left;
            margin: 0 0 20px
        }

        .wizard_verticle ul.wizard_steps li {
            display: list-item;
            text-align: center
        }

        .wizard_verticle ul.wizard_steps li a {
            height: 80px
        }

        .wizard_verticle ul.wizard_steps li a:first-child {
            margin-top: 20px
        }

        .wizard_verticle ul.wizard_steps li a,
        .wizard_verticle ul.wizard_steps li:hover {
            display: block;
            position: relative;
            -moz-opacity: 1;
            filter: alpha(opacity=100);
            opacity: 1;
            color: #666
        }

        .wizard_verticle ul.wizard_steps li a:before {
            content: "";
            position: absolute;
            height: 100%;
            background: #ccc;
            top: 20px;
            width: 4px;
            z-index: 4;
            left: 49%
        }

        .wizard_verticle ul.wizard_steps li a.disabled .step_no {
            background: #ccc
        }

        .wizard_verticle ul.wizard_steps li a .step_no {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 100px;
            display: block;
            margin: 0 auto 5px;
            font-size: 16px;
            text-align: center;
            position: relative;
            z-index: 5
        }

        .progress.progress_sm,
        .progress.progress_sm .progress-bar {
            height: 10px !important
        }

        .step_no,
        .wizard_verticle ul.wizard_steps li a.selected:before {
            background: #34495E;
            color: #fff
        }

        .wizard_verticle ul.wizard_steps li a.done .step_no,
        .wizard_verticle ul.wizard_steps li a.done:before {
            background: #1ABB9C;
            color: #fff
        }

        .wizard_verticle ul.wizard_steps li:first-child a:before {
            left: 49%
        }

        .wizard_verticle ul.wizard_steps li:last-child a:before {
            left: 49%;
            left: auto;
            width: 0
        }

        .form_wizard .loader,
        .form_wizard .msgBox {
            display: none
        }

        span.section {
            display: block;
            width: 100%;
            padding: 0;
            margin-bottom: 20px;
            font-size: 21px;
            line-height: inherit;
            color: #333;
            border: 0;
            border-bottom-color: currentcolor;
            border-bottom-style: none;
            border-bottom-width: 0px;
            border-bottom: 1px solid #e5e5e5;
        }

        .col-md-6 {
            width: 70%;
            float: right;
            max-width: 100%;
        }

        label {
            display: -webkit-inline-box;
            margin-bottom: .5rem;
            line-height: 45px;
        }

        .form-horizontal .form-group {
            margin-right: -15px;
            margin-left: -15px;
            margin-bottom: 0;
        }

        #img-upload {
            width: 40%;
        }

        .btn-default.active.focus,
        .btn-default.active:focus,
        .btn-default.active:hover,
        .btn-default:active.focus,
        .btn-default:active:focus,
        .btn-default:active:hover,
        .open>.dropdown-toggle.btn-default.focus,
        .open>.dropdown-toggle.btn-default:focus,
        .open>.dropdown-toggle.btn-default:hover {
            color: #333;
            background-color: #d4d4d4;
            border-color: #8c8c8c;
        }

        .btn-default.active,
        .btn-default:active,
        .open>.dropdown-toggle.btn-default {
            background-image: none;
            color: #333;
            background-color: #e6e6e6;
            border-color: #adadad;
        }

        .btn.active,
        .btn:active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
        }

        .btn-default {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        [data-toggle=buttons]>.btn input[type=checkbox],
        [data-toggle=buttons]>.btn input[type=radio],
        [data-toggle=buttons]>.btn-group>.btn input[type=checkbox],
        [data-toggle=buttons]>.btn-group>.btn input[type=radio] {
            position: inherit;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
        }

        @media only screen and (max-width: 768px) {
            #identification {
                display: none;
            }
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
            <li class="nav-item dropdown active keep-open">
          <a class="nav-link dropdown-toggle index" href="#" id="home_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="dashboard_tab" class="dropdown-item active" href="../1753/"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>

            <a id="profile_tab" class="dropdown-item" href="../5503"><i class="fas fa-fw fa-user"></i> Profile</a>

            <a id="inbox_tab" class="dropdown-item" href="../3062"><i class="fas fa-fw fa-envelope"></i> Inbox</a>

            <a id="notification_tab" class="dropdown-item" href="../2365"><i class="far fa-bell"></i> Notification</a>                                   
          </div>
        </li>           
           <!--End of Dashboard-->

           <!--Undergraduate-->
           <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="undergraduate_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i>
            <span>Undergraduate</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="certification_tab" class="dropdown-item" href="../5525"> Certification</a>

            <a id="ug_course_tab" class="dropdown-item" href="../6693"> Courses</a>

            <a id="ug_enrollment_tab" class="dropdown-item" href="../5065"> Enrollments</a>

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
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>

                <!-- /.container-fluid -->

                <div class="card mb-3 animated fadeInRight">
                    <div class="card-header">
                        <i class="fas fa-fw fa-edit"></i>Edit Profile
                    </div>
                    <div class="card-body">

                        <!-- Tabs -->
                        <div id="wizard_verticle" class="form_wizard wizard_verticle">
                            <ul class="list-unstyled wizard_steps">
                                <li>
                                    <a href="#step-11">
                                        <span class="step_no">1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-22">
                                        <span class="step_no">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-33">
                                        <span class="step_no">3</span>
                                    </a>
                                </li>

                            </ul>

                            <div id="step-11">
                                <h2 class="StepTitle">Stage 1</h2>
                                <form id="FirstForm" name="prof" class="form-horizontal form-label-left form">

                                    <span class="section"><b>Personal Info</b></span>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3" for="first-name">First Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="first-name" required="required" name="first-name" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3" for="last-name">Last Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="last-name" name="last-name" required="required" class="form-control" disabled>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3">Gender</label>
                                        <div class="col-md-6 col-sm-6">
                                            <div id="gender" class="btn-group" data-toggle="buttons">
                                                <label id="m" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="gender" value="Male" disabled> &nbsp; Male &nbsp;
                                                </label>
                                                <label id="f" class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="gender" value="Female" disabled> Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3">Date Of Birth <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
<!--                                            <input id="birthday" class="date-picker form-control" required="required" name="dob" type="date" disabled>-->
                                            <input id="birthday" type="text" class="form-control" disabled>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div id="step-22" style="text-align: -webkit-center;">
                                <h2 class="StepTitle">Stage 2</h2>
                                <span class="section"><b>Upload Photo</b></span>
                                <form id="SecondForm" method="POST" action="" id="picForm" class="form" style="text-align: -moz-center;">
                                    <div style="width: 32%;" class="card">
                                        <div class="card-header">
                                            <strong class="card-title mb-3">Uploaded Photo</strong>
                                        </div>
                                        <div class="card-body" style="text-align: center">

                                            <img id="blah" src="<?php echo($_SESSION['picture']); ?>" width="220px" height="220px">

                                        </div>
                                    </div>
                                    <div class="input-group mb-3" style="width: 70%;">
                                        <input id="pic" type="file" class="form-control custom-file-label" name="file" onchange="readURL(this)" class="custom-file-label">
                                    </div>
                                </form>
                                <br>

                            </div>
                            <div id="step-33">
                                <h2 class="StepTitle">Stage 3</h2>
                                <span class="section"><b>Change Password</b></span>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-header"><b>Update Credentials</b></div>
                                        <div class="card-body card-block">
                                            <form id="ThirdForm" action="" method="post" class="form">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text">Username</div>
                                                        <input type="text" id="username" name="user" class="form-control" readonly="">
                                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text">Email</div>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="example@abc.com" disabled>
                                                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text">Password</div>
                                                        <input type="password" id="password" name="password" class="form-control">
                                                        <div class="input-group-text"><i class="fa fa-asterisk"></i></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text">Confirm Password</div>
                                                        <input type="password" id="password1" name="confirmPpassword" class="form-control">
                                                        <div class="input-group-text"><i class="fa fa-asterisk"></i></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- End SmartWizard Content -->
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
        <!-- FullCalendar -->
        <script src="../vendor/moment/min/moment.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../vendor/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
        <script src="../js/custom.min.js"></script>
        <script src="../js/cleanup.js"></script>
        <script src="../js/access.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                keep_open("keep-open,index");
            });

        </script>

        <script type="text/javascript">
            function readURL(input) {
                // alert(input.files);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>
        <script type="text/javascript">
            $(document).ready(function() {

                $.ajax({
                    type: 'POST',
                    url: 'profile_edit_conn.php',
                    dataType: 'text',

                    success: function(response) {
                        var data = JSON.parse(response);

                        for (var i = 0; i < data.length; i++) {
                            var fname = data[i].first_name;
                            var lname = data[i].last_name;
                            var dob = moment(data[i].dob).format("DD-MMM-YYYY");
                            var gender = data[i].gender;
                            var email = data[i].email;
                            var user = data[i].username;
                            var pass = data[i].password;
                            var pic = data[i].picture;
                        }

                        document.getElementById("first-name").value = fname;
                        document.getElementById("last-name").value = lname;
                        document.getElementById("birthday").value = dob;
                        if (gender == 'Male') {
                            $("#m").addClass('active');
                            document.prof.gender.value = gender;
                        } else if (gender == 'Female') {
                            $("#f").addClass('active');
                            document.prof.gender.value = gender;
                        }
                        document.getElementById("username").value = user
                        document.getElementById("email").value = email;
                        document.getElementById("password").value = pass;

                    }
                });
            });

        </script>

        <script type="text/javascript">
            function update() {
                var formtwo = document.getElementById("SecondForm");

                var email = document.getElementById("email").value;
                var pass = document.getElementById("password").value;
                var confirmPass = document.getElementById("password1").value;
                var gender = document.prof.gender.value;

                if (confirmPass == pass) {
                    var formData = new FormData(formtwo);
                    formData.append("gender", gender);
                    formData.append("email", email);
                    formData.append("pass", pass);

                    $.ajax({
                        type: 'POST',
                        url: 'profile_update.php',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,

                        success: function(response) {
                            //console.log(response);
                            if (response == 1) {
                                new PNotify({
                                    title: 'Success',
                                    text: 'Biodata Updated Successfully',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                            } else {
                                new PNotify({
                                    title: 'Error',
                                    text: response,
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });
                            }
                        }
                    });
                } else {
                    new PNotify({
                        title: 'Error',
                        text: 'Passwords Do Not Match',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                }

            }

        </script>

</body>

</html>

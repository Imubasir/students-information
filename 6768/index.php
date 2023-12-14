<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";

require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '14' ";
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

    <title><?php echo $title."Undergraduate Services" ?></title>
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
    <link href="index.css" rel="stylesheet" type="text/css">

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <link href="transcript.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/added_design.css">
    <!--    <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet" type="text/css">-->
    <!-- Custom styling plus plugins -->
    <link href="english_prof.css" rel="stylesheet" type="text/css">

    <style>
        /*td {
            text-align: center;
      }*/
        .supp {
            width: -moz-available;
            /*border-radius: 20px;*/
        }

        article {
            font-size: 25px;
        }

        td .cat:hover {
            box-shadow: 10px 10px 8px white;
        }

        .details_header1 {
            padding: 20px;
            border-left: 5px solid green;
            color: green;
        }

        .details_header2 {
            padding: 20px;
            border-right: 5px solid red;
            color: red;
            text-align: right;
        }

        .details_header3 {
            padding: 20px;
            border-left: 5px solid #1ab394;
            ;
            color: #1ab394;
            ;
        }

        .panel-heading {
            text-decoration: none;
            border: 1px solid #f1f1f1;
            background-color: #efeded;
            padding-left: 5px;
        }

        .panel-title a {
            color: #29690c;
        }

        .panel-body {
            border: 2px solid #f1f1f1;
            font-size: 18px;
            padding: 10px;

        }

        .mail_list_column,
        .mail_view {
            border-left: 1px solid #DBDBDB;
            overflow-y: scroll;
            height: 400px;
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

        #letter_banner {
            position: absolute;
            top: 50%;
            left: 20%;
            color: red;
            font-size: 100px;
            opacity: 0.5;
            pointer-events: none;
            -webkit-transform: rotate(-40deg);
            -moz-transform: rotate(-40deg);
        }

        #intro_letter_banner {
            position: absolute;
            top: 50%;
            left: 20%;
            color: red;
            font-size: 100px;
            opacity: 0.5;
            pointer-events: none;
            -webkit-transform: rotate(-40deg);
            -moz-transform: rotate(-40deg);
        }

        #con_letter_banner {
            position: absolute;
            top: 50%;
            left: 20%;
            color: red;
            font-size: 100px;
            opacity: 0.5;
            pointer-events: none;
            -webkit-transform: rotate(-40deg);
            -moz-transform: rotate(-40deg);
        }

        #watermark
{
 position:absolute;
 margin-left:  35%;
 opacity:0.05;
 z-index:99;
 color:white;
}

        /*#uds_watermark {
        position: absolute;
        top: 30%;
        left: 20%;
        /*color: red;*/
        /*font-size: 100px;*/
        /*opacity: 0.5;*/
        /*pointer-events: none;*/
        /*-webkit-transform: rotate(-40deg);
        -moz-transform: rotate(-40deg);*/
        /*}*/
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
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a id="dashboard_tab" class="dropdown-item" href="../1753/"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>

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
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
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
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a id="pg_certification_tab" class="dropdown-item" href="../1326"> Certification</a>

                    <a id="pg_course_tab" class="dropdown-item" href="../3394"> Courses</a>

                    <a id="pg_enrollment_tab" class="dropdown-item" href="../3655"> Enrollments</a>

                    <a id="pg_programme_tab" class="dropdown-item" href="../7738"> Programmes</a>

                    <a id="pg_result_tab" class="dropdown-item" href="../5997"> Results</a>
                </div>
            </li>
            <!--End of Postgraduate-->

            <!--Transcript-->
            <li class="nav-item dropdown active keep-open">
                <a class="nav-link dropdown-toggle index" href="#" id="services_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-archive"></i>
                    <span>Services</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a id="ug_services_tab" class="dropdown-item active" href="../6768">UG Services</a>

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
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
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
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a id="campus_tab" class="dropdown-item" href="../7673"><i class="far fa-building"></i> Campus</a>

                    <a id="uni_halls" class="dropdown-item" href="../6540"><i class="fas fa-hotel"></i> University Halls</a>

                    <a id="course_tab" class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

                    <a id="department_tab" class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>

                    <a id="programme_tab" class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>

                    <a id="upload_tab" class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

                    <a id="edit_tab" class="dropdown-item" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

                    <a id="gen_edit" class="dropdown-item" href="../8081"><i class="fas fa-edit"></i> General Edits</a>

                    <a id="users_tab" class="dropdown-item" href="../1242"><i class="fas fa-user-plus"></i> Users</a>

                    <a id="log_tab" class="dropdown-item" href="../8015"><i class="fas fa-fw fa-clock"></i> Log</a>
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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <!-- /.container-fluid -->

                <div class="card mb-3 animated fadeInRight">
                    <div class="_card-header">
                        <span style="float: right;margin-right: 5%;">

                            <ul id="ol" style="width: -moz-fit-content;">
                                <li id="requests"> Requests</li>

                                <li id="issued"> Issued</li>

                                <li id="reported" style="border-right: none;"> Reported</li>

                            </ul>
                        </span> <span style="font-size: 25px;font-weight:bold;color: white">Assigned Tasks</span> <small style="font-size: 15px;color: white">Undergraduate Transcripts</small>
                    </div>
                    <div class="card-body" id="main_trans">
                        <div class="responsive">
                            <span>
                                <button id="flag_btn" onclick="view_flagged()" class="btn btn-sm btn-info" style="float: right;">View Flagged</button>
                                <div class='dropdown' style="float: right;"><button class='btn btn-sm btn-danger dropdown-toggle' type='button' data-toggle='dropdown'>Back Cover<span class='caret'></span></button>
                                    <ul class='dropdown-menu'>
                                        <li class='dropdown-item'><a onclick='bsc()'>Bachelor &amp; Diploma</a></li>
                                        <li class='dropdown-item'><a onclick='dmls()'>Medical Laboratory Science</a></li>
                                    </ul>
                                </div>
                            </span>
                            <table class="table table-hover table-striped" id="reqTable">
                                <!-- <button class="btn btn-sm btn-success" onclick="addRequest()">Add Request</button><br><br> -->
                                <caption style="caption-side: top;font-weight: bold;color: black;">Transcript Requests</caption>
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Type of Service</th>
                                        <th>Date Submitted</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sigBody" style="text-transform: uppercase;">

                                </tbody>
                            </table>
                        </div>
                        <div id="load_1" style="text-align: center;">
                            <img src='../images/Cube.gif' width="100px" height="100px">
                        </div>
                    </div>

                    <!--            View Service Details-->
                    <div id="trans_details" class="card-body" style="display:none;">
                        <span style="float: right;"><button id="report_btn" class="reply btn btn-sm btn-danger">Report Issue</button></span><button onclick="back()" class="btn btn-sm btn-danger"><i class="fas fa-angle-left"></i> Back</button>
                        <br>
                        <div class="responsive">
                            <table class="table table-hover table-striped" id="service_tbl">
                                <caption style="caption-side: top;font-weight: bold;color: black;">Service Details</caption>
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Service Type</th>
                                        <th>Quantity</th>
                                        <th>Mode of Delivery</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="detBody" style="text-transform: uppercase;">

                                </tbody>
                            </table>
                        </div>
                        <div id="load_2" style="text-align: center;">
                            <img src='../images/Cube.gif' width="100px" height="100px">
                        </div>
                    </div>

                    <!-- Issued Services -->
                    <div class="card-body" id="issued_table" style="display:none;">
                        <div class="responsive">
                            <table class="table table-hover table-striped" id="issTable">
                                <caption style="caption-side: top;font-weight: bold;color: black;">Issued Transcripts</caption>
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Services</th>
                                        <th>Date Issued</th>
                                        <th>Issued By</th>
                                    </tr>
                                </thead>
                                <tbody id="issBody" style="text-transform:uppercase;">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Reported Issues -->
                    <div class="card-body" id="reported_table" style="display:none;">
                        <div class="responsive">
                            <table class="table table-hover table-striped" id="repTable">
                                <caption style="caption-side: top;font-weight: bold;color: black;">Reported Issues</caption>
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Reported By</th>
                                        <th>Date Reported</th>
                                    </tr>
                                </thead>
                                <tbody id="repBody">

                                </tbody>
                            </table>
                        </div>
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

        <!-- Bachelor and Diploma Back Modal-->
        <div class="modal fade" id="bscBackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Print Back</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="print_bsc">
                        <div id="back_container" style="color: black;text-align: justify;font-family: 'new times roman';font-size:20px">
                            <div style="text-align: justify;width: 80%;margin-left: 10%;">
                                <h2 style="text-align: center"><b>GRADING SYSTEM</b></h2>
                                <p><b>NB:</b> The Cummulative Weighted Average (<b>CWA</b>) grading system was used by the University until the <b>2007/2008</b> academic year. Since then, the Cummulative Grade Point Average (<b>CGPA</b>) grading system is being used. All transcripts with the <b>CWA</b> grading system are still valid.</p>

                            </div>

                            <table style="width: 100%;border: 1px solid black;border-collapse: separate;border-spacing: 0;padding: 10px;">
                                <tr>
                                    <td style="border-right: 1px solid black;text-align: center;"><b>CWA</b></td>
                                    <td style="text-align: center;"><b>CGPA</b></td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;">
                                        <b>CLASS DESIGNATION</b>
                                        <br />
                                        <br />
                                        <b>Bachelor's Degree</b><br />
                                        <table>
                                            <tr>
                                                <td>70% &amp; Above</td>
                                                <td>-</td>
                                                <td>1<sup>st</sup> Class Honours</td>
                                            </tr>
                                            <tr>
                                                <td>60% - 69%</td>
                                                <td>-</td>
                                                <td>2<sup>nd</sup> Class Honour (Upper Disision)</td>
                                            </tr>
                                            <tr>
                                                <td>50% - 59%</td>
                                                <td>-</td>
                                                <td>2<sup>nd</sup> Class Honours (Lower Division)</td>
                                            </tr>
                                            <tr>
                                                <td>45% - 49%</td>
                                                <td>-</td>
                                                <td>3<sup>rd</sup> Class Honours</td>
                                            </tr>
                                            <tr>
                                                <td>40% - 44%</td>
                                                <td>-</td>
                                                <td>Pass</td>
                                            </tr>
                                            <tr>
                                                <td>Below 40%</td>
                                                <td>-</td>
                                                <td>Fail</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <b>CLASS DESIGNATION</b>
                                        <br />
                                        <br />
                                        <b>Bachelor's Degree</b><br />
                                        <table>
                                            <tr>
                                                <td>4.50 &amp; Above</td>
                                                <td>-</td>
                                                <td>1<sup>st</sup> Class Honours</td>
                                            </tr>
                                            <tr>
                                                <td>3.50 - 4.49</td>
                                                <td>-</td>
                                                <td>2<sup>nd</sup> Class Honour (Upper Disision)</td>
                                            </tr>
                                            <tr>
                                                <td>2.50 - 3.49</td>
                                                <td>-</td>
                                                <td>2<sup>nd</sup> Class Honours (Lower Division)</td>
                                            </tr>
                                            <tr>
                                                <td>2.00 - 2.49</td>
                                                <td>-</td>
                                                <td>3<sup>rd</sup> Class Honours</td>
                                            </tr>
                                            <tr>
                                                <td>1.50 - 1.99</td>
                                                <td>-</td>
                                                <td>Pass</td>
                                            </tr>
                                            <tr>
                                                <td>Below 1.50</td>
                                                <td>-</td>
                                                <td>Fail</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;"><br /></td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;">
                                        <b>Diploma</b><br />
                                        <table>
                                            <tr>
                                                <td>70% &amp; Above</td>
                                                <td>-</td>
                                                <td>Distinction</td>
                                            </tr>
                                            <tr>
                                                <td>40% - 69%</td>
                                                <td>-</td>
                                                <td>Pass</td>
                                            </tr>
                                            <tr>
                                                <td>Below 40%</td>
                                                <td>-</td>
                                                <td>Fail</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <b>Diploma</b><br />
                                        <table>
                                            <tr>
                                                <td>4.5 &amp; Above</td>
                                                <td>-</td>
                                                <td>Distinction</td>
                                            </tr>
                                            <tr>
                                                <td>1.50 - 4.49</td>
                                                <td>-</td>
                                                <td>Pass</td>
                                            </tr>
                                            <tr>
                                                <td>Below 1.50</td>
                                                <td>-</td>
                                                <td>Fail</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;"><br /></td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;">
                                        <b>GLOSSARY</b><br />
                                        <table>
                                            <tr>
                                                <td>*</td>
                                                <td>-</td>
                                                <td>Trail</td>
                                            </tr>
                                            <tr>
                                                <td>**</td>
                                                <td>-</td>
                                                <td>Retaken</td>
                                            </tr>
                                            <tr>
                                                <td>CC</td>
                                                <td>-</td>
                                                <td>Cummulative Credits</td>
                                            </tr>
                                            <tr>
                                                <td>TWA</td>
                                                <td>-</td>
                                                <td>Trimester Weighted Average</td>
                                            </tr>
                                            <tr>
                                                <td>CWA</td>
                                                <td>-</td>
                                                <td>Cummulative Weighted Average</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <b>GLOSSARY</b><br />
                                        <table>
                                            <tr>
                                                <td>*</td>
                                                <td>-</td>
                                                <td>Trail</td>
                                            </tr>
                                            <tr>
                                                <td>**</td>
                                                <td>-</td>
                                                <td>Retaken</td>
                                            </tr>
                                            <tr>
                                                <td>CC</td>
                                                <td>-</td>
                                                <td>Cummulative Credits</td>
                                            </tr>
                                            <tr>
                                                <td>GPA</td>
                                                <td>-</td>
                                                <td>Grade Point Average</td>
                                            </tr>
                                            <tr>
                                                <td>CGPA</td>
                                                <td>-</td>
                                                <td>Cummulative Grade Point Average</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;"><br /></td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;">
                                        <b>PASS GRADES</b><br />
                                        <table style="width: 100%;">
                                            <tr>
                                                <td>A</td>
                                                <td>-</td>
                                                <td>70% &amp; Above</td>
                                                <td>Excellent</td>
                                            </tr>
                                            <tr>
                                                <td>B</td>
                                                <td>-</td>
                                                <td>60 -69%</td>
                                                <td>Very Good</td>
                                            </tr>
                                            <tr>
                                                <td>C</td>
                                                <td>-</td>
                                                <td>50 -59%</td>
                                                <td>Good</td>
                                            </tr>
                                            <tr>
                                                <td>D</td>
                                                <td>-</td>
                                                <td>40 -49%</td>
                                                <td>Satisfactory</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <b>PASS GRADES</b><br />
                                        <table style="width: 100%;">
                                            <thead>
                                                <th>Grade</th>
                                                <th>Value</th>
                                                <th>Score</th>
                                                <th>Remarks</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>A+</td>
                                                    <td>5</td>
                                                    <td>80% &amp; Above</td>
                                                    <td>Excellent</td>
                                                </tr>
                                                <tr>
                                                    <td>A</td>
                                                    <td>4.5</td>
                                                    <td>70%- 79.99%</td>
                                                    <td>Excellent</td>
                                                </tr>
                                                <tr>
                                                    <td>B+</td>
                                                    <td>4</td>
                                                    <td>65- 69.99%</td>
                                                    <td>Very Good</td>
                                                </tr>
                                                <tr>
                                                    <td>B</td>
                                                    <td>3.5</td>
                                                    <td>60 -64.99%</td>
                                                    <td>Very Good</td>
                                                </tr>
                                                <tr>
                                                    <td>C+</td>
                                                    <td>3</td>
                                                    <td>55 -59.99%</td>
                                                    <td>Good</td>
                                                </tr>
                                                <tr>
                                                    <td>C</td>
                                                    <td>2.5</td>
                                                    <td>50 -54.99%</td>
                                                    <td>Good</td>
                                                </tr>
                                                <tr>
                                                    <td>D+</td>
                                                    <td>2</td>
                                                    <td>45 -49.99%</td>
                                                    <td>Satisfactory</td>
                                                </tr>
                                                <tr>
                                                    <td>D</td>
                                                    <td>1.5</td>
                                                    <td>40 -44.99%</td>
                                                    <td>Satisfactory</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;"><br /></td>
                                </tr>

                                <tr>
                                    <td style="border-right: 1px solid black;">
                                        <b>FAILURE GRADE</b><br />
                                        <table style="width: 100%;">
                                            <tr>
                                                <td>F</td>
                                                <td>-</td>
                                                <td>0 -39%</td>
                                                <td>Fail</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <b>FAILURE GRADE</b><br />
                                        <table style="width: 100%;">
                                            <thead>
                                                <th>Grade</th>
                                                <th>Value</th>
                                                <th>Score</th>
                                                <th>Remarks</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>F</td>
                                                    <td>0</td>
                                                    <td>0 -39.99%</td>
                                                    <td>Fail</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>


                            </table>
                            <div style="text-align: justify;width: 80%;margin-left: 10%;">
                                <p>* The Authenticity of this transcript may be checked from the Academic Affairs Office, University for Development Studies, Central Administration, Tamale.</p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button onclick="printBSC()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- DMLS Back Modal-->
        <div class="modal fade" id="dmlsBackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="print_dmls">
                        <div id="back_container" style="color: black;text-align: justify;font-family: 'new times roman';font-size:20px;width: 90%;margin-left: 5%;margin-top:5%;">
                            <div style="text-align: justify;width: 90%;margin-left: 5%;">
                                <h4 style="text-align: center;font-size: 25px"><b>GRADING SYSTEM</b></h4><br />
                                <h4 style="text-align: center;font-size: 25px"><b>FOR DOCTOR OF MEDICAL LABORATORY SCIENCE (MLS.D)<sup>*</sup></b></h4>
                            </div>

                            <table style="width: 100%;border: 1px solid black;border-collapse: separate;border-spacing: 0;padding: 50px;">
                               
                                <tr>
                                    
                                    <td style="padding-left: 10px;">
                                        <h4><b>CLASS DESIGNATION</b></h4>
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 10%">4.50 &amp; Above</td>
                                                <td style="width: 5%">-</td>
                                                <td style="width: 20%">Distinction</td>
                                            </tr>
                                            <tr>
                                                <td>3.50 - 4.49</td>
                                                <td>-</td>
                                                <td>Credit</td>
                                            </tr>
                                            <tr>
                                                <td>2.50 - 3.49</td>
                                                <td>-</td>
                                                <td>Good</td>
                                            </tr>
                                            <tr>
                                                <td>2.00 - 2.49</td>
                                                <td>-</td>
                                                <td>Pass</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><br /></td>
                                            </tr>
                                            <tr>
                                                <td>Below 2.0</td>
                                                <td>-</td>
                                                <td>Fail</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td><br /></td>
                                </tr>
                                
                                <tr>
                                    <td style="padding-left: 10px;">
                                        <h4><b>GLOSSARY</b></h4>
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 10%">*</td>
                                                <td style="width: 5%">-</td>
                                                <td style="width: 20%">Trail</td>
                                            </tr>
                                            <tr>
                                                <td>**</td>
                                                <td>-</td>
                                                <td>Retaken</td>
                                            </tr>
                                            <tr>
                                                <td>CC</td>
                                                <td>-</td>
                                                <td>Cummulative Credits</td>
                                            </tr>
                                            <tr>
                                                <td>GPA</td>
                                                <td>-</td>
                                                <td>Grade Point Average</td>
                                            </tr>
                                            <tr>
                                                <td>CGPA</td>
                                                <td>-</td>
                                                <td>Cummulative Grade Point Average</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td><br /></td>
                                </tr>

                                <tr>
                                    <td style="padding-left: 10px;">
                                        <h4><b>PASS GRADES</b></h4>
                                        <table style="width: 100%;">
                                            <thead>
                                                <th style="width: 25%">Grade</th>
                                                <th style="width: 25%">Value</th>
                                                <th style="width: 25%">Score</th>
                                                <th style="width: 25%">Remarks</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>A</td>
                                                    <td>5.0</td>
                                                    <td>75% &amp; Above</td>
                                                    <td>Distinction</td>
                                                </tr>
                                                <tr>
                                                    <td>B</td>
                                                    <td>4.0</td>
                                                    <td>65 -74.99%</td>
                                                    <td>Credit</td>
                                                </tr>
                                                <tr>
                                                    <td>C</td>
                                                    <td>3.0</td>
                                                    <td>60 -64.99%</td>
                                                    <td>Good</td>
                                                </tr>
                                                <tr>
                                                    <td>D</td>
                                                    <td>2.0</td>
                                                    <td>50 -59.99%</td>
                                                    <td>Pass</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td><br /></td>
                                </tr>

                                <tr>
                                    <td style="padding-left: 10px;">
                                        <h4><b>FAILURE GRADE</b></h4>
                                        <table style="width: 100%;">
                                            <thead>
                                                <th style="width: 25%">Grade</th>
                                                <th style="width: 25%">Value</th>
                                                <th style="width: 25%">Score</th>
                                                <th style="width: 25%">Remarks</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>F</td>
                                                    <td>0</td>
                                                    <td>0 -49.99%</td>
                                                    <td>Fail</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>


                            </table>
                            <br />
                            <br />
                            <div style="text-align: justify;width: 90%;margin-left: 5%;">
                                <p>* The Authenticity of this transcript may be checked from the Academic Affairs Office, University for Development Studies, Central Administration, Tamale.</p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button onclick="printDMLS()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Flag Modal-->
        <div class="modal fade" id="flagged" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Flagged Requests</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="responsive">
                            <table class="table table-hover table-striped" id="flagTable">

                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Type of Service</th>
                                        <th>Date Submitted</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="flagBody" style="text-transform: uppercase;">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>



        <!-- Report Issue Modal-->
        <div class="modal fade" id="report_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report Issue</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="report_form">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" name="transac_id" id="transac_id" class="form-control" readonly="">
                                    <label>Transaction ID</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" name="sid" id="sid" class="form-control" readonly="">
                                    <label>Index Number</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" name="name" id="name" class="form-control" readonly="">
                                    <label>Name</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="report_content" id="report_content" class="form-control" style="height: 100px" placeholder="Type Issue to Report!!!"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button onclick="" class="btn btn-primary btn-sm">Report</button>

                    </div>
                </div>
            </div>
        </div>


        <!-- Transcript Modal-->
        <div class="modal fade" id="transcriptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Transcript</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="print_trans" style="padding: 10px;margin-left: 2%;padding-right: 30px;">
                        <table style="width: 100%">
                            <thead id="main_thead">

                                <tr style="line-height: initial;border-bottom: 2px solid black;">
                                    <td style="width:125px;height:104px"><img src="../images/uds_logo.png" alt="img" width="130px" height="130px" /></td>
                                    <td colspan="3" class="style1">
                                        <div style="text-align:center;margin-left: -100px"><span class="style53">UNIVERSITY FOR DEVELOPMENT STUDIES</span><br>
                                            <span class="style53">Academic Affairs Section</span><br>
                                            <span class="style2"><span class="style54">P.O. Box TL 1350 Tamale, Ghana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tel: 03720-93382/26633/26634</span><br>
                                                <span class="style54">Web: <span class="style52">www.uds.edu.gh &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="style6">Email:</span> academicaffairs@uds.edu.gh</span><span class="style55"></span><br>

                                                    <span class="style4">TRANSCRIPT OF ACADEMIC RECORD</span></span></span></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="profile_label">Name: </td>
                                    <td class="profile_data"><span id="trans_name"></span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td class="profile_label">Index Number: </td>
                                    <td class="profile_data"><span id="trans_indexno"></span></td>
                                </tr>
                                <tr>
                                    <td class="profile_label">Degree Awarded:</td>
                                    <td class="profile_data"><span id="awarded"></span></td>
                                    <td class="profile_label">Date of Birth:</td>
                                    <td class="profile_data"><span id="dob"></span></td>
                                </tr>
                                <tr>
                                    <td class="profile_label">Major: </td>
                                    <td class="profile_data"><span id="trans_major"></span></td>
                                    <td class="profile_label">Sex: </td>
                                    <td class="profile_data"><span id="gender"></span></td>
                                </tr>
                                <tr>
                                    <td class="profile_label label_cgpa">Final CGPA: </td>
                                    <td class="profile_data"><span id="trans_cgpa"></span></td>
                                    <td class="profile_label">Date of Award: </td>
                                    <td class="profile_data"><span id="date_awarded"></span></td>
                                </tr>
                                <tr>
                                    <td class="profile_label">Class: </td>
                                    <td class="profile_data"><span id="trans_class"></span></td>
                                    <td class="profile_label">Date Printed: </td>
                                    <td class="profile_data"><span id="trans_print_date"></span></td>
                                </tr>

                                <!-- <tr id="banner_row" style="visibility: hidden;">
                                    <td colspan="5">
                                        <div id="banner" style="border: 3px solid red;padding: 5px;text-align: center;letter-spacing: 20px;border-radius: 10px;"></div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td style="text-align: center;margin-top: 20%;" colspan="6" id="watermark"><img src="../images/uds_logo.png" height="500px" width="500px"></td>
                                </tr>
                            </thead>

                            <tbody id="trans_tbl_body">
                                <tr>
                                    
                                    <td colspan="4">
                                        <table id="inner_table">

                                            <tbody style="color: black;text-transform: uppercase;font-family: verdana, arial, helvetica, sans-serif;font-size: small;">
                                                
                                                <tr>

                                                    <td colspan="6" id="trancriptTable">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">

                                        <div class="row">
                                            <div class="col-6" style="text-align: right;color: black;font-weight: bold;">
                                                <span class="label_cgpa">Final CGPA: </span><br>
                                                Class:
                                            </div>
                                            <div class="col-6" style="text-align: left;color: black;font-weight: bold;">
                                                <span id="final_cgpa"></span><br>
                                                <span id="final_class"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div style='text-align: center;color: black;'><span id='signed_for' style="font-weight: bold;"></span><br>For: Registrar</div>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="padding: 20px">
                                        <div id='qrcode' style='float:right;'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-weight: bold;color: black">NB: <br> USE BARCODE FOR VERIFICATION</td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button id="main_print_btn" onclick="print();" class="btn btn-primary btn-sm">Print</button>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- English Prof Modal-->
    <div class="modal fade" id="profModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Engish Proficiency Letter</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="printable" class="modal-body" style="color: black;font-family: 'times new roman'">
                    <div class='row'>
                        <div class="header" style="font-weight: bolder;color: #0B6F10;">
                            <span id="head_one">UNIVERSITY FOR DEVELOPMENT STUDIES</span>
                            <h2>(OFFICE OF THE REGISTRAR)</h2>
                            <h3>CENTRAL ADMINISTRATION</h3>
                        </div>
                    </div>

                    <table class="table" id="con_table" style="font-size: 20px;color: black;font-weight: bold">
                        <tr>
                            <td style="width: 5%">
                                <span style="color: darkgreen;font-weight: bold">Tel:</span>
                            </td>
                            <td style="width: 35%;padding-left: 10px">
                                +233-372-93382, 26634, 93382
                            </td>

                            <td rowspan="3">
                                <img src="../images/uds.png" width="180px" height="180px">
                            </td>
                            <td style="width: 5%">

                            </td>
                            <td style="width: 35%">
                                <span>P. O. Box TL 1350</span>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold">Web:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="www.uds.edu.gh">www.uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span>Tamale, Ghana</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold;">Email:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span style="font-weight: bold;"></span><?php echo date("F d, Y") ?>
                            </td>
                        </tr>

                        <tr class="letter_banner_row" style="visibility: hidden;">
                            <td colspan="5">
                                <div class="letter_banner" style="border: 3px solid red;padding: 5px;text-align: center;letter-spacing: 20px;border-radius: 10px;"></div>
                            </td>
                        </tr>
                    </table>

                    <div class="row row_ row__">
                        <div class="col-6">
                            <span style="font-weight: bold;">Our Ref: </span><span style="font-weight: bold" id="con_id"></span><br>
                            <span style="font-weight: bold;">Your Ref: </span><span style="font-weight: bold" id="your_ref"></span>
                        </div>
                    </div>
                    <br>

                    <div style="text-align: center;">
                        <img src="../images/divider.png" style="margin-top:-10px;width: 100%">
                    </div>
                    <div style="text-align: center;" class="row row_ row__">
                        <div class="col-12">
                            <strong>
                                <h4 style="display:block;text-decoration:underline;font-weight: bolder;font-size: 20px;">TO WHOM IT MAY CONCERN</h4>
                            </strong>
                            <strong>
                                <h4 style="text-decoration:underline;font-weight: bolder;font-size: 20px;">ENGLISH PROFICIENCY</h4>
                            </strong>
                        </div>
                    </div>

                    <div class="row row_ row__">
                        <div class="col-12">
                            <p>This is to certify that <strong><span class="name"></span></strong> attended the University for Development Studies in Ghana where English is the medium of instruction for the <strong><span class="progfullname" style="text-transform: uppercase;"></span></strong> programme and all other courses in the University.</p>

                            <p>
                                <strong><span class="name"></span></strong> also passed all <span class="gender"></span> courses that were examined in the English Language throughout <span class="gender"></span> <span class="years"></span> stay in the University.
                            </p>

                            <p>
                                I therefore recommend that <strong><span class="name"></span></strong> be permitted to undertake any course where the medium of instruction is the English Language since I do not doubt <span class="gender"></span> proficiency in the language.
                            </p>

                            <p>
                                Counting on your usual co-operation.
                            </p>
                            <p>
                                Thank you.
                            </p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row row_" style="font-size: 20px;line-height: 30px;">
                        <div class="col-12">
                            <span style="display:block;text-align:left" class="signatory"></span>
                            <span style="display:block;text-align:left">for: Registrar</span>
                        </div>
                    </div>

                    <div>
                        <div id='qrcode_3' style='float:right;letter-spacing: 10px'></div>
                    </div>
                    <br><br><br><br><br>
                    <div style="color: black;font-weight: bold;">NB: <br>USE BARCODE FOR VERIFICATION</div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button onclick="print_english();" id="print_english" class="btn btn-primary btn-sm">Print</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Confirmatory Modal-->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation Letter</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="con_printable" style="font-family: 'times new roman'">
                    <div class='row'>
                        <div class="header" style="font-weight: bold;color: #0B6F10;">
                            <span id="head_one">UNIVERSITY FOR DEVELOPMENT STUDIES</span>
                            <h2>(OFFICE OF THE REGISTRAR)</h2>
                            <h3>CENTRAL ADMINISTRATION</h3>
                        </div>
                    </div>

                    <table class="table" id="con_table" style="font-size: 20px;color: black;font-weight: bold">
                        <tr>
                            <td style="width: 5%">
                                <span style="color: darkgreen;font-weight: bold">Tel:</span>
                            </td>
                            <td style="width: 35%;padding-left: 10px">
                                +233-372-93382, 26634, 93382
                            </td>

                            <td rowspan="3">
                                <img src="../images/uds.png" width="180px" height="180px">
                            </td>
                            <td style="width: 5%">

                            </td>
                            <td style="width: 35%">
                                <span>P. O. Box TL 1350</span>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold">Web:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="www.uds.edu.gh">www.uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span>Tamale, Ghana</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold;">Email:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span style="font-weight: bold;"></span><?php echo date("F d, Y") ?>
                            </td>
                        </tr>

                        <tr id="con_letter_banner_row" style="visibility: hidden;">
                            <td colspan="5">
                                <div id="con_letter_banner" style="border: 3px solid red;padding: 5px;text-align: center;letter-spacing: 20px;border-radius: 10px;"></div>
                            </td>
                        </tr>
                    </table>

                    <div class="row row_ row__">
                        <div class="col-6">
                            <span style="font-weight: bold;">Our Ref: </span><span style="font-weight: bold" class="con_id"></span><br>
                            <span style="font-weight: bold;">Your Ref: </span><span style="font-weight: bold" id="your_ref"></span>
                        </div>
                    </div>
                    <br>

                    <div>
                        <img src="../images/divider.png" style="margin-top:-10px;width: 100%">
                    </div>
                    <div style="text-align: center;" class="row row_ row__">
                        <div class="col-12">
                            <span style="text-decoration: underline;text-decoration-skip-ink: none;font-weight: bolder;font-size: 20px;color: black">CONFIRMATION LETTER: <span class="con_name"></span></span>
                        </div>
                    </div>

                    <div class="row row_ row__">
                        <div class="col-12">

                            <p>
                                This is to confirm that <strong><span class="con_name"></span></strong> with Identification Number <strong><span class="con_id"></span></strong> is a past student of the <strong><span class="con_facname"></span></strong> of the <strong>UNIVERSITY FOR DEVELOPMENT STUDIES</strong>.
                            </p>
                            <p>
                                <strong><span class="con_name"></span></strong> was admitted into the University in September <span class="con_admn_yr"></span> to pursue a <span class="duration"></span> <strong><span class="con_prgname"></span></strong> programme, and obtained a <strong><span class="con_gradclass"></span></strong> upon graduation.
                            </p>
                            <p>
                                It would be appreciated if all necessary assistance is accorded.
                            </p>
                            <p>
                                Anticipating your usual co-operation, please.
                            </p>
                            <p>
                                Thank you.
                            </p>

                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row row_" style="font-size: 20px;line-height: 30px;">
                        <div class="col-12">
                            <span style="display:block;text-align:left" class="signatory"></span>
                            <span style="display:block;text-align:left">for: Registrar</span>
                        </div>
                    </div>

                    <div>
                        <div id='qrcode_2' style='float:right;letter-spacing: 10px'></div>
                    </div>
                    <br><br><br><br><br>
                    <div style="color: black;font-weight: bold;">NB: <br>USE BARCODE FOR VERIFICATION</div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button onclick="print_confirmatory();" class="btn btn-primary btn-sm">Print</button>

                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Introductory Modal-->
    <div class="modal fade" id="introductoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Introductory Letter</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="intro_printable" style="font-family: 'times new roman'">
                    <div class='row'>
                        <div class="header" style="font-weight: bold;color: #0B6F10;">
                            <span id="head_one">UNIVERSITY FOR DEVELOPMENT STUDIES</span>
                            <h2>(OFFICE OF THE REGISTRAR)</h2>
                            <h3>CENTRAL ADMINISTRATION</h3>
                        </div>
                    </div>

                    <table class="table" id="con_table" style="font-size: 20px;color: black;font-weight: bold">
                        <tr>
                            <td style="width: 5%">
                                <span style="color: darkgreen;font-weight: bold">Tel:</span>
                            </td>
                            <td style="width: 35%;padding-left: 10px">
                                +233-372-93382, 26634, 93382
                            </td>

                            <td rowspan="3">
                                <img src="../images/uds.png" width="180px" height="180px">
                            </td>
                            <td style="width: 5%">

                            </td>
                            <td style="width: 35%">
                                <span>P. O. Box TL 1350</span>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold">Web:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="www.uds.edu.gh">www.uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span>Tamale, Ghana</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold;">Email:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span style="font-weight: bold;"></span><?php echo date("F d, Y") ?>
                            </td>
                        </tr>

                        <tr id="intro_letter_banner_row" style="visibility: hidden;">
                            <td colspan="5">
                                <div id="intro_letter_banner" style="border: 3px solid red;padding: 5px;text-align: center;letter-spacing: 20px;border-radius: 10px;"></div>
                            </td>
                        </tr>
                    </table>

                    <div class="row row_ row__">
                        <div class="col-6">
                            <span style="font-weight: bold;">Our Ref: </span><span style="font-weight: bold" class="con_id"></span><br>
                            <span style="font-weight: bold;">Your Ref: </span><span style="font-weight: bold" id="your_ref"></span>
                        </div>
                    </div>
                    <br>

                    <div>
                        <img src="../images/divider.png" style="margin-top:-10px;width: 100%">
                    </div>
                    <div style="text-align: center;" class="row row_ row__">
                        <div class="col-12">
                            <span style="text-decoration: underline;text-decoration-skip-ink: none;font-weight: bolder;font-size: 20px;color: black">
                                INTRODUCTORY LETTER: <span class="con_name"></span>
                            </span>
                        </div>
                    </div>

                    <div class="row row_ row__">
                        <div class="col-12">

                            <p>
                                I write to confirm that <strong><span class="con_name"></span></strong> with Identification Number <strong><span class="con_id"></span></strong> is a <span class="level"></span> student of the <strong><span class="con_facname"></span></strong> of the <strong>UNIVERSITY FOR DEVELOPMENT STUDIES</strong>.
                            </p>
                            <p>
                                <strong><span class="con_name"></span></strong> was admitted into the University in September <span class="con_admn_yr"></span> to pursue a <span class="duration"></span> <strong><span class="con_prgname" style="text-transform: uppercase;"></span></strong> programme.
                            </p>
                            <p>
                                It would be appreciated if all necessary assistance is accorded.
                            </p>
                            <p>
                                Anticipating your usual co-operation, please.
                            </p>
                            <p>
                                Thank you.
                            </p>

                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row row_" style="font-size: 20px;line-height: 30px;">
                        <div class="col-12">
                            <span style="display:block;text-align:left" class="signatory"></span>
                            <span style="display:block;text-align:left">for: Registrar</span>
                        </div>
                    </div>

                    <div>
                        <div id='qrcode_1' style='float:right;letter-spacing: 10px'></div>
                    </div>
                    <br><br><br><br><br>
                    <div style="color: black;font-weight: bold;">NB: <br>USE BARCODE FOR VERIFICATION</div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button onclick="print_introductory();" class="btn btn-primary btn-sm">Print</button>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Visa Modal-->
    <div class="modal fade" id="visaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Introductory Letter (Visa)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="visa_printable" style="font-family: 'times new roman'">
                    <div class='row'>
                        <div class="header" style="font-weight: bold;color: #0B6F10;">
                            <span id="head_one">UNIVERSITY FOR DEVELOPMENT STUDIES</span>
                            <h2>(OFFICE OF THE REGISTRAR)</h2>
                            <h3>CENTRAL ADMINISTRATION</h3>
                        </div>
                    </div>

                    <table class="table" id="con_table" style="font-size: 20px;color: black;font-weight: bold">
                        <tr>
                            <td style="width: 5%">
                                <span style="color: darkgreen;font-weight: bold">Tel:</span>
                            </td>
                            <td style="width: 35%;padding-left: 10px">
                                +233-372-93382, 26634, 93382
                            </td>

                            <td rowspan="3">
                                <img src="../images/uds.png" width="180px" height="180px">
                            </td>
                            <td style="width: 5%">

                            </td>
                            <td style="width: 35%">
                                <span>P. O. Box TL 1350</span>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold">Web:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="www.uds.edu.gh">www.uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span>Tamale, Ghana</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span style="color: darkgreen;font-weight: bold;">Email:</span>
                            </td>
                            <td style="padding-left: 10px">
                                <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <span style="font-weight: bold;"></span><?php echo date("F d, Y") ?>
                            </td>
                        </tr>
                    </table>

                    <div class="row row_ row__">
                        <div class="col-6">
                            <span style="font-weight: bold;">Our Ref: </span><span style="font-weight: bold" class="con_id"></span><br>
                            <span style="font-weight: bold;">Your Ref: </span><span style="font-weight: bold" id="your_ref"></span>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <img src="../images/divider.png" style="margin-top:-10px;width: 100%">
                    </div>
                    <br>
                    <table>
                        <tr>
                            <td style="font-size: 20px;font-weight: bold;color: black;">
                                The Officer In-Charge<br>
                                Visa Section<br>
                                <span class="country_ppl"></span> <span class="consulate"></span>
                                <p>
                                    Dear Sir/Madam,
                                </p>
                            </td>
                        </tr>
                    </table>

                    <div style="text-align: center;" class="row row_ row__">
                        <div class="col-12">
                            <span style="text-decoration: underline;text-decoration-skip-ink: none;font-weight: bolder;font-size: 20px;color: black">
                                <strong>INTRODUCTORY LETTER (VISA)</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row row_ row__">
                        <div class="col-12">

                            <p>
                                I write to confirm that <strong><span class="con_name"></span></strong> with registration number <strong><span class="con_id"></span></strong> is a <span class="level" style="text-transform: lowercase;"></span> student of the <strong>UNIVERSITY FOR DEVELOPMENT STUDIES</strong>. <span class="con_gender2"></span> programme of study is <span class="duration"></span> <strong><span class="con_prgname" style="text-transform: uppercase;"></span></strong> offered in the <strong><span class="con_facname"></span></strong>.
                            </p>
                            <p>
                                <strong><span class="con_name"></span></strong> intends travelling to <span class="country_nm"></span> during the University's break. It would be appreciated if you could grant <span class="con_gender"></span> the requisite visa.
                            </p>
                            <p>
                                Counting on your usual co-operation.
                            </p>
                            <p>
                                Yours faithfully,
                            </p>

                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row row_" style="font-size: 20px;line-height: 30px;">
                        <div class="col-12">
                            <span style="display:block;text-align:left" class="signatory"></span>
                            <span style="display:block;text-align:left">for: Registrar</span>
                        </div>
                    </div>

                    <div>
                        <div id='qrcode_4' style='float:right;letter-spacing: 10px'></div>
                    </div>
                    <br><br><br><br><br>
                    <div style="color: black;font-weight: bold;">NB: <br>USE BARCODE FOR VERIFICATION</div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button onclick="print_visa();" class="btn btn-primary btn-sm">Print</button>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- compose reply -->
    <div class="compose_reply col-md-6 col-xs-12">
        <div class="compose-header">
            Compose Reply
            <button type="button" class="reply_close">
                <span>×</span>
            </button>
        </div>

        <div class="compose-body">
            <div id="alerts"></div>

            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a data-edit="fontSize 5">
                                <p style="font-size:17px">Huge</p>
                            </a>
                        </li>
                        <li>
                            <a data-edit="fontSize 3">
                                <p style="font-size:14px">Normal</p>
                            </a>
                        </li>
                        <li>
                            <a data-edit="fontSize 1">
                                <p style="font-size:11px">Small</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                    <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                        <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label><b>Subject</b></label>
                <input type="text" name="subject" id="subject" class="form-control">
            </div>

            <div id="reply_editor" class="editor-wrapper"></div>
        </div>

        <div class="compose-footer">
            <button id="send_reply" class="btn btn-sm btn-success"><i class="fa fa-send-o"></i> Send Message</button>
        </div>
    </div>
    <!-- /compose Reply -->


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

    <script src="../vendor/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendor/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendor/google-code-prettify/src/prettify.js"></script>
    <!-- Custom Theme Scripts -->
    <!--        <script src = "../js/jquery-printme.min.js"></script>-->
    <!--    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>-->
    <script src="../js/print.js"></script>
    <script src="../js/jquery-barcode.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/cleanup.js"></script>
    <script src="../js/access.js"></script>
    <script src="function.js"></script>
    <script src="../vendor/Prevent-Webpage-Opened-Multiple-Tabs-duplicateWindow/Duplicate.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#service_tbl").DataTable({
                searching: false,
                paging: false
            });
            $("#issTable").DataTable();
            $("#repTable").DataTable();

            keep_open("keep-open,index");

            document.getElementById("requests").style.backgroundColor = '#4a7b47';
            document.getElementById("requests").style.color = 'white';

            document.getElementById("issued").style.backgroundColor = 'white';
            document.getElementById("issued").style.color = 'black';

            document.getElementById("reported").style.backgroundColor = 'white';
            document.getElementById("reported").style.color = 'black';

        });

        function back() {
            document.getElementById("main_trans").style.display = 'block';
            document.getElementById("trans_details").style.display = 'none';
        }

        $("#requests").on('click', function() {
            req();
            document.getElementById("requests").style.backgroundColor = '#4a7b47';
            document.getElementById("requests").style.color = 'white';

            document.getElementById("issued").style.backgroundColor = 'white';
            document.getElementById("issued").style.color = 'black';

            document.getElementById("reported").style.backgroundColor = 'white';
            document.getElementById("reported").style.color = 'black';
        })

        $("#issued").on('click', function() {
            issue();
            document.getElementById("issued").style.backgroundColor = '#4a7b47';
            document.getElementById("issued").style.color = 'white';

            document.getElementById("requests").style.backgroundColor = 'white';
            document.getElementById("requests").style.color = 'black';

            document.getElementById("reported").style.backgroundColor = 'white';
            document.getElementById("reported").style.color = 'black';
        })

        $("#reported").on('click', function() {
            report();
            document.getElementById("reported").style.backgroundColor = '#4a7b47';
            document.getElementById("reported").style.color = 'white';

            document.getElementById("issued").style.backgroundColor = 'white';
            document.getElementById("issued").style.color = 'black';

            document.getElementById("requests").style.backgroundColor = 'white';
            document.getElementById("requests").style.color = 'black';
        })

        function issue() {
            load_issued();
            document.getElementById("issued_table").style.display = 'block';
            document.getElementById("main_trans").style.display = 'none';
            document.getElementById("trans_details").style.display = 'none';
            document.getElementById("reported_table").style.display = 'none';
        }

        function req() {
            document.getElementById("issued_table").style.display = 'none';
            document.getElementById("trans_details").style.display = 'none';
            document.getElementById("main_trans").style.display = 'block';
            document.getElementById("reported_table").style.display = 'none';
        }

        function report() {
            document.getElementById("issued_table").style.display = 'none';
            document.getElementById("trans_details").style.display = 'none';
            document.getElementById("main_trans").style.display = 'none';
            document.getElementById("reported_table").style.display = 'block';
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
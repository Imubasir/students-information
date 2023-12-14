<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";
require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '15' ";
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

    <title><?php echo $title."Postgraduate Services" ?></title>
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

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <link href="index.css" rel="stylesheet" type="text/css">
    <link href="english_prof.css" rel="stylesheet" type="text/css">
    <link href="transcript.css" rel="stylesheet" type="text/css">
    <!-- Custom styling plus plugins -->
    <style type="text/css">
      #watermark {
             position:absolute;
             margin-left:  25%;
             opacity:0.1;
             z-index:99;
             color:white;
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
  </div>
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
            <span id = "mcount" class="badge badge-danger"></span>
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
                  <img class="align-self-center rounded-circle mr-3" src="<?php echo $_SESSION['picture'] ?>" onerror = 'if(this.src != "../images/avatar.png") this.src = "../images/avatar.png" '  width="70px" height="70px">
                    <h4 class="text-light display-6"><?php echo $_SESSION['FNAME']." ".$_SESSION['LNAME']; ?></h4>
                    <p><?php echo $_SESSION['dept'] ?></p>
                </div>
            </div>
        </div>
            <br />

            <h3  style="padding-left: 15px;color: #fff;text-transform: uppercase;letter-spacing: .5px;font-weight: 700;font-size: 11px;margin-bottom: 0;margin-top: 0;text-shadow: 1px 1px #000;">GENERAL</h3>
          
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
          <li class="nav-item dropdown active keep-open">
          <a class="nav-link dropdown-toggle index" href="#" id="services_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-archive"></i>
            <span>Services</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="ug_services_tab" class="dropdown-item" href="../6768">UG Services</a>

            <a id="pg_services_tab" class="dropdown-item active" href="../7473">PG Services</a>

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
                        Services
                    </li>
                    <li class="breadcrumb-item active">PG Services</li>
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
                        </span> <span style="font-size: 25px;font-weight:bold;color: white">Assigned Tasks</span> <small style="font-size: 15px;color: white">Postgraduate Transcripts</small>
                    </div>
                    <div class="card-body" id="main_trans">
                        <div class="responsive">
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
                    </div>

                    <!--            View Service Details-->
                    <div id="trans_details" class="card-body" style="display:none;">
                        <span style="float: right;"><button id="report_btn" class="btn btn-sm btn-danger">Report Issue</button></span><button onclick="back()" class="btn btn-sm btn-danger"><i class="fas fa-angle-left"></i> Back</button>
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
                    </div>

                    <!-- Issued Services -->
                    <div class="card-body" id="issued_table" style="display:none;">
                        <div class="responsive">
                            <table class="table table-hover table-striped" id="issTable">
                                <caption style="caption-side: top;font-weight: bold;color: black;">Issued Transcripts</caption>
                                <thead>
                                        <th>Sn</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Services</th>
                                        <th>Date Issued</th>
                                        <th>Issued By</th>
                                </thead>
                                <tbody id="issBody" style="text-transform: uppercase;">
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
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Programme</th>
                                        <th>Services</th>
                                        <th>Date Issued</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="repBody" style="text-transform: uppercase;">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- Transcript Modal-->
        <div class="modal fade" id="transcriptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraduate Transcript</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="print_trans" style="padding: 10px;margin-left: 2%;padding-right: 30px;">
                        <table style="width: 100%;margin-top: 2%;">
                            <thead id="main_thead">
                                
                            <tr style="line-height: initial;border-bottom: 2px solid black;">
                                <td style="width:125px;height:104px"><img src="../images/uds_logo.png" alt="img" width="130px" height="130px" /></td>
                                <td colspan="3" class="style1"><div style="text-align:center;margin-left: -100px"><span class="style53">UNIVERSITY FOR DEVELOPMENT STUDIES</span><br>
                                        <span class="style53">Academic Affairs Section</span><br>
                                        <span class="style2"><span class="style54">P.O. Box TL 1350  Tamale, Ghana  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tel: 03720-93382/26633/26634</span><br>
                                          <span class="style54">Web: <span class="style52">www.uds.edu.gh &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="style6">Email:</span> academicaffairs@uds.edu.gh</span><span class="style55"></span><br>
                            
                                <span class="style4">TRANSCRIPT OF ACADEMIC RECORD</span></span></span></div></td>
                            </tr>
                                <tr>
                                    <td><br /></td>
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
                                    <td class="profile_label">Date of Award: </td>
                                    <td class="profile_data"><span id="date_awarded"></span></td>
                                    <td class="profile_label">Sex: </td>
                                    <td class="profile_data"><span id="gender"></span></td>
                                </tr>
                                <tr>
                                    
                                    <td class="profile_label">Class: </td>
                                    <td class="profile_data"><span id="grad_class"></span></td>
                                    <td class="profile_label">Date Printed: </td>
                                    <td class="profile_data"><span id="trans_print_date"></span></td>
                                </tr>

                                <tr>
                                    <td style="text-align: center;margin-top: 15%;" colspan="6" id="watermark"><img src="../images/uds_logo.png" height="600px" width="600px"></td>
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
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        <div style='text-align: center;color: black;'><span id='signed_for' style="font-weight: bold;"></span><br>For: Registrar</div>
                                    </td>
                                </tr>
                                                
                            </tbody>

<!--
                             <br>
                             <br>
-->
                            <tfoot>
                              <table style="width: 100%;color: black;font-weight: bold;">
                                <caption style="caption-side: top;color: black;text-decoration: underline;">KEY</caption>
                                 <tr>
                                <td style="width: 10%">A+</td>
                                <td>80-100 (Excellent)</td>
                                <td style="width: 10%">B+</td>
                                <td>65-69 (Good)</td>
                                <td style="width: 10%">F</td>
                                <td>Below 60 (Fail)</td>
                              </tr>
                              <tr>
                                <td>A</td>
                                <td>70-79 (Very Good)</td>
                                <td>B</td>
                                <td>60-64 (Credit)</td>
                              </tr>
                              </table>
                             <br>
                             <br>
                                <tr>
                                    <td colspan="4" style="padding: 20px">
                                        <div id='qrcode' style='float:right;'></div>    
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-weight: bold;color: black !important;">NB: <br> USE BARCODE FOR VERIFICATION</td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                            <button onclick="print();" class="btn btn-primary btn-sm">Print</button>

                        </div>
                    </div>
                        
                </div>
            </div>

            <!-- Letters -->
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
                        <div id="printable" class="modal-body" style="color: black;font-family: 'times new roman">
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
                                    <strong><h4 style="display:block;text-decoration:underline;font-weight: bolder;font-size: 20px;">TO WHOM IT MAY CONCERN</h4></strong>
                                    <strong><h4 style="text-decoration:underline;font-weight: bolder;font-size: 20px;">ENGLISH PROFICIENCY</h4></strong>
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
<!--    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>-->
    <script src="../js/print.js"></script>
    <script src="../js/jquery-barcode.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../js/custom.min.js"></script>
    <script src="../js/cleanup.js"></script>
    <script src="function.js"></script>
    <script src="../js/access.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        var status = localStorage.getItem('status');

        if(status == 'login'){
         new PNotify({
            title: 'Login Successful',
            text: 'Logged in as '+'<?php echo $_SESSION["FNAME"]." ".$_SESSION["LNAME"] ?>',
            type: 'success',
            styling: 'bootstrap3'
                 });
            }

          localStorage.setItem('status', '');

          keep_open("keep-open,index");
      });

            $(document).ready(function() {
                $("#service_tbl").DataTable({
                searching: false,
                paging: false
            });
                $("#issTable").DataTable();
                $("#repTable").DataTable();

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


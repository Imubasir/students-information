<?php
session_start();

$title = "Students Information Systems Unit | ";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title."Undergraduate Transcript" ?></title>
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
    <!--    <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet" type="text/css">-->
    <!-- Custom styling plus plugins -->
    <link href="english_prof.css" rel="stylesheet" type="text/css">
    <style>

    </style>
</head>


<body id="page-top">


    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="../1753"><img src="../images/favicon.png" width="30px" height="30px">Students Information System </a>

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
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="../1753/"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>

                    <a class="dropdown-item" href="../5503"><i class="fas fa-fw fa-user"></i> Profile</a>

                    <a class="dropdown-item" href="../3062"><i class="fas fa-fw fa-envelope"></i> Inbox</a>

                    <a class="dropdown-item" href="../2365"><i class="far fa-bell"></i> Notification</a>
                </div>
            </li>
            <!--End of Dashboard-->

            <!--Undergraduate-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span>Undergraduate</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="../5525"> Certification</a>

                    <a class="dropdown-item" href="../6693"> Courses</a>

                    <a class="dropdown-item" href="../5065"> Enrollments</a>

                    <a class="dropdown-item" href="../9734"> Programmes</a>

                    <a class="dropdown-item" href="../1507"> Results</a>
                </div>
            </li>
            <!--End of Undergraduate-->

            <!--Postgraduate-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-graduate"></i>
                    <span>Postgraduate</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="../1326"> Certification</a>

                    <a class="dropdown-item" href="../3394"> Courses</a>

                    <a class="dropdown-item" href="../3655"> Enrollments</a>

                    <a class="dropdown-item" href="../7738"> Programmes</a>

                    <a class="dropdown-item" href="../5997"> Results</a>
                </div>
            </li>
            <!--End of Postgraduate-->

            <!--Transcript-->
            <li class="nav-item dropdown active keep-open">
                <a class="nav-link dropdown-toggle index" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-archive"></i>
                    <span>Services</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item active" href="../6768">UG Services</a>

                    <a class="dropdown-item" href="../7473">PG Services</a>

                    <a class="dropdown-item" href="../2847">Certificate</a>

                    <a class="dropdown-item" href="../3685">Signatory</a>

                    <a class="dropdown-item" href="../5798">Task Scheduler</a>

                    <a class="dropdown-item" href="../2040">Request</a>
                </div>
            </li>
            <!--End of Transcript-->

            <!--Analytics-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="../8324">General</a>

                    <a class="dropdown-item" href="../5026">NCTE</a>
                </div>
            </li>
            <!--End of Analytics-->

            <!--Settings-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Settings</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="../7673"><i class="far fa-building"></i> Campus</a>
                    
                    <a id="uni_halls" class="dropdown-item" href="../6540"><i class="fas fa-hotel"></i> University Halls</a>

                    <a class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

                    <a class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>

                    <a class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>
                    
            <a class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

            <a class="dropdown-item" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

            <a id="gen_edit" class="dropdown-item" href="../8081"><i class="fas fa-edit"></i> General Edits</a>

                    <a class="dropdown-item" href="../1242"><i class="fas fa-user-plus"></i> Users</a>

                    <a class="dropdown-item" href="../8015"><i class="fas fa-fw fa-clock"></i> Log</a>
                </div>
            </li>
            <!--End of Settings-->

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
                                <tbody id="sigBody">

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
                                <tbody id="detBody">

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
                                <tbody id="issBody">

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
                        <!-- <table id="inner_table" style="width: 100%;">
                            <thead id="header_thead">
                                <tr>
                                    <th>
                                        <div class="trans_header"><td>
                                                <img src="../images/uds_logo.png" width="100px" height="100px">
                                                </td><td>
                                                <span style="font-weight: 500;font-size: 20px">UNIVERSITY FOR DEVELOPMENT STUDIES</span><br>
                                                <span style="font-weight: 400;font-size: 19px">Academic Affairs Section</span><br>
                                                <span>P.O.Box TL 1350 Tamale, Ghana</span>&nbsp;&nbsp;&nbsp;<span>Tel: 03720-93382/26633/26634</span><br><span>Web: <a href="www.uds.edu.gh">www.uds.edu.gh</a></span>&nbsp;&nbsp;&nbsp;<span>Email: <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a></span>
                                                <br>
                                                <h4>TRANSCRIPT OF ACADEMIC RECORD</h4>
                                                </td><td>
                                                <img src="../images/avatar.png" width="100px" height="80px">
                                                </td>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table> -->
                        <table class="main_tbl">
                            <thead>
							<tr>
                            <th>
                                <table class="row repeat_header">
                                <tr>
                                    <td>
                                        <img src="../images/transcript_3.png" width="100%" height="100px">
                                    </td>
                                    <td style="vertical-align: inherit;">
                                        <img src="../images/avatar.png" width="130px" height="100px">
                                    </td>
                                </tr>
                                </table>
                            </th>
							</tr>
                            </thead>
                            <tbody style="font-size: small;">
                                    <!--<div class="row body">-->
									<tr>
									<td>
                                            <table style="width: 100%;">
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
                                            </table>
                                                </td>
													</tr>
                                            
                                    <!--</div>-->
                                        <br>
                                        <div class="row" id="trancriptTable" style="color: black;text-transform: uppercase;font-family: verdana, arial, helvetica, sans-serif;font-size: small;">

                                        </div>
                                        <div class="row" style="border-bottom: 2px solid #dee2e6;">
                                            <div class="col-6" style="text-align: right;color: black;font-weight: bold;">
                                                <span class="label_cgpa">Final CGPA: </span><br>
                                                Class: 
                                            </div>
                                            <div class="col-6" style="text-align: left;color: black;font-weight: bold;">
                                                <span style="display:block" id="final_cgpa"></span><br>
                                                <span id="final_class"></span>
                                            </div>
                                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div style='width:100%;' class="row">
                            <div class="col-10">
                                <div style='text-align: center;color: black;'><span id='signed_for' style="font-weight: bold;"></span><br>For: Registrar</div>
                            </div>
                            <div class="col-2">
                                <div id='qrcode' style='float:right;'></div>
                            </div>
                        </div>
                            </tbody>

                        </table>
                        
                    </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                            <button onclick="print();" class="btn btn-primary btn-sm">Print</button>

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
                        <div id="printable" class="modal-body">
                            <div class='row'>
                                <div class="header">
                                    <h1>UNIVERSITY FOR DEVELOPMENT STUDIES</h1>
                                    <h3>(Office of the Registrar)</h3>
                                    <h2>Central Administration</h2>
                                </div>
                            </div>
                            <br>
                            <div id="info" class="row row_">
                                <div class="col-4">
                                    <span style="display: block;">Tel:+233-372-93382, 26634, 93382</span>
                                    <span style="display: block;">Web: <a href="www.uds.edu.gh">www.uds.edu.gh</a></span>
                                    <span style="display: block;">Fax: +233-71 23957</span>
                                    <span style="display: block;">Email: <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a></span>
                                </div>
                                <div style="text-align: center;" class="col-4">
                                    <img src="../images/uds.png" width="150px" height="150px">
                                </div>
                                <div class="col-4">
                                    <span style="display: block;">P. O. Box TL 1350</span>
                                    <span style="display: block;">Tamale, Ghana</span>
                                </div>
                            </div>
                            <br>
                            <div class="row row_ row__">
                                <div class="col-6">
                                    <span>Our Ref: </span><span style="font-weight: bold" id="our_ref"></span><br>
                                    <span>Your Ref: </span><span style="font-weight: bold" id="your_ref"></span>
                                </div>
                            </div>

                            <div style="text-align: center;" class="row row_ row__">
                                <div class="col-12">
                                    <h4 style="display:block;">TO WHOM IT MAY CONCERN</h4>
                                    <h4 style="text-decoration:underline;">ENGLISH PROFICIENCY</h4>
                                </div>
                            </div>

                            <div class="row row_ row__">
                                <div class="col-12">
                                    <p>This is to certify that <span class="name"></span> attended the University for Development Studies in Ghana where English is the medium of instruction for the <strong><span class="progfullname"></span></strong> programme and all other courses in the University.</p>

                                    <p>
                                        <span class="name"></span> also passed all <span class="gender"></span> courses that were examined in the English Language throughout <span class="gender"></span> <span class="years"></span> stay in the University.
                                    </p>

                                    <p>
                                        I therefore recommend that <span class="name"></span> be permitted to undertake any course where the medium of instruction is the English Language since I do not doubt <span class="gender"></span> proficiency in the language.
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
                            <div class="row row_" style="font-size: 20px;line-height: 30px;">
                                <div class="col-12">
                                    <span style="display:block;text-align:left" class="signatory"></span>
                                    <span style="display:block;text-align:left">for: Registrar</span>
                                </div>
                            </div>
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
                        <div class="modal-body" id="con_printable">
                            <div class='row'>
                                <div class="header">
                                    <h1>UNIVERSITY FOR DEVELOPMENT STUDIES</h1>
                                    <h3>(Office of the Registrar)</h3>
                                    <h2>Central Administration</h2>
                                </div>
                            </div>

                            <div id="info" class="row row_">
                                <div class="col-4">
                                    <span style="display: block;">Tel:+233-372-93382, 26634, 93382</span>
                                    <span style="display: block;">Web: <a href="www.uds.edu.gh">www.uds.edu.gh</a></span>
                                    <span style="display: block;">Fax: +233-71 23957</span>
                                    <span style="display: block;">Email: <a href="mailto:academicaffairs@uds.edu.gh">academicaffairs@uds.edu.gh</a></span>
                                </div>
                                <div style="text-align: center;" class="col-4">
                                    <img src="../images/uds.png" width="150px" height="150px">
                                </div>
                                <div class="col-4">
                                    <span style="display: block;">P. O. Box TL 1350</span>
                                    <span style="display: block;">Tamale, Ghana</span>
                                </div>
                            </div>

                            <div class="row row_ row__">
                                <div class="col-6">
                                    <span>Our Ref: </span><span style="font-weight: bold" id="our_ref"></span><br>
                                    <span>Your Ref: </span><span style="font-weight: bold" id="your_ref"></span>
                                </div>
                            </div>

                            <div style="text-align: center;" class="row row_ row__">
                                <div class="col-12">
                                    <h4>CONFIRMATION LETTER</h4>
                                </div>
                            </div>

                            <div style="text-align: center;" class="row row_ row__">
                                <div class="col-12">
                                    <h4 style="text-decoration:underline"><span class="con_title"></span> <span class="con_name"></span></h4>
                                </div>
                            </div>

                            <div class="row row_ row__">
                                <div class="col-12">
                                    <p>
                                        I write to confirm that <em><strong><span class="con_name"></span></strong></em> with Identification number <strong><span class="con_id"></span></strong> is a past student of the <span class="con_facname"></span> of this University.
                                    </p>
                                    <p>
                                        <span class="con_name"></span> was admitted into the University in September <span class="con_admn_yr"></span> to pursue a <strong><span class="con_prgname"></span></strong> programme. <span class="con_gender"></span> obtained <span class="con_gradclass"></span>.
                                    </p>
                                    <p>
                                        It would be appreciated if <span class="con_gender"></span> is accorded the necessary assistance.
                                    </p>
                                    <p>
                                        I appreciate your usual co-operation.
                                    </p>
                                    <p>
                                        Thank you.
                                    </p>

                                </div>
                            </div>
                            <br>
                            <div class="row row_" style="font-size: 20px;line-height: 30px;">
                                <div class="col-12">
                                    <span style="display:block;text-align:left" class="signatory"></span>
                                    <span style="display:block;text-align:left">for: Registrar</span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                            <button onclick="print_confirmatory();" class="btn btn-primary btn-sm">Print</button>

                        </div>
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
        <!--        <script src = "../js/jquery-printme.min.js"></script>-->
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
        <script src="../js/jquery-barcode.js"></script>
        <script src="../js/custom.min.js"></script>
        <script src="../js/cleanup.js"></script>
        <script src="function.js"></script>

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

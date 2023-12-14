<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";
require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '13' ";
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

    <title><?php echo $title."Postgraduate Results" ?></title>
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
            <li class="nav-item dropdown active keep-open">
                <a class="nav-link dropdown-toggle index" href="#" id="postgraduate_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-graduate"></i>
                    <span>Postgraduate</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a id="pg_certification_tab" class="dropdown-item" href="../1326"> Certification</a>

                    <a id="pg_course_tab" class="dropdown-item" href="../3394"> Courses</a>

                    <a id="pg_enrollment_tab" class="dropdown-item" href="../3655"> Enrollments</a>

                    <a id="pg_programme_tab" class="dropdown-item" href="../7738"> Programmes</a>

                    <a id="pg_result_tab" class="dropdown-item active" href="../5997"> Results</a>
                </div>
            </li>
            <!--End of Postgraduate-->

            <!--Transcript-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="services_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-archive"></i>
                    <span>Services</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
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
                    <li class="breadcrumb-item active">Postgraduate Results</li>
                </ol>

                <!-- /.container-fluid -->
                <div class="card mb-3 animated fadeInRight">
                    <div class="card-header">
                        <!-- <span style="float: right;"><button class="btn btn-sm btn-success" id="uploadBtn">Upload Results</button><button style="display: none" class="btn btn-sm btn-success" id="backBtn">Back</button></span> -->
                        <i class=""></i>Postraduate Results
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
    
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Results</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="responsive">
                        <table class="table" id="delTable">
                        <thead>
                                <tr>
                                <th>Session</th>
                                <th>Level</th>
                                <th>Trimester</th>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Grade</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="delBody">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!--View Results-->
    <div class="modal fade" id="view_results" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="align-self-center rounded-circle mr-3" src="" onerror="if(this.src != '../images/avatar.png') this.src = '../images/avatar.png' " width="50px" height="50px">
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

                                <td colspan="4" class="style1">
                                    <div style="text-align:center;margin-left: -100px"><span class="style53">UNIVERSITY FOR DEVELOPMENT STUDIES</span><br>
                                        <span class="style53">Academic Affairs Section</span><br>
                                        <span class="style2"><span class="style54">P.O. Box TL 1350 Tamale, Ghana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tel: 03720-93382/26633/26634</span><br>
                                            <span class="style54">Web: <span class="style52">www.uds.edu.gh &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="style6">Email:</span> academicaffairs@uds.edu.gh</span><span class="style55"></span><br>
                                                <span class="style4">STATEMENT OF RESULTS</span>
                                            </span></span></div>
                                </td>
                            </tr>
                            <tr>
                            <td colspan="5"><br /></td>
                            </tr>

                            <tr>
                                <td style="width: 15%"><label>UIN:</label></td>
                                <td style="width: 30%" class="info" id="uin"></td>

                                <td style="width: 15%"><label>Gender:</label></td>
                                <td style="width: 30%" class="info" id="gender"></td>

                                <td style="width: 10%;" rowspan="3"><img src="../images/avatar.png" width="100px" height="100px"></td>
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
    <!-- FullCalendar -->
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
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

            $("#search").unbind('click').on('click', function() {
                var id = $("#id").val();

                $.ajax({
                    type: 'POST',
                    url: 'checkResults.php',
                    data: 'id=' + id,

                    success: function(response) {
                        var data = JSON.parse(response);
                        console.log(data);
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            var uin = data[i].uin;
                            var id = data[i].indexno;
                            var name = data[i].firstname + ' ' + data[i].middlename + ' ' + data[i].surname;
                            var prog = data[i].progname;

                            html += "<tr><td>" + uin + "</td><td>" + id + "</td><td>" + name + "</td><td>" + prog + "</td><td><button id='ref_btn' class='btn btn-sm btn-info' onclick ='refresh_results(\"" + id + "\")'>Refresh Results</button></td><td><button class='btn btn-sm btn-success' onclick ='viewResults(\"" + id + "\")'>View Results</button></td><td><button class='btn btn-sm btn-danger' onclick ='deleteResults(\"" + id + "\")'><i class='fa fa-trash'></i> Delete</button></td></tr>";
                        }
                        document.getElementById("resultsBody").innerHTML = html;
                    }
                })
            })
        });

        function viewResults(id) {
            $("#view_results").modal('show');
            $.ajax({
                type: 'POST',
                url: 'fetch_results.php',
                data: 'id=' + id,

                success: function(response) {
                    //console.log(response);
                    var data = JSON.parse(response);
                    //console.log(data);
                    //Personal Information
                    for (var i = 0; i < data.length; i++) {

                        var uin = data[i].uin;
                        var id = data[i].indexno;
                        var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                        var gender = data[i].gender;
                        var prog = data[i].progname;
                        var campus = data[i].campus_descr;

                        document.getElementById("uin").innerHTML = uin;
                        document.getElementById("s_id").innerHTML = id;
                        document.getElementById("name").innerHTML = name;
                        document.getElementById("gender").innerHTML = gender;
                        document.getElementById("prog").innerHTML = prog;
                        document.getElementById("campus").innerHTML = campus;

                        grades(id);
                    }
                }
            })

        }

        function grades(id) {
            $("#view_results").modal('show');

            $.ajax({
                type: 'POST',
                url: 'grades.php',
                data: 'id=' + id,

                success: function(response) {
                    console.log(response);
                    var data = JSON.parse(response);

                    for (var a = 0; a < data.length; a++) {
                        var prog = data[data.length - 1].progname;
                    }

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
                    var html4 = '';
                    var session2 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two' id='ssheader'>SECOND YEAR STREAM</h5></div>";
                    html4 += "<label id='ssftheader' style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html4 += header;

                    var html5 = '';
                    html5 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html5 += header;

                    var html6 = '';
                    html6 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html6 += header;


                    for (var i = 0; i < data.length; i++) {
                        var trimester = data[i].trimester;
                        var level = data[i].levelid;

                        var title = data[i].course_title;
                        var code = data[i].coursecode1;
                        var credits = data[i].credits;
                        var grade = data[i].grade;

                        if (tempcode == code && tempgrade == grade) {
                            tempcode = code;
                            tempgrade = grade;
                        } else if (tempcode == code && tempgrade != grade) {
                            grade += "**";
                            tempcode = code;
                            tempgrade = grade;
                        } else {
                            if (grade == "F") {
                                grade += "*";
                            }
                        }
                        var tempcode = code;
                        var tempgrade = grade;

                        if (level == '1' && trimester == '1') {
                            var one_one = true;
                            html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '1' && trimester == '2') {
                            var one_two = true;
                            html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '1' && trimester == '3') {
                            var one_three = true;
                            html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '1') {
                            var two_one = true;
                            html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '2') {
                            var two_two = true;
                            html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '3') {
                            var two_three = true;
                            html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        }
                    }


                    html1 += "</tbody></table><br>" /*</tr>"*/ ;
                    html2 += "</tbody></table><br>" /*</tr>"*/ ;
                    html3 += "</tbody></table><br>" /*</tr>"*/ ;
                    html4 += "</tbody></table><br>" /*</tr>"*/ ;
                    html5 += "</tbody></table><br>" /*</tr>"*/ ;
                    html6 += "</tbody></table><br>" /*</tr>"*/ ;


                    var end = "</div>";

                    var main = '';
                    $.ajax({
                        type: 'POST',
                        url: 'toDisplay.php',
                        data: 'id=' + id,

                        success: function(json) {
                            console.log(json);
                            if (json.includes(1)) {

                                main += session1;

                                if (one_one == true) {
                                    main += html1;
                                } else {

                                }
                                if (one_two == true) {
                                    main += html2;
                                } else {

                                }
                                if (one_three == true) {
                                    main += html3;
                                } else {

                                }
                            }

                            if (json.includes(2)) {
                                main += session2;
                                if (two_one == true) {
                                    main += html4;
                                } else {

                                }
                                if (two_two == true) {
                                    main += html5;
                                } else {

                                }
                                if (two_three == true) {
                                    main += html6;
                                } else {

                                }
                            }

                            main += end;
                            document.getElementById("gradesTable").innerHTML = main;

                            if (one_one == true) {
                                $("#ssftheader").html("");
                            }

                            if (two_two == true) {
                                $("#ssheader").html("SECOND YEAR");
                                $("#ssftheader").html("FIRST TRIMESTER RESULTS");
                            }
                        }
                    });
                }
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

        function refresh_results(id) {
            $("#ref_btn").html("Updating   <img src='../images/ellipse.gif' width='25px' height='25px'>");
            $.ajax({
                type: 'POST',
                url: 'read_results.php',
                data: 'Faculty=' + id,

                success: function(response) {
                    console.log(response);
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


        function deleteResults(id) {
            $("#deleteModal").modal("show");

            $.ajax({
                type: 'POST',
                url: 'fetch_DeleteResults.php',
                data: 'id=' + id,

                success: function(json) {
                    var data = JSON.parse(json);
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        var level = data[i].levelid;
                        var session = data[i].session;
                        var trimester = data[i].trimester;
                        var code = data[i].coursecode1;
                        var title = data[i].course_title;
                        var grade = data[i].grade;

                        var delBtn = "<button onclick='del(\"" + id + "," + code + "," + level + "\")'><i class='fa fa-trash'></i></button>";

                        html += "<tr><td>" + session + "</td><td>" + level + "</td><td>" + trimester + "</td><td>" + code + "</td><td>" + title + "</td><td>" + grade + "</td><td>" + delBtn + "</td></tr>";
                    }
                    $("#delBody").html(html);
                }
            })
        }

        function del(id) {
            var data = id.split(",");
            var sid = data[0];
            var code = data[1];
            var level = data[2];

            $.ajax({
                type: 'POST',
                url: 'deleteResult.php',
                data: 'id=' + sid + '&code=' + code + '&level=' + level,

                success: function(response) {
                    if (response == '1') {
                        new PNotify({
                            title: "Success",
                            text: "Result Deleted",
                            type: 'success',
                            styling: 'bootstrap3'
                        })
                        deleteResults(sid); 
                    } else {
                        console.log(response);
                        new PNotify({
                            title: "Error",
                            text: "Delete Failed",
                            type: 'success',
                            styling: 'bootstrap3'
                        })
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
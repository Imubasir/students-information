<?php
session_start();

// if(!$_SESSION['uname']){
//   header('Location: ../');
// }  

$title = "UDS Integrated Management Information System | ";

require("../Db/connection.php");
require("../Db/connection2.php");
// $user = $_SESSION['uname'];
// $sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '26' ";
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

    <title><?php echo $title."Data Upload" ?></title>
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
    <link href="../vendor/pnotify/dist/pnotify.history.css" rel="stylesheet">
    <link href="../vendor/pnotify/dist/pnotify.material.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" type="text/css" href="../css/index.css">

    <style type="text/css">
        .chat-menu {
            border-bottom: 1px solid #9fd4b6;
            font-size: 15PX;
            line-height: 30px;
            cursor: pointer;
        }
        .chat-menu:hover {
            color: white !important;
            background-color: green;
        }
        .form_label {
            text-align: right;
            font-weight: bold;
        }
        .crump {
            color: green;
            font-weight: bold;
            box-shadow: 2px 2px 2px green;
            padding: 5px;
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
        <li class="nav-item dropdown active keep-open">
          <a class="nav-link dropdown-toggle index" href="#" id="settings_tab" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Settings</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="campus_tab" class="dropdown-item" href="../7673"><i class="far fa-building"></i> Campus</a>

            <a id="course_tab" class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

            <a id="department_tab" class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>
            
            <a id="programme_tab" class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>
            
            <a id="upload_tab" class="dropdown-item active" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

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
                        Home
                    </li>
                    <li class="breadcrumb-item active">Results Upload</li>
                </ol>

                <!-- /.container-fluid -->
                <div class="card mb-3 animated fadeInRight">
                    <div class="_card-header">
                        <ul id="ol">
                            <li id="UgradList"><i class="fas fa-graduation-cap"></i> Undergraduate</li>
                            <li id="PgradList" style="border-right: none"><i class="fas fa-check-double"></i> Postgraduate</li>
                        </ul>
                    </div>
                    <div class="animated fadeInRight" style="background-color: #d7ffe0;border: 2px outset white;">

                    </div>
                            <!-- ************************************************************************************ -->

                                                                <!-- UNDERGRADUATE UPLOADS -->

                            <!-- ************************************************************************************ -->
                    <div class="card-body row" id="ucardBody">

                                                                    <!-- SUB MENU -->
                        <div class="col-4">
                                <ul style="list-style: none;border-right: 1px solid #f1f1f1;padding-left: 0;color:initial;font-weight: initial;box-shadow: 2px 0px 10px darkgrey;padding: 15px;">
                                    <li class="nav-item dropdown chat-menu">
                                        <a class="dropdown-toggle results_menu" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #13d613;">
                                            <span id="ug_results_dropdown">Results</span>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                            <a id="ug_results_up" class="chat-menu dropdown-item">Upload Results File</a>
                                            <a id="ug_single_results_up" class="chat-menu dropdown-item">Add Single Result</a>
                                        </div>
                                    </li>

                                     <li id="ug_averages_up" class="chat-menu">Averages</li>

                                      <li id="ug_graduands_up" class="chat-menu">Graduands</li>

                                      <li class="nav-item dropdown chat-menu">
                                          <a class="dropdown-toggle students_menu" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: initial;">
                                                <span id="ug_students_dropdown">Students</span>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                            <a id="ug_students_up" class="chat-menu dropdown-item">Upload Students File</a>
                                            <a id="ug_single_student_up" class="chat-menu dropdown-item">Add New Student</a>
                                        </div>
                                    </li>

                                      <li id="ug_options_up" class="chat-menu">Options</li>
                                </ul>
                        </div>
                                                                        <!-- END OF SUB MENU -->

                        <!-- Undergraduate Results Upload -->
                        <div class="col-7" style="text-align: center;" id="ug_results_display">
                            <span style="float: right;" class="crump">Results Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_results_upload_form">
                                <div class="form-group">
                                    <input type="file" name="ug_results_file" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Undergraduate Results Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_results()">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="ug_results_template()">??? Click To View/Download Template ???</button>
                        </div>


                        <!-- Undergraduate Single Results Upload -->
                        <div class="col-7" style="text-align: center;display: none;" id="ug_single_results_display">
                            <span style="float: right;" class="crump">Single Results Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_single_results_upload_form">
                                <table class="table table-striped" style="width: 100%;">
                                    <tr>
                                        <td class="form_label">Index Number</td>
                                        <td><input type="text" name="indexno" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Course Code</td>
                                        <td><input type="text" name="course" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Course Title</td>
                                        <td><input type="text" name="course_title" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Mark</td>
                                        <td><input type="number" name="mark" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Grade</td>
                                        <td><input type="text" name="grade" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Credit</td>
                                        <td><input type="number" name="credit" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Level</td>
                                        <td>
                                            <select class="form-control" name="level"> <!-- Check Programme for length of level -->
                                                <option selected="" disabled="" value="">Select Level</option>
                                                <option value="1">100</option>
                                                <option value="2">200</option>
                                                <option value="3">300</option>
                                                <option value="4">400</option>
                                                <option value="5">500</option>
                                                <option value="6">600</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Trimester</td>
                                        <td>
                                            <select class="form-control" name="trimester">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Academic Year</td>
                                        <td>
                                            <select class="form-control" name="academic_yr">
                                                <option>2020/2021</option>
                                                <option>2019/2020</option>
                                                <option>2018/2019</option>
                                                <option>2017/2018</option>
                                                <option>2016/2017</option>
                                                <option>2015/2016</option>
                                                <option>2014/2015</option>
                                                <option>2013/2014</option>
                                                <option>2012/2013</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_single_results()">Save</button><br><br>
                            
                        </div>

                        <!-- Undergraduate Averages Upload -->
                        <div class="col-7" style="text-align: center;display: none;" id="ug_averages_display">
                            <span style="float: right;" class="crump">Averages Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_averages_upload_form">
                                <div class="form-group">
                                    <input type="file" name="ug_averages_file" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Undergraduate Averages Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_averages()">Upload</button><br><br>
                            <button class="btn btn-secondary" onclick="ug_averages_template()">??? Click To View/Download Template ???</button>
                        </div>

                        <!-- Undergraduate Graduands Upload -->
                        <div class="col-7" style="text-align: center;display: none;" id="ug_graduands_display">
                            <span style="float: right;" class="crump">Graduands Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_graudands_upload_form">
                                <div class="form-group">
                                    <input type="file" name="ug_graduands_file" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Undergraduate Graduands Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_graduands()">Upload</button><br><br>
                            <button class="btn btn-secondary" onclick="ug_graduands_template()">??? Click To View/Download Template ???</button>
                        </div>

                        <!-- Undergraduate Students Upload -->
                        <div class="col-7" style="text-align: center;display: none;" id="ug_students_display">
                            <span style="float: right;" class="crump">Students Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_students_upload_form">
                                <div class="form-group">
                                    <select class="form-control" id="ug_program_file" name="ug_program_file" style = "text-transform:uppercase">
                                        <option value="" disabled="" selected="">Select Programme</option>
                                        <?php
                                        // require_once("../Db/connection.php");
                                            $sql = "SELECT * FROM programme ORDER BY progname ASC";
                                            $rs = mysqli_query($conn, $sql);
                                            if($rs) {
                                                while($row = mysqli_fetch_assoc($rs)) {
                                                    ?>
                                                        <option value="<?php echo $row['progid'] ?>"><?php echo $row['progname'] ?></option>
                                                    <?php
                                                }
                                            } else {
                                                echo $conn->error;
                                            }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="ug_students_file" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Undergraduate Students Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_students()">Upload</button><br><br>
                            <button class="btn btn-secondary" onclick="ug_students_template()">??? Click To View/Download Template ???</button>
                        </div>

                        <!-- Undergraduate Single Student Upload -->
                        <div class="col-7" style="text-align: center;display: none;" id="ug_single_student_display">
                            <span style="float: right;" class="crump">Add New Student</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_single_students_upload_form">
                                <table class="table table-striped" style="width: 100%;">
                                    <tr>
                                        <td class="form_label">UIN</td>
                                        <td><input type="text" name="ug_new_uin" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Index Number</td>
                                        <td><input type="text" name="ug_new_indexno" class="form-control"></td>
                                    </tr>

                                    

                                    <tr>
                                        <td class="form_label">Surname</td>
                                        <td><input type="text" name="ug_new_surname" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Middle Name</td>
                                        <td><input type="text" name="ug_new_middlename" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">First Name</td>
                                        <td><input type="text" name="ug_new_firstname" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Gender</td>
                                        <td>
                                            <select class="form-control" name="ug_new_gender">
                                                <option></option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Date of Birth</td>
                                        <td><input type="date" name="ug_new_dob" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Place of Birth</td>
                                        <td><input type="text" name="ug_new_pob" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Home Town</td>
                                        <td><input type="text" name="ug_new_hometown" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Region of Birth</td>
                                        <td>
                                            <select name="ug_new_rob" class="form-control" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Region of Birth</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT * from region";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option value="<?php echo $row['regionid'] ?>"><?php echo $row['regionname'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Address</td>
                                        <td><input type="text" name="ug_new_address" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Phone</td>
                                        <td><input type="text" name="ug_new_phone" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Disability Status</td>
                                        <td>
                                            <select class="form-control" name="ug_new_disability_status">
                                                <option></option>
                                                <option>No</option>
                                                <option>Yes</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Disability Description</td>
                                        <td><input type="text" name="ug_new_disability_descr" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Guardian Contact</td>
                                        <td><input type="text" name="ug_new_guardian_contact" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Guardian Name</td>
                                        <td><input type="text" name="ug_new_guardian_name" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Guardian Address</td>
                                        <td><input type="text" name="ug_new_guardian_addr" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Programme</td>
                                        <td>
                                            <select class="form-control" name="ug_new_programme" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Select Programme</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT DISTINCT progname, progid from programme order by progname ASC";
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
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Entry Year</td>
                                        <td><input type="text" name="ug_new_entryyear" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Entry Level</td>
                                        <td><input type="text" name="ug_new_entrylevel" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Current Level</td>
                                        <td><input type="text" name="ug_new_curlevel" class="form-control"></td>
                                    </tr>


                                    <tr>
                                        <td class="form_label">Option</td>
                                        <td>
                                            <select name="ug_new_homeregion" class="form-control" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Select Option</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT * from tbl_option";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option value="<?php echo $row['optionid'] ?>"><?php echo $row['option_title'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Nationality</td>
                                        <td>
                                            <select name="ug_new_homeregion" class="form-control" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Select Nationality</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT * from tbl_country";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option value="<?php echo $row['country_id'] ?>"><?php echo $row['countrynm'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Study Duration</td>
                                        <td><input type="number" name="ug_new_study_duration" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Admission Category</td>
                                        <td>
                                            <select class="form-control" name="ug_new_admission_categor">
                                                <option>Select Admission</option>
                                                <?php
                                                $query = "SELECT DISTINCT admission_category FROM studentbiodata";
                                                $rs = mysqli_query($conn, $query);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option><?php echo $row['admission_category'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <option></option>
                                                <option></option>
                                            </select>
                                        </td>
                                    </tr>                              

                                    
                                </table>
                                
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_single_students()">Add</button><br><br>
                        
                        </div>

                        <!-- Undergraduate Options Upload -->
                        <div class="col-7" style="text-align: center;display: none;" id="ug_options_display">
                            <span style="float: right;" class="crump">Options Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="ug_options_upload_form">
                                <div class="form-group">
                                    <input type="file" name="ug_options_file" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Undergraduate Options Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_options()">Upload</button><br><br>
                            <button class="btn btn-secondary" onclick="ug_options_template()">??? Click To View/Download Template ???</button>
                        </div>
                    </div>
                    <!--END OF SUB MENU -->

                            <!-- ************************************************************************************ -->
                                                                <!-- POSTGRADUATE UPLOADS -->
                            <!-- ************************************************************************************ -->

                    <!--POSTGRADUATE UPLOADS -->
                    <div class="card-body row" id="ucardBody2" style="display: none">
                        <div class="col-4">
                                <ul style="list-style: none;border-right: 1px solid #f1f1f1;padding-left: 0;color:initial;font-weight: initial;box-shadow: 2px 0px 10px darkgrey;padding: 15px;">
                                    <li class="nav-item dropdown chat-menu">
                                        <a class="dropdown-toggle pg_results_menu" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #13d613;">
                                            <span id="pg_results_dropdown">Results</span>
                                        </a>
                                        
                                        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                            <a id="pg_results_up" class="chat-menu dropdown-item">Upload Results File</a>
                                            <a id="pg_single_results_up" class="chat-menu dropdown-item">Add Single Result</a>
                                        </div>
                                    </li>

                                     <li id="pg_averages_up" class="chat-menu">Averages</li>

                                      <li id="pg_graduands_up" class="chat-menu">Graduands</li>

                                      <!-- <li id="pg_students_up" class="chat-menu">Students</li> -->
                                      <li class="nav-item dropdown chat-menu">
                                          <a class="dropdown-toggle pg_students_menu" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: initial;">
                                                <span id="pg_students_dropdown">Students</span>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                            <a id="pg_students_up" class="chat-menu dropdown-item">Upload Students File</a>
                                            <a id="pg_single_students_up" class="chat-menu dropdown-item">Add New Student</a>
                                        </div>
                                    </li>

                                      <li id="pg_options_up" class="chat-menu">Options</li>
                                </ul>
                        </div>

                        <div class="col-7" style="text-align: center;" id="pg_results_display">
                            <span style="float: right;" class="crump">Postgraduate Results Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="pg_results_upload_form">
                                <div class="form-group">
                                    <input type="file" name="pg_results_upload" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Postgraduate Results Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_results()">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="pg_results_template()">??? Click To View/Download Template ???</button>
                        </div>

                        <div class="col-7" style="text-align: center;display: none;" id="pg_single_results_display">
                            <span style="float: right;" class="crump">Add New Result (Postgraduate)</span>
                            <br>
                            <br>
                            <br>
                            <form id="pg_single_results_upload_form">
                                <table class="table table-striped" style="width: 100%;">
                                    <tr>
                                        <td class="form_label">Index Number</td>
                                        <td><input type="text" name="pg_indexno" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Course</td>
                                        <td><input type="text" name="pg_course" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Mark</td>
                                        <td><input type="number" name="pg_mark" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Grade</td>
                                        <td><input type="text" name="pg_grade" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Credit</td>
                                        <td><input type="number" name="pg_credit" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Level</td>
                                        <td>
                                            <select class="form-control" name="pg_level"> <!-- Check Programme for length of level -->
                                                <option>100</option>
                                                <option>200</option>
                                                <option>300</option>
                                                <option>400</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Trimester</td>
                                        <td>
                                            <select class="form-control" name="pg_trimester">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form_label">Academic Year</td>
                                        <td><select class="form-control" name="pg_academic_yr">
                                                <option>2020/2021</option>
                                                <option>2019/2020</option>
                                                <option>2018/2019</option>
                                            </select></td>
                                    </tr>
                                </table>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_single_results()">Upload</button><br><br>
                        
                        </div>


                        <div class="col-7" style="text-align: center;display: none;" id = "pg_averages_display">
                            <span style="float: right;" class="crump">Postgraduate Averages Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="pg_averages_upload_form">
                                <div class="form-group">
                                    <input type="file" name="pg_averages_upload" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Postgraduate Averages Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_averages()">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="pg_averages_template()">??? Click To View/Download Template ???</button>
                        </div>


                        <div class="col-7" style="text-align: center;display: none;" id = "pg_graduands_display">
                            <span style="float: right;" class="crump">Postgraduate Graduands Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="pg_graduands_upload_form">
                                <div class="form-group">
                                    <input type="file" name="pg_graduands_upload" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Postgraduate Graduands Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_graduands()">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="pg_graduands_template()">??? Click To View/Download Template ???</button>
                        </div>


                        <div class="col-7" style="text-align: center;display: none;" id = "pg_students_display">
                            <span style="float: right;" class="crump">Postgraduate Students Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="pg_students_upload_form">
                                <div class="form-group">
                                    <select class="form-control" id="pg_program_file" name="pg_program_file" style = "text-transform:uppercase;">
                                        <option value="" disabled="" selected="">Select Programme</option>
                                        <?php
                                        // require_once("../Db/connection2.php");
                                            $sql = "SELECT * FROM programme ORDER BY progname";
                                            $rs = mysqli_query($conn2, $sql);
                                            if($rs) {
                                                while($row = mysqli_fetch_assoc($rs)) {
                                                    ?>
                                                        <option style="text-transform: uppercase;" value="<?php echo $row['progid'] ?>"><?php echo $row['progname'] ?></option>
                                                    <?php
                                                }
                                            } else {
                                                echo $conn2->error;
                                            }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="pg_students_upload" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Postgraduate Students Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_students()">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="pg_students_template()">??? Click To View/Download Template ???</button>
                        </div>

                        <div class="col-7" style="text-align: center;display: none;" id = "pg_single_students_display">
                            <span style="float: right;" class="crump">Postgraduate Single Students Upload</span>
                            <br>
                            <br>
                            <br>
                            <form id="pg_single_students_upload_form">
                                <table class="table table-striped" style="width: 100%;">
                                    <tr>
                                        <td class="form_label">Index Number</td>
                                        <td><input type="text" name="new_pg_indexno" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Programme</td>
                                        <td>
                                            <select class="form-control" name="new_pg_programme" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Select Programme</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT DISTINCT progname, progid from programme order by progname ASC";
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
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Major</td>
                                        <td>
                                            <select class="form-control" name="new_pg_major" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Select Major</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT DISTINCT option_title, optionid from tbl_option order by option_title ASC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option value="<?php echo $row['optionid'] ?>"><?php echo $row['option_title'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Surname</td>
                                        <td><input type="text" name="new_pg_surname" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Middle Name</td>
                                        <td><input type="text" name="new_pg_middlename" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">First Name</td>
                                        <td><input type="text" name="new_pg_firstname" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Gender</td>
                                        <td>
                                            <select class="form-control" name="new_pg_gender">
                                                <option></option>
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Date of Birth</td>
                                        <td><input type="date" name="new_pg_dob" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Home Town</td>
                                        <td><input type="text" name="new_pg_hometown" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Home Region</td>
                                        <td>
                                            <select name="new_pg_homeregion" class="form-control">
                                                <option selected="" disabled="" value="">Select Home Region</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT * from region";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option value="<?php echo $row['regionid'] ?>"><?php echo $row['regionname'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Nationality</td>
                                        <td>
                                            <select name="new_pg_homeregion" class="form-control" style = "text-transform:uppercase">
                                                <option selected="" disabled="" value="">Select Nationality</option>
                                                <?php
                                                // require_once("../Db/connection.php");
                                                $sql = "SELECT * from tbl_country";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                        <option value="<?php echo $row['country_id'] ?>"><?php echo $row['countrynm'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Address</td>
                                        <td><input type="text" name="new_pg_address" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Phone</td>
                                        <td><input type="text" name="new_pg_phone" class="form-control"></td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Year Admitted</td>
                                        <td>
                                            <select class="form-control" name="new_pg_admitted_year">
                                                <option>2020/2021</option>
                                                <option>2019/2020</option>
                                                <option>2018/2019</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="form_label">Year Admitted</td>
                                        <td>
                                            <select class="form-control" name="new_pg_admitted_year">
                                                <option value="1">100</option>
                                                <option value="2">200</option>
                                                <option value="3">300</option>
                                                <option value="4">400</option>
                                                <option value="5">500</option>
                                                <option value="6">600</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>                                
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_single_students()">Upload</button><br><br>
                        <!-- <button class="btn btn-secondary" onclick="pg_template()">??? Click To View/Download Template ???</button> -->
                        </div>


                        <div class="col-7" style="text-align: center;display: none;" id = "pg_options_display">

                            <br>
                            <br>
                            <br>
                            <form id="pg_options_upload_form">
                                <div class="form-group">
                                    <input type="file" name="pg_options_upload" style="border-bottom: 1px solid#28a745;width: 70%;"><br>
                                <code>Please, Postgraduate Options Upload Should Be In Excel!</code>
                                </div>
                            </form>
                            <button class="btn btn-sm btn-success" onclick="upload_pg_options()">Upload</button><br><br>
                        <button class="btn btn-secondary" onclick="pg_options_template()">??? Click To View/Download Template ???</button>
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

        <!-- Template Modal-->
        <div class="modal fade" id="ug_results_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Undergraduate Results Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ug_results_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>LEVEL</th>
                                <th>TRIMESTER</th>
                                <th>SESSION</th>
                                <th>COURSE CODE</th>
                                <th>GRADE</th>
                                <th>CREDITS</th>
                                <th>TITLE</th>
                                <th>MARK</th>
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

         <!-- Template Modal-->
         <div class="modal fade" id="ug_averages_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Undergraduate Averages Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ug_averages_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>LEVEL</th>
                                <th>TRIMESTER</th>
                                <th>PRESENT</th>
                                <th>CWA</th>
                                </thead>
                                <tbody>
                                    <tr>
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

         <!-- Template Modal-->
         <div class="modal fade" id="ug_options_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Undergraduate Options Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ug_options_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>OPTION</th>
                                </thead>
                                <tbody>
                                    <tr>
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

         <!-- Template Modal-->
         <div class="modal fade" id="ug_students_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Undergraduate Students Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ug_students_tbl">
                                <thead>
                                <th>UIN</th>
                                <th>INDEX NO</th>
                                </thead>
                                <tbody>
                                    <tr>
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

         <!-- Template Modal-->
         <div class="modal fade" id="ug_graduands_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Undergraduate Graduands Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ug_graduands_tbl">
                                <thead>
                                <th>INDEXNO</th>
                                <th>CLASS</th>
                                <th>DATE</th>
                                <th>NAME SUBMITTED BY FACULTY</th>
                                <th>CERTIFICATE NUMBER</th>
                                </thead>
                                <tbody>
                                    <tr>
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

                        <!-- ------------------------------------------------------------------- -->
                                            <!--Postgraduate Template Modal-->
                        <!-- ------------------------------------------------------------------- -->

        <div class="modal fade" id="pg_results_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraduate Results Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pg_results_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>LEVEL</th>
                                <th>TRIMESTER</th>
                                <th>COURSE CODE</th>
                                <th>COURSE TITLE</th>
                                <th>CREDITS</th>
                                <th>MARK</th>
                                <th>GRADE</th>
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

        <div class="modal fade" id="pg_averages_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraduate Averages Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pg_averages_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>LEVEL</th>
                                <th>TRIMESTER</th>
                                <th>PRESENT</th>
                                <th>CWA</th>
                                </thead>
                                <tbody>
                                    <tr>
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

        <div class="modal fade" id="pg_graduands_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraudate Graduands Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pg_graduands_tbl">
                                <thead>
                                    <th>INDEX NO</th>
                                    <th>CLASS</th>
                                    <th>DATE</th>
                                    <th>FACULTY NAME OF STUDENT</th>
                                    <th>Certificate Number</th>
                                </thead>
                                <tbody>
                                    <tr>
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

        <div class="modal fade" id="pg_options_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraduate Options Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pg_options_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>OPTION</th>
                                </thead>
                                <tbody>
                                    <tr>
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

        <div class="modal fade" id="pg_students_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraduate Students Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pg_students_tbl">
                                <thead>
                                <th>UIN</th>
                                <th>INDEX NO</th>
                                </thead>
                                <tbody>
                                    <tr>
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

        <!-- Template Modal-->
        <div class="modal fade" id="pg_options_templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Postgraduate Options Template</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pg_options_tbl">
                                <thead>
                                <th>INDEX NO</th>
                                <th>OPTION</th>
                                </thead>
                                <tbody>
                                    <tr>
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
        <script src = "../vender/pnotify/dist/pnotify.animate.js"></script>
        <script src = "../vender/pnotify/dist/pnotify.confirm.js"></script>
        <script src = "../vender/pnotify/dist/pnotify.history.js"></script>
        <script src = "../vender/pnotify/dist/pnotify.tooltip.js"></script>
        <!-- <script src = "../vender/pnotify/dist/pnotify.history.js"></script> -->
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
        <script src="functions.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                keep_open("keep-open,index");

                $("#ug_results_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#ug_averages_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#ug_options_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#ug_students_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#ug_graduands_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#pg_results_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#pg_averages_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#pg_options_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#pg_students_tbl").DataTable({
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
                            title: ''
                        }
                    ]
                });

                $("#pg_graduands_tbl").DataTable({
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
                            title: ''

                        }
                    ]
                });

                           });

            function ug_results_template () {
                $("#ug_results_templateModal").modal('show');
            }

            function ug_averages_template () {
                $("#ug_averages_templateModal").modal('show');
            }

            function ug_options_template () {
                $("#ug_options_templateModal").modal('show');
            }

            function ug_students_template () {
                $("#ug_students_templateModal").modal('show');
            }

            function ug_graduands_template () {
                $("#ug_graduands_templateModal").modal('show');
            }

                // POSTGRADUATE
            function pg_results_template () {
                $("#pg_results_templateModal").modal('show');
            }

            function pg_averages_template () {
                $("#pg_averages_templateModal").modal('show');
            }

            function pg_options_template () {
                $("#pg_options_templateModal").modal('show');
            }

            function pg_students_template () {
                $("#pg_students_templateModal").modal('show');
            }

            function pg_graduands_template () {
                $("#pg_graduands_templateModal").modal('show');
            }

            $("#UgradList").addClass("activeTab");
                $("#UgradList").click(function() {
                    $("#UgradList").addClass("activeTab");
                    $("#PgradList").removeClass("activeTab");

                    document.getElementById("ucardBody").style.display = 'inherit';
                    document.getElementById("ucardBody2").style.display = 'none';
                })

                $("#PgradList").click(function() {
                    $("#PgradList").addClass("activeTab");
                    $("#UgradList").removeClass("activeTab");

                    document.getElementById("ucardBody2").style.display = 'inherit';
                    document.getElementById("ucardBody").style.display = 'none';
                })

                function upload() {
                    var form = document.querySelector("#upload_form");
                    var formdata = new FormData(form);

                    $.ajax({
                        type: 'POST',
                        url: 'upload.php',
                        data: formdata,
                        cache: false,
                        processData: false,
                        contentType: false,

                        success: function(response) {

                        }
                    })
                }


 
        </script>

</body>

</html>
<?php
// }else{
// //  header('Location: ../1753');
//     echo "<script type='text/javascript'>window.history.back()</script>";
// }
?>
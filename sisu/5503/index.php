<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";
require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '2' ";
$result = mysqli_query($conn, $sql);
if($result->num_rows>0){
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.7, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title."Profile" ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendor/nprogress/nprogress.css" rel="stylesheet">

    <link href="../vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
        .morris-hover.morris-default-style {
            padding: 6px;
            color: #666;
            background: rgba(243, 242, 243, .8);
            border: 2px solid rgba(195, 194, 196, .8);
            font-family: sans-serif;
            font-size: 12px;
            text-align: center;
        }

        .morris-hover {
            position: absolute;
            z-index: 1000;
        }

        ul.messages li .message_wrapper blockquote {
            padding: 0 10px;
            font-size: 17.5px;
            margin: 0;
            border-left: 5px solid #eee;
        }

        ul.messages {
            padding: 0;
            list-style: none;
        }

        ul.messages li .message_date {
            float: right;
            text-align: right;
        }

        ul.messages li .message_wrapper {
            margin-left: 50px;
            margin-right: 40px;
        }

        .text-info {
            color: #31708f;
        }

        .h1,
        .h2,
        .h3,
        h1,
        h2,
        h3 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .tasks li,
        ul.messages li {
            border-bottom: 1px dotted #e6e6e6;
            padding: 8px 0;
        }

        #hidden {
            visibility: hidden;
        }

        tr:hover #hidden {
            visibility: visible;
        }

        .profile_title_ {
            background: #f5f7fa;
            border: 0;
            padding: 7px 0;
            display: flex;
        }

        .caret {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 2px;
            vertical-align: middle;
            border-top: 4px dashed;
            border-top: 4px solid\9;
            border-right: 4px solid transparent;
            border-left: 4px solid transparent;
        }

        .col-md-6 {
            position: relative;
            min-height: 1px;
            float: left;
            padding-right: 10px;
            padding-left: 10px;
        }

        .col-md-9 .col-sm-9 .col-xs-12 {
            position: relative;
            min-height: 1px;
            float: left !important;
            padding-right: 10px;
            padding-left: 10px;
        }

        ul.bar_tabs {
            overflow: visible;
            background: #F5F7FA;
            height: 25px;
            margin: 21px 0 14px;
            padding-left: 14px;
            position: relative;
            z-index: 1;
            width: 100%;
            border-bottom: 1px solid #E6E9ED;
        }

        ul.bar_tabs>li.active {
            border-right: 6px solid #D3D6DA;
            border-top: 0;
            margin-top: -15px;
        }

        ul.bar_tabs>li {
            border: 1px solid #E6E9ED;
            color: #333 !important;
            margin-left: 8px;
            background: #fff;
            border-bottom: none;
            border-radius: 4px 4px 0 0;
        }

        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        ul.bar_tabs>li {
            border: 1px solid #E6E9ED;
            color: #333 !important;
            margin-top: -17px;
            margin-left: 8px;
            background: #fff;
            border-bottom: none;
            border-radius: 4px 4px 0 0;
        }

        ul.bar_tabs>li a {
            padding: 10px 17px;
            background: #F5F7FA;
            margin: 0;
            border-top-right-radius: 0;
        }

        .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }

        .nav>li {
            position: relative;
            display: block;
        }

        img.avatar,
        ul.messages li img.avatar {
            height: 32px;
            width: 32px;
            float: left;
            display: inline-block;
            border-radius: 2px;
            padding: 2px;
            background: #f7f7f7;
            border: 1px solid #e6e6e6;
        }

        .form-control-label {
            font-weight: bold;
            font-family: initial;
        }

        form {
            font-size: 110%
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

        <a class="navbar-brand mr-1" href="../7098"><img src="../images/favicon.png" width="30px" height="30px"> UIMISs</a>

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
                    <a class="dropdown-item" href="../2736">View All Tasks</a>
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
                    <a class="dropdown-item" href="../9035">View All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../3401">Settings</a>
                    <a class="dropdown-item" href="../1285">Activity Log</a>
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
                    <a href="#">
                        <img class="align-self-center rounded-circle mr-3" src="<?php echo($_SESSION['picture']); ?>" width="70px" width="70px" height="70px" />
                    </a>
                    <div class="media-body" id="identification">
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
            <a id="dashboard_tab" class="dropdown-item" href="../1753/"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>

            <a id="profile_tab" class="dropdown-item active" href="../5503"><i class="fas fa-fw fa-user"></i> Profile</a>

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
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>



                <div class="card mb-3 animated fadeInRight">
                    <div class="card-header">
                        <i class="fas fa-fw fa-user"></i>Profile
                    </div>
                    <div class="card-body">
                        <!--Begining--->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2 style="font-size: 18px">User Report <small style="font-size: 65%;">Activity report</small></h2>

                                        <div class="clearfix"></div>
                                    </div>



                                    <div class="col-md-9 col-sm-9 col-xs-12" style="position: relative;min-height: 1px;float: right;padding-right: 10px;padding-left: 10px;width: 75%;">
                                        <div class="profile_title_">
                                            <div class="col-md-6">
                                                <h2>User Activity Report</h2>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- start of user-activity-graph -->
                                        <canvas id="user_bar" style="width:100%; height:400px;"></canvas>
                                        <br />
                                        <br />
                                        <hr />

                                        <div class="default-tab">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Recent Activity</a>

                                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Profile</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <ul class="messages">

                                                        <?php
                                                      // require_once('../Db/connection.php');
                                                      $user = $_SESSION['uname'];
                                                      $query = "SELECT * FROM tbl_log where username = '$user' order by ttime DESC limit 15 ";
                                                      $result = mysqli_query($conn, $query);
                                                      if($result->num_rows > 0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                    ?>
                                                        <li>
                                                            <div class="message_date">
                                                                <h3 class="date text-info"><?php echo strftime('%d',strtotime($row['ttime'])) ?></h3>
                                                                <p class="month"><?php echo strftime('%b',strtotime($row['ttime'])) ?></p>
                                                            </div>
                                                            <img class="avatar" src="<?php echo($_SESSION['picture']); ?>" width="32px" height="70px" />
                                                            <div class="message_wrapper">
                                                                <h4 class="heading"><?php echo $_SESSION['FNAME']." ".$_SESSION['LNAME'] ?></h4>
                                                                <blockquote class="message"><?php echo $row['event'] ?></blockquote>
                                                            </div>
                                                        </li>
                                                        <br>
                                                        <?php
                                  }
                                }else{
                                  echo "NOTHING TO DISPLAY";
                                }
                              ?>

                                                    </ul>
                                                </div>

                                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                    <form>
                                                        <div class="row">

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="desig_id" class="form-control-label">First Name:</label>
                                                                    <p id="vfname"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="added" class="form-control-label">Date of Birth:</label>
                                                                    <p id="vdob"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="added" class="form-control-label">Phone:</label>
                                                                    <p id="vphone"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="vtitle" class="form-control-label">Title:</label>
                                                                    <p id="vtitle"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_modified" class="form-control-label">Added By:</label>
                                                                    <p id="vadd_by"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_modified" class="form-control-label">Modified By:</label>
                                                                    <p id="vmod_by"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_modified" class="form-control-label">Date Modified:</label>
                                                                    <p id="vdate_mod"></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">

                                                                <div class="form-group">
                                                                    <label for="desig" class="form-control-label">Last Name:</label>
                                                                    <p id="vlname"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="added" class="form-control-label">Email:</label>
                                                                    <p id="vemail"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_added" class="form-control-label">Gender:</label>
                                                                    <p id="vgender"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_modified" class="form-control-label">Department:</label>
                                                                    <p id="vdept"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_modified" class="form-control-label">Username:</label>
                                                                    <p id="vuser"></p>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="date_modified" class="form-control-label">Date Added:</label>
                                                                    <p id="vdate_add"></p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>


                                        </div>
                                        <!-- end of user-activity-graph -->






                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong class="card-title mb-3">Profile Card</strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="mx-auto d-block">
                                                    <img class="rounded-circle mx-auto d-block" src="<?php echo($_SESSION['picture']); ?>" width="128px" height="128px" alt="Card image cap" />
                                                    <!-- <img class="rounded-circle mx-auto d-block" src="images/user.jpg" height="128px" width="128px" alt="Card image cap"> -->
                                                    <h5 class="text-sm-center mt-2 mb-1"><?php echo $_SESSION['FNAME']." ".$_SESSION['LNAME']  ?></h5>
                                                    <ul class="list-unstyled user_data">
                                                        <li><i class="fa fa-map-marker user-profile-icon"></i> Tamale, Ghana, West Africa
                                                        </li>

                                                        <li>
                                                            <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $_SESSION['dept']  ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <hr>

                                            </div>
                                        </div>
                                        <br>
                                        <div style="color: white;"><a href="../9086" class="btn btn-success btn-sm"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a></div>
                                    </div>
                                </div>
                            </div>

                            <!-- end of content-->
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

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
        <!-- morris.js -->
        <script src="../vendor/raphael/raphael.min.js"></script>
        <script src="../vendor/morris.js/morris.min.js"></script>
        <!-- Custom scripts for all pages-->

        <!-- Demo scripts for this page-->
        <script src="../js/demo/datatables-demo.js"></script>
        <!--PNotify-->
        <script src="../vendor/pnotify/dist/pnotify.js"></script>
        <!-- FullCalendar -->
        <script src="../vendor/moment/min/moment.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>

        <!-- Demo scripts for this page-->
        <script src="../js/demo/chart-area-demo.js"></script>

        <!--    <script src="../js/custom.min.js"></script>-->
        <script src="../js/cleanup.js"></script>
        <script src="../js/access.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                view();
                keep_open("keep-open,index");
            })

        </script>


        <script type="text/javascript">
            //GRAPH BAR 
            var ctx = $("#user_bar");
            var x = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Rate of Use',
                        data: [12, 12, 15, 20, 16, 16, 15, 34, 26, 25, 15, 20],
                        backgroundColor: '#9ed2c1',
                        borderColor: '#28d49c',
                        pointStyle: 'triangle',
                        pointRadius: '5',
                        pointHoverRadius: '10'
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'User Activity',
                        fontStyle: 'bold',
                        fontSize: 20,
                        position: 'top'
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            });

            function view() {
                var input = input;
                // alert(input);
                $.ajax({
                    url: 'profile.php',

                    success: function(responseText) {
                        //console.log(responseText);
                        var data = JSON.parse(responseText);

                        for (var i = 0; i < data.length; i++) {
                            var fname = data[i].first_name;
                            var lname = data[i].last_name;
                            var dob = moment(data[i].dob).format("DD-MMM-YYYY");
                            var title = data[i].title;
                            var email = data[i].email;
                            var gender = data[i].gender;
                            var phone = data[i].phone;
                            var user = data[i].username;
                            var dept = data[i].dept_descr;
                            var date_added = moment(data[i].date_added).format("DD-MMM-YYYY");
                            var added_by = data[i].added_by;
                            if(data[i].date_modified == '' || data[i].date_modified == null) {
                                var date_mod = '';
                            } else {
                                var date_mod = moment(data[i].date_modified).format("DD-MMM-YYYY");
                            }
                            var mod_by = data[i].modified_by;

                        }

                        $("#viewProf").modal('show');
                        document.getElementById("vfname").innerHTML = fname;
                        document.getElementById("vlname").innerHTML = lname;
                        document.getElementById("vdob").innerHTML = dob;
                        document.getElementById("vtitle").innerHTML = title;
                        document.getElementById("vemail").innerHTML = email;
                        document.getElementById("vgender").innerHTML = gender;
                        document.getElementById("vphone").innerHTML = phone;
                        document.getElementById("vuser").innerHTML = user;
                        document.getElementById("vdept").innerHTML = dept;
                        document.getElementById("vdate_add").innerHTML = date_added;
                        document.getElementById("vadd_by").innerHTML = added_by;
                        document.getElementById("vdate_mod").innerHTML = date_mod;
                        document.getElementById("vmod_by").innerHTML = mod_by;

                    }
                });
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
<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";

require("../Db/connection.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '18' ";
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

    <title><?php echo $title."Task Scheduler" ?></title>
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
    <!-- Custom styling plus plugins -->

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

            <a id="pg_services_tab" class="dropdown-item" href="../7473">PG Services</a>

            <a id="certificate_tab" class="dropdown-item" href="../2847">Certificate</a>

            <a id="signatory_tab" class="dropdown-item" href="../3685">Signatory</a>

            <a id="task_tab" class="dropdown-item active" href="../5798">Task Scheduler</a>

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
            <li class="breadcrumb-item active">Task Scheduler</li>
          </ol>

        <!-- /.container-fluid -->
            <div class="card mb-3 animated fadeInRight">
                    <div class="card-header">
                        <?php
                            // require_once('../Db/connection.php');
                            $sql = "SELECT count(*) as total FROM trial_transcript WHERE Req_No_Rem < '1'";
                            $rs = mysqli_query($conn, $sql);
                            if($rs) {
                                while($row = mysqli_fetch_assoc($rs)) {
                                    $count = $row['total'];
                                }
                                if($count == 0) {
                                    echo "<span id='total' style='float:right;font-size:12px' class='label'>Total Processed: 0</span>";
                                } else if ($count > 0) {
                                    echo "<span id='total' style='float:right;font-size:12px' class='label''>Total Processed: ".$count."</span>";
                                }
                            }
                        ?>
                        <i class=""></i>Task Scheduler
                    </div>
                <div class="card-body">
                  <span style="float: right;"><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#issuerModal">View Issuers</button></span>
                  <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="sched_tbl">
                            <thead>
                                <th>S/N</th>
                                <th>Index Number</th>
                                <th>Category</th>
                                <th>Date Submitted</th>
                                <th>Status/Date</th>
                                <th>Assigned To</th>
                                <th></th>
                            </thead>
                            <tbody id="schedule_body" style="text-transform: uppercase;">
                              
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
        
         <!-- Reassign Modal-->
    <div class="modal fade" id="reassign_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reassignment</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" style="text-transform: uppercase;">
              <form>
                  <div class="form-group">
                  <input type="text" id="transid" class="form-control" hidden style="text-align:center;">
                  </div>
                  
                  <div class="form-group">
                      <div class="label" style="width: 90%;font-size:12px">Assigned To:</div>
                  <input type="text" id="assigned" class="form-control" disabled style="text-align:center;">
                  </div>
                  
                  <div class="form-group">
                      <div class="label" style="width: 90%;font-size:12px">Reassign To:</div>
                  <select id="select_reassign" class="form-control" style="text-align:center;text-transform: uppercase;">
                      <option value="" selected disabled>Select User</option>
                      <?php 
                            // require_once('../Db/connection.php');
                            $sql = "SELECT staff_ID, first_name, last_name, username FROM tbl_user_profile";
                            $rs= mysqli_query($conn, $sql);
                        
                            if($rs) {
                                while($row = mysqli_fetch_assoc($rs)) {
                                    ?>
                      <option value="<?php echo $row['username'] ?>"><?php echo $row['first_name'].' '.$row['last_name'] ?></option>
                      <?php
                                }
                            }
                        ?>
                  </select>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Dismiss</button>
            <button onclick="reassign()" class="btn btn-sm btn-primary">Reassign</button>
            
          </div>
        </div>
      </div>
    </div>

             <!-- Issuer Modal-->
    <div class="modal fade" id="issuerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Issuer Modal</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" style="text-transform: uppercase;">
              <table class="table table-hover" id="issue_tbl">
                <thead>
                  <th>#</th>
                  <th>Name</th>
                  <th>Transcript</th>
                </thead>

                <tbody id="issue_body">
                  
                </tbody>
              </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-secondary btn-sm" type="button" data-dismiss="modal">Dismiss</button>
            <button onclick="update_issuer()" class="btn btn-sm btn-success btn-sm">Save</button>
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
    <script src="../js/custom.min.js"></script>
    <script src="../js/cleanup.js"></script>
    <script src="function.js"></script>
    <script src="../js/access.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){

          keep_open("keep-open,index");
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
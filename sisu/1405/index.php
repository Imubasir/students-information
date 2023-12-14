<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";


// require("../Db/connection.php");
// $user = $_SESSION['uname'];
// $sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '9' ";
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

    <title><?php echo $title."Attestation" ?></title>
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

      <a class="navbar-brand mr-1" href="../1753"><img src="../images/favicon.png" width="30px" height="30px">UIMIS </a>

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
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
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
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
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
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <!-- <a class="dropdown-item" href="../1326"> Certification</a> -->

            <a class="dropdown-item" href="../3394"> Courses</a>

            <a class="dropdown-item" href="../3655"> Enrollments</a>

            <a class="dropdown-item" href="../7738"> Programmes</a>

            <a class="dropdown-item" href="../5997"> Results</a>                                
          </div>
        </li>
           <!--End of Postgraduate-->

           <!--Transcript-->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-archive"></i>
            <span>Services</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="../6768">UG Services</a>

            <a class="dropdown-item" href="../7473">PG Services</a>

            <a class="dropdown-item" href="../2847">Certificate</a>

            <a class="dropdown-item" href="../3685">Signatory</a>

            <a class="dropdown-item" href="../5798">Task Scheduler</a>

            <a class="dropdown-item" href="../2040">Request</a>                                   
          </div>
        </li>
        <!--End of Transcript-->

        <!--Letters-->
          <li class="nav-item dropdown active keep-open">
          <a class="nav-link dropdown-toggle index" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope-open-text"></i>
            <span>Letters</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item active" href="../1405">Attestation</a>

            <a class="dropdown-item" href="../4030">Confirmatory</a>

            <a class="dropdown-item" href="../9318">English Proficiency</a>
          </div>
        </li>
        <!--End of Letters-->

        <!--Analytics-->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-chart-line"></i>
            <span>Analytics</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
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
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="../7673"><i class="far fa-building"></i> Campus</a>

            <a class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

            <a class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>
            
            <a class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>

            <a class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

            <a class="dropdown-item" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

          	<a class="dropdown-item" href="../1242"><i class="fas fa-user-plus"></i> Users</a>

            <a class="dropdown-item" href="../8015"><i class="fas fa-fw fa-clock"></i > Log</a>
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
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>

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
    </script>
    
 </body>
</html>
<?php
// }else{
// //  header('Location: ../1753');
//     echo "<script type='text/javascript'>window.history.back()</script>";
// }
?>



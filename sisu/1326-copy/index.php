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

    <title><?php echo $title."Postgraduate Certification" ?></title>
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
    <link type="text/css" href="index.css" rel="stylesheet">

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
           <li class="nav-item dropdown active keep-open">
          <a class="nav-link dropdown-toggle index" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-graduate"></i>
            <span>Postgraduate</span>
          </a>
          <div class = "dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item active" href="../1326"> Certification</a>

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
            <li class="breadcrumb-item active">Postgraduate Certification</li>
          </ol>

        <!-- /.container-fluid -->
        <div class="card mb-3 animated fadeInRight">
                    <div class="_card-header">

                        <ul id="ol">
                            <li id="gradList"><i class="fas fa-graduation-cap"></i> Graduand List</li>

                            <li id="veriList"><i class="fas fa-check-double"></i> Verification</li>

                            <li id="export" style="border-right: none"><i class="fas fa-share-square"></i> Export</li>

                        </ul>

                    </div>

                    <div class="animated fadeInRight" style="background-color: #d7ffe0;border: 2px outset white;;">

                    </div>

                    <div class="card-body" id="gradBody">
                        <span style="float:right;display: block;"><button onclick="gradSearch()" class="btn btn-sm btn-danger"><i class="fas fa-search"></i> Custom Search</button></span><br><br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="gradTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>UIN</th>
                                        <th>Index No.</th>
                                        <th>Certificate Name</th>
                                        <th>Programme</th>
                                        <th>Class</th>
                                        <th>Year</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody id="gradTableBody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- Verification List-->
                    <div class="card-body" id="veriBody" style="display:none;">
                        <span style="float:right;display: block;"><button onclick="veriSearch()" class="btn btn-sm btn-danger"><i class="fas fa-search"></i> Custom Search</button></span><br><br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="veriTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>UIN</th>
                                        <th>Student No.</th>
                                        <th>Name</th>
                                        <th>Index No.</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Programme</th>
                                        <th>Remark</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="veriTableBody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Export-->
                    <div class="card-body" id="exportBody" style="display:none;">
                        <div class="table-responsive" style="width: 60%;box-shadow: 10px 10px 20px;padding: 50px;margin-left: 20%;">
                            <h2 style="text-align: center;">Search for Data to Export</h2>
                                <form id="exportForm" style="">
                                    
                                    <div class="form-group" id="form_grp_1">
                                        <div class="form-label-group">
                                            <select name="category" id="category" class="form-control">
                                                <option disabled selected value="">Category</option>
                                                <option value="gradlist">Graduand List</option>
                                                <option value="verif_det">Verification Details</option>
                                                <option value="waec">WAEC Results</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="form_grp_2">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control" name="student_uin" id="student_uin">
                                            <label>Student ID/UIN/Index No.</label>
                                        </div>
                                    </div>

                                    <div class="form-group" id="form_grp_3">
                                        <div class="form-label-group">
                                            <select name="programme" id="programme" class="form-control">
                                                <option disabled selected value="">Select Programme</option>
                                                <?php
                                                require_once('../Db/connection.php');
                                                $sql = "SELECT * FROM programme order by progname ASC";
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
                                        </div>
                                    </div>

                                    <div class="form-group" id="form_grp_4">
                                        <div class="form-label-group">
                                            <select name="graddate" id="graddate" class="form-control">
                                                <option disabled selected value="">Graduation Date</option>
                                                <?php
                                                require_once('../Db/connection.php');
                                                $sql = "SELECT DISTINCT graddate FROM tbl_graduate order by graddate ASC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['graddate'] ?>"><?php echo $row['graddate'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="form_grp_5">
                                        <div class="form-label-group">
                                            <select name="year" id="year" class="form-control">
                                                <option disabled selected value="">Year</option>
                                                <?php
                                                require_once('../Db/connection.php');
                                                $sql = "SELECT DISTINCT exam_year FROM tbl_shs_results order by exam_year DESC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['exam_year'] ?>"><?php echo $row['exam_year'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="form_grp_6">
                                        <div class="form-label-group">
                                            <select name="class" id="class" class="form-control">
                                                <option disabled selected value="">Class</option>
                                                <?php
                                                require_once('../Db/connection.php');
                                                $sql = "SELECT DISTINCT gradclass FROM tbl_graduate order by gradclass ASC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['gradclass'] ?>"><?php echo $row['gradclass'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="form_grp_7">
                                        <div class="form-label-group">
                                            <select name="status" id="status" class="form-control">
                                                <option disabled selected value="">Status</option>
                                                <?php
                                                require_once('../Db/connection.php');
                                                $sql = "SELECT DISTINCT qualification_status FROM studentbiodata order by qualification_status ASC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['qualification_status'] ?>"><?php echo $row['qualification_status'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                    <div style="text-align: center;"><button onclick="exportSearch()" class="btn btn-sm btn-danger">Search</button></div>
                        </div>
                    </div>
                    
                <!--Export Graduation List table -->
                 <div class="card-body" id="exportTable" style= "display: none;">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered" id="export_gradTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>UIN</th>
                                        <th>Index No.</th>
                                        <th>Certificate Name</th>
                                        <th>Programme</th>
                                        <th>Class</th>
                                        <th>Year</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody id="export_gradBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                        
                    
                    <div class="card-body" id="exportTableVerify" style= "display: none;">
                        <div class="table-responsive">
                            <button onclick="print_verify()"><i class="fa fa-print"></i>Print</button>
                            <table class="table table-hover table-striped" id="export_verifyTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2">UIN</th>
                                        <th rowspan="2">Student No.</th>
                                        <th rowspan="2">Index No.</th>
                                        <th colspan="3">Candidate Version</th>
                                        <th colspan="3">WAEC Version</th>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Grade</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody id="export_veriBody">

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



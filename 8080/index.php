<?php
session_start();

if(!$_SESSION['uname']){
  header('Location: ../');
}  

$title = "UDS Integrated Management Information System | ";
require("../Db/connection.php");
require("../Db/connection2.php");
$user = $_SESSION['uname'];
$sql = "SELECT * FROM tbl_pages where username = '$user' and fpage = '27' ";
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

    <title><?php echo $title."Edit Biodata" ?></title>
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
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <style type="text/css">
      .form-control, .single-line {
        width: 100%;
      }

        .modal_edit {
          max-width: fit-content;
         }

         .input {
           text-transform: uppercase;
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
              
            <a id="uni_halls" class="dropdown-item" href="../6540"><i class="fas fa-hotel"></i> University Halls</a>

            <a id="course_tab" class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

            <a id="department_tab" class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>
            
            <a id="programme_tab" class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>
            
            <a id="upload_tab" class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

            <a id="edit_tab" class="dropdown-item active" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

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
              Settings
            </li>
            <li class="breadcrumb-item active">Edit Biodata</li>
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
               <div class="card-body" id="ucardBody">
                   
                  <div class="row">
                    <div class="col-4" style="border-right: 1px solid #f1f1f1;">
                      <div style="box-shadow: 2px 2px 10px 2px #28a745; padding: 20px">
                        <form>
                        <div class="form-group">
                          <label>Undergraduate Student ID:</label>
                          <input type="text" id="sid" name="sid" class="form-control" placeholder="Enter Student UIN / Index Number">
                        </div>
                      </form>
                      <button onclick="search_data()"  class="btn btn-sm btn-block btn-danger"><i class="fa fa-search"></i> Search</button>
                      <br>
                      <span style="color: black;font-size: 14px;font-weight: bold;">Status:</span> <br>
                      <span id="status" style="color: #28a745;">Waiting ... <img src="../images/ajax-loader-small.gif"></span>

                      <span id="modified_date" style="color: #28a745;"></span>
                      </div>
                      
                    </div>

                    <div class="col-8">
                      <div class="card-header">
                        <h5>Undergraduate Biodata Preview</h5>
                      </div>
                      <div class="card-body">
                        <table class="table" style="text-transform: uppercase;">
                          <tr style="text-align: center;">
                            <td colspan="4" style="border-top: none;"><img src="../images/avatar.png" width="100px" height="100px" class="align-self-center rounded-circle mr-3"></td>
                          </tr>
                          <tr>
                            <td>Index Number: </td>
                            <td><span id="indexno"></span></td>

                            <td>Name: </td>
                            <td><span id="name"></span></td>
                          </tr>

                          <tr>
                            <td>Programme: </td>
                            <td><span id="prog"></span></td>

                            <td>Option: </td>
                            <td><span id="option"></span></td>
                          </tr>

                          <tr>
                            <td>Department: </td>
                            <td><span id="dept"></span></td>

                            <td>Campus: </td>
                            <td><span id="campus"></span></td>
                          </tr>
                          <tr>
                            <td colspan="4">
                              <button id="editBtn" class="btn btn-block btn-success"><i class="fa fa-edit"></i> Edit</button>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>


               </div>

               <div class="card-body" id="ucardBody2" style="display: none;">
                   <div class="row">
                    <div class="col-4" style="border-right: 1px solid #f1f1f1;">
                      <div style="box-shadow: 2px 2px 10px 2px #28a745; padding: 20px">
                        <form>
                        <div class="form-group">
                          <label> Postgraduate Student ID:</label>
                          <input type="text" id="pg_sid" name="pg_sid" class="form-control" placeholder="Enter Student UIN / Index Number">
                        </div>
                      </form>
                      <button onclick="pg_search_data()"  class="btn btn-sm btn-block btn-danger"><i class="fa fa-search"></i> Search</button>
                      <br>
                      <span style="color: black;font-size: 14px;font-weight: bold;">Status:</span> <br>
                      <span id="pg_status" style="color: #28a745;">Waiting ... <img src="../images/ajax-loader-small.gif"></span>

                      <span id="pg_modified_date" style="color: #28a745;"></span>
                      </div>
                      
                    </div>

                    <div class="col-8">
                      <div class="card-header">
                        <h5>Postgraduate Biodata Preview</h5>
                      </div>
                      <div class="card-body">
                        <table class="table" style="text-transform: uppercase;">
                          <tr style="text-align: center;">
                            <td colspan="4" style="border-top: none;"><img src="../images/avatar.png" width="100px" height="100px" class="align-self-center rounded-circle mr-3"></td>
                          </tr>
                          <tr>
                            <td>Index Number: </td>
                            <td><span id="pg_indexno"></span></td>

                            <td>Name: </td>
                            <td><span id="pg_name"></span></td>
                          </tr>

                          <tr>
                            <td>Programme: </td>
                            <td><span id="pg_prog"></span></td>

                            <td>Option: </td>
                            <td><span id="pg_option"></span></td>
                          </tr>

                          <tr>
                            <td>Department: </td>
                            <td><span id="pg_dept"></span></td>

                            <td>Campus: </td>
                            <td><span id="pg_campus"></span></td>
                          </tr>
                          <tr>
                            <td colspan="4">
                              <button onclick="pg_editBiodata()" class="btn btn-block btn-success"><i class="fa fa-edit"></i> Edit</button>
                            </td>
                          </tr>
                        </table>
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

    <!-- UG Edit Modal-->
    <div class="modal fade" id="ug_editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal_edit" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <form id="ug_edit_form">
                <table class="table">
                  <tr>
                    <td class="__label">Index Number</td>
                    <td class="input" style="width: 40%;"><input type="text" name="edit_indexno" id="edit_indexno" class="form-control" readonly="" style="text-transform: uppercase;"></td>

                    <td class="__label">UIN</td>
                    <td class="input" style="width: 40%;"><input type="text" name="uin" id="uin" class="form-control" readonly="" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Surname</td>
                    <td class="input"><input type="text" name="sname" id="sname" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">First Name</td>
                    <td class="input"><input type="text" name="fname" id="fname" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Middle Name</td>
                    <td class="input"><input type="text" name="mname" id="mname" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Gender</td>
                    <td class="input">
                      <!-- <input type="text" name="gender" id="gender" class="form-control" style="text-transform: uppercase;"> -->
                      <select class="form-control" name="gender" id="gender">
                        <option></option>
                        <option value="FEMALE">FEMALE</option>
                        <option value="MALE">MALE</option>
                      </select>

                    </td>
                  </tr>

                  <tr>
                    <td class="__label">DOB</td>
                    <td class="input"><input type="date" name="dob" id="dob" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Place of Birth</td>
                    <td class="input"><input type="text" name="pob" id="pob" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Home Town</td>
                    <td class="input"><input type="text" name="htown" id="htown" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Region of Birth</td>
                    <td class="input">
                      <select name="rob" id="rob" class="form-control" style="text-transform: uppercase;">
                        <option value="">Select Region of Birth</option>
                        <?php
                        // require_once("../Db/connection.php");
                        $rs = mysqli_query($conn, "SELECT * FROM region ORDER BY regionname");
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
                    <td class="__label">Home Address</td>
                    <td class="input"><textarea name="homeaddress" id="homeaddress" class="form-control" style="text-transform: uppercase;"></textarea></td>

                    <td class="__label">Phone Number</td>
                    <td class="input"><input type="text" name="fonnumber" id="fonnumber" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Disability Status</td>
                    <td class="input">
                      <select name="disability_status" id="disability_status" class="form-control" style="text-transform: uppercase;">
                        <option></option>
                        <option value="NO">No</option>
                        <option value="YES">Yes</option>
                      </select>
                    </td>

                    <td class="__label">Disability Description</td>
                    <td class="input"><input type="text" name="disability_descr" id="disability_descr" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Guardian Name</td>
                    <td class="input"><input type="text" name="guardian_name" id="guardian_name" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Guardian Address</td>
                    <td class="input">
                      <textarea name="guardian_address" id="guardian_address" class="form-control"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <td class="__label">Programme</td>
                    <td class="input">
                      <select name="sprogid" id="sprogid" class="form-control" style="text-transform: uppercase;">
                        <option value="">Select Programme</option>
                        <?php
                        // require_once("../Db/connection.php");
                        $rs = mysqli_query($conn, "SELECT * FROM programme ORDER BY progname");
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

                    <td class="__label">Entry Year</td>
                    <td class="input"><input type="text" name="entryyear" id="entryyear" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Entry Level</td>
                    <td class="input">
                      <select name="entrylevel" id="entrylevel" class="form-control" style="text-transform: uppercase;">
                        <option value="1">100</option>
                        <option value="2">200</option>
                        <option value="3">300</option>
                        <option value="4">400</option>
                        <option value="5">500</option>
                        <option value="6">600</option>
                        <option value="6">700</option>
                        <option value="6">PBL 1</option>
                        <option value="6">PBL 2</option>
                        <option value="6">PBL 3</option>
                        <option value="6">PBL 4</option>
                        <option value="6">PBL 5</option>
                        <option value="6">PBL 6</option>
                      </select>
                    </td>

                    <td class="__label">Current Level</td>
                    <td class="input">
                      <!-- <input type="text" name="currentlevel" id="currentlevel" class="form-control" style="text-transform: uppercase;"> -->
                      <select name="currentlevel" id="currentlevel" class="form-control" style="text-transform: uppercase;">
                        <option value="1">100</option>
                        <option value="2">200</option>
                        <option value="3">300</option>
                        <option value="4">400</option>
                        <option value="5">500</option>
                        <option value="6">600</option>
                        <option value="6">700</option>
                        <option value="6">PBL 1</option>
                        <option value="6">PBL 2</option>
                        <option value="6">PBL 3</option>
                        <option value="6">PBL 4</option>
                        <option value="6">PBL 5</option>
                        <option value="6">PBL 6</option>
                      </select>
                    </td>
                  </tr>

                  <tr>
                    <td class="__label">Option</td>
                    <td class="input">
                      <select name="edit_option" id="edit_option" class="form-control" style="text-transform: uppercase;">
                        <?php
                        // require_once("../Db/connection.php");
                        $rs = mysqli_query($conn, "SELECT * FROM tbl_option ORDER BY option_title");
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

                    <td class="__label">Nationality</td>
                    <td class="input">
                      <select name="nationality" id="nationality" class="form-control" style="text-transform: uppercase;">
                        <?php
                        // require_once("../Db/connection.php");
                        $rs = mysqli_query($conn, "SELECT * FROM tbl_country ORDER BY countrynm");
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
                    <td class="__label">Qualification Status</td>
                    <td class="input"><input type="text" name="qualification_status" id="qualification_status" class="form-control" readonly="" style="text-transform: uppercase;"></td>

                    <td class="__label">Username</td>
                    <td class="input"><input type="text" name="username" id="username" class="form-control" readonly="" style="text-transform: uppercase;"></td>
                  </tr>
                  <tr>
                    <td class="__label">Fee Category</td>
                    <td class="input"><select name="fee_category" id="fee_category" class="form-control" style="text-transform: uppercase;">
                        <?php
                        // require_once("../Db/connection.php");
                        $rs = mysqli_query($conn, "SELECT DISTINCT fee_category FROM studentbiodata");
                        if($rs) {
                          while($row = mysqli_fetch_assoc($rs)) {
                            ?>
                            <option><?php echo $row['fee_category'] ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select></td>

                      <td class="__label">Admission Category</td>
                      <td class="input"><input type="text" id="admn_category" name="admn_category" class="form-control" style="text-transform: uppercase;" readonly=""></td>
                  </tr>

                  <tr>
                    <td class="__label">Institutional Email</td>
                    <td class="input"><input type="text" name="inst_mail" id="inst_mail" class="form-control" readonly="" style="text-transform: lowercase;"></td>

                    <td class="__label">Study Status</td>
                    <td class="input"><input type="text" name="study_status" id="study_status" class="form-control" readonly="" style="text-transform: uppercase;"></td>
                  </tr>

                </table>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li class="dropdown-item"><a style="color: black" id="defer_btn" href="#">Defer</a></li>
                <li class="dropdown-item"><a style="color: black" id="suspend_btn" href="#">Suspend</a></li>
                <li class="dropdown-item"><a style="color: black" id="withdraw_btn" href="#">Withdraw</a></li>
                <li class="dropdown-item"><a style="color: black" id="delete_btn" href="#">Delete</a></li>
              </ul>
            </div>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button onclick="ug_update()" class="btn btn-success">Update</button>
            
          </div>
        </div>
      </div>
    </div>

    <!-- PG Edit Modal-->
    <div class="modal fade" id="pg_editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal_edit" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Postgraduate Student</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <form id="pg_edit_form">
                <table class="table">
                  <tr>
                    <td class="__label">Index Number</td>
                    <td class="input" style="width: 40%;"><input type="text" name="pg_edit_indexno" id="pg_edit_indexno" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">UIN</td>
                    <td class="input" style="width: 40%;"><input type="text" name="pg_uin" id="pg_uin" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Surname</td>
                    <td class="input"><input type="text" name="pg_sname" id="pg_sname" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">First Name</td>
                    <td class="input"><input type="text" name="pg_fname" id="pg_fname" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Middle Name</td>
                    <td class="input"><input type="text" name="pg_mname" id="pg_mname" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Gender</td>
                    <td class="input"><input type="text" name="pg_gender" id="pg_gender" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">DOB</td>
                    <td class="input"><input type="date" name="pg_dob" id="pg_dob" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Place of Birth</td>
                    <td class="input"><input type="text" name="pg_pob" id="pg_pob" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Home Town</td>
                    <td class="input"><input type="text" name="pg_htown" id="pg_htown" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Region of Birth</td>
                    <td class="input">
                      <select name="pg_rob" id="pg_rob" class="form-control" style="text-transform: uppercase;">
                        <option value="">Select Region of Birth</option>
                        <?php
                        // require_once("../Db/connection2.php");
                        $rs = mysqli_query($conn, "SELECT * FROM region ORDER BY regionname");
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
                    <td class="__label">Home Address</td>
                    <td class="input"><textarea name="pg_homeaddress" id="pg_homeaddress" class="form-control" style="text-transform: uppercase;"></textarea></td>

                    <td class="__label">Phone Number</td>
                    <td class="input"><input type="text" name="pg_fonnumber" id="pg_fonnumber" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Disability Status</td>
                    <td class="input">
                      <select name="pg_disability_status" id="pg_disability_status" class="form-control" style="text-transform: uppercase;">
                        <option></option>
                        <option value="NO">No</option>
                        <option value="YES">Yes</option>
                      </select>
                    </td>

                    <td class="__label">Disability Description</td>
                    <td class="input"><input type="text" name="pg_disability_descr" id="pg_disability_descr" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Guardian Name</td>
                    <td class="input"><input type="text" name="pg_guardian_name" id="pg_guardian_name" class="form-control" style="text-transform: uppercase;"></td>

                    <td class="__label">Guardian Address</td>
                    <td class="input">
                      <textarea name="pg_guardian_address" id="pg_guardian_address" class="form-control" style="text-transform: uppercase;"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <td class="__label">Programme</td>
                    <td class="input">
                      <select name="pg_sprogid" id="pg_sprogid" class="form-control" style="text-transform: uppercase;">
                        <option value="">Select Programme</option>
                        <?php
                        // require_once("../Db/connection2.php");
                        $rs = mysqli_query($conn2, "SELECT * FROM programme ORDER BY progname");
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

                    <td class="__label">Entry Year</td>
                    <td class="input"><input type="text" name="pg_entryyear" id="pg_entryyear" class="form-control" style="text-transform: uppercase;"></td>
                  </tr>

                  <tr>
                    <td class="__label">Entry Level</td>
                    <td class="input">
                      <select name="pg_entrylevel" id="pg_entrylevel" class="form-control">
                        <option value="1">100</option>
                        <option value="2">200</option>
                        <option value="3">300</option>
                        <option value="4">400</option>
                        <option value="5">500</option>
                        <option value="6">600</option>
                      </select>
                    </td>

                    <td class="__label">Current Level</td>
                    <td class="input"><input type="text" name="pg_currentlevel" id="pg_currentlevel" class="form-control"></td>
                  </tr>

                  <tr>
                    <td class="__label"><!-- Option --></td>
                    <td class="input">
                      
                    </td>

                    <td class="__label">Nationality</td>
                    <td class="input">
                      <select name="pg_nationality" id="pg_nationality" class="form-control">
                        <?php
                        // require_once("../Db/connection2.php");
                        $rs = mysqli_query($conn, "SELECT * FROM tbl_country ORDER BY countrynm");
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
                    <td class="__label">Qualification Status</td>
                    <td class="input"><input type="text" name="pg_qualification_status" id="pg_qualification_status" class="form-control"></td>

                    <td class="__label">Username</td>
                    <td class="input"><input type="text" name="pg_username" id="pg_username" class="form-control"></td>
                  </tr>

                  <tr>
                    <td class="__label">Institutional Email</td>
                    <td class="input"><input type="text" name="pg_inst_mail" id="pg_inst_mail" class="form-control"></td>

                    <td class="__label">Study Status</td>
                    <td class="input"><input type="text" name="pg_study_status" id="pg_study_status" class="form-control"></td>
                  </tr>

                </table>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
            <button onclick="pg_update()" class="btn btn-success btn-sm">Update</button>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Action Modal-->
        <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="action_title">Action Performed</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="act_table">
                            <tr>
                                <td class="act_label">Index Number: </td>
                                <td class="act_data" id="act_sid"></td>
                            </tr>
                            <tr>
                                <td class="act_label">Programme:</td>
                                <td class="act_data" id="act_prog"></td>
                            </tr>
                            <tr>
                                <td class="act_label">Current Study Status:</td>
                                <td class="act_data" id="cur_status" style="font-size: 20px;color: red;"></td>
                            </tr>
                            

                        </table>

                        <form id="actionForm">
                            <div id="hide_date">
                            <div class="form-group" class="hide_date">
                                <select class="form-control" name="start" id="start">
                                    <option value="">Start Period</option>
                                    <?php
                                        $cur_month = date('m');
                                        if($cur_month > '09') {
                                            $y1 = date("Y");
                                            $y2 = date("Y")+1;
                                            $session = $y1."/".$y2;
                                        } else {
                                            $y1 = date("Y")-1;
                                            $y2 = date("Y");
                                            $session = $y1."/".$y2;
                                        }
                                    ?>
                                    <option value="<?php echo $session ?>"><?php echo $session ?></option>
                                </select>
                            </div>
                            
                            <div class="form-group" class="hide_date">
                                 <select class="form-control" name="end" id="end">
                                    <option value="">End Period</option>
                                    <?php
                                        $cur_month = date('m');
                                        if($cur_month > '09') {
                                            $y1 = date("Y")+1;
                                            $y2 = date("Y")+2;

                                            $y3 = date("Y")+2;
                                            $y4 = date("Y")+3;

                                            $session1 = $y1."/".$y2;
                                            $session2 = $y3."/".$y4;
                                        } else {
                                            $y1 = date("Y");
                                            $y2 = date("Y")+1;
                                            $session1 = $y1."/".$y2;

                                            $y3 = date("Y")+1;
                                            $y4 = date("Y")+2;
                                            $session2 = $y3."/".$y4;
                                        }
                                    ?>
                                    <option value="<?php echo $session1 ?>"><?php echo $session1 ?></option>
                                    <option value="<?php echo $session2 ?>"><?php echo $session2 ?></option>
                                </select>
                            </div>
                               </div>
                            
                            <div class="form-group">
                                <textarea name="action_reason" id="action_reason" class="form-control" style="height: 200px" placeholder="Write Reason for Action Here..."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button id="processBtn" class="btn btn-primary btn-sm">Process</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirm Action Modal-->
        <div class="modal fade" id="con_Action_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Profile Card</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="../images/avatar.png" width="128px" height="128px" alt="Student Image" />
                                    
                                    <table id="act_table">
                            <tr>
                                <td class="act_label">Index Number: </td>
                                <td class="act_data" id="con_sid"></td>
                            </tr>
                            <tr>
                                <td class="act_label">Programe:</td>
                                <td class="act_data" id="con_prog"></td>
                            </tr>

                            <tr>
                                <td class="act_label">Current Study Stutus:</td>
                                <td class="act_data con_status" ></td>
                            </tr>
                            <tr>
                                <td class="act_label">Start Period:</td>
                                <td class="act_data" id="startDate"></td>
                            </tr>
                            <tr>
                                <td class="act_label">End Period:</td>
                                <td class="act_data" id="endDate"></td>
                            </tr>

                        </table>
                                </div>
                                <hr>
                                <P><b>Student Is Currently <span class="con_status" style="text-decoration: underline;"></span></b></P>
                                <p><b>Are You Sure You Want to Change Study Status to 'On-Going'?</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button id="confirmBtn" class="btn btn-primary btn-sm">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirm Modal-->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion of Records</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Are You Sure You Want To Delete Record?
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button id="confirm_btn" class="btn btn-primary">Confirm</button>
            
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
          $("#UgradList").addClass("activeTab");
      });

      $("#UgradList").on('click', function() {
        document.getElementById("ucardBody").style.display = 'block';
        document.getElementById("ucardBody2").style.display = 'none';

        $("#UgradList").addClass("activeTab");
        $("#PgradList").removeClass("activeTab");
      })

      $("#PgradList").on('click', function() {
        document.getElementById("ucardBody").style.display = 'none';
        document.getElementById("ucardBody2").style.display = 'block';

        $("#PgradList").addClass("activeTab");
        $("#UgradList").removeClass("activeTab");
      })
    </script>
    
 </body>
</html>
<?php
}else{
//  header('Location: ../1753');
    echo "<script type='text/javascript'>window.history.back()</script>";
}
?>


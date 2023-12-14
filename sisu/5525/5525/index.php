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

    <title><?php echo $title."Undergraduate Certification" ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../js/plugins/uploader-master/uploader-master/dist/css/jquery.dm-uploader.min.css" rel="stylesheet" type="text/css">
    <link href="../js/plugins/uploader-master/uploader-master/demo/styles.css" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!--    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

    <!--PNotify-->
    <link href="../vendor/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendor/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- FullCalendar -->
    <link href="../vendor/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendor/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <link type="text/css" href="index.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
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
                        <img class="align-self-center rounded-circle mr-3" src="<?php echo $_SESSION['picture']; ?>" onerror='if(this.src != "../images/avatar.png") this.src = "../images/avatar.png" ' width="70px" height="70px">
                        <h4 class="text-light display-6"><?php echo $_SESSION['FNAME']." ".$_SESSION['LNAME']; ?></h4>
                        <p><?php echo $_SESSION['dept']; ?></p>
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
            <li class="nav-item dropdown active keep-open">
                <a class="nav-link dropdown-toggle index" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span>Undergraduate</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item active" href="../5525"> Certification</a>

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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-archive"></i>
                    <span>Services</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
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

                    <a class="dropdown-item" href="../4104"><i class="fas fa-book"></i> Courses</a>

                    <a class="dropdown-item" href="../7668"><i class="fas fa-city"></i> Departments</a>

                    <a class="dropdown-item" href="../3847"><i class="fas fa-book-open"></i> Programmes</a>
                    
            <a class="dropdown-item" href="../8127"><i class="fas fa-upload"></i> Data Upload</a>

            <a class="dropdown-item" href="../8080"><i class="fas fa-edit"></i> Edit Student</a>

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
                    <li class="breadcrumb-item active">Undergraduate Certification</li>
                </ol>

                <!-- /.container-fluid -->
                <div class="card mb-3 animated fadeInRight">
                    <div class="_card-header">

                        <ul id="ol">
                            <li id="gradList"><i class="fas fa-graduation-cap"></i> Graduand List</li>

                            <li id="veriList"><i class="fas fa-check-double"></i> Verification</li>

                            <li id="uploadList"><i class="fas fa-upload"></i> Upload Waec Data</li>

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
                                        <th>Cert. No.</th>
                                        <th>Certificate Name</th>
                                        <th>Programme</th>
                                        <th>Class</th>
                                        <th>Year</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody id="gradTableBody" style="text-transform: uppercase;">
                                    <?php
                                    require_once('../Db/connection.php');
									$dat='JULY 31, '.date('Y');
									//$dat='JULY 31, 2018';
                                    //$sql = "SELECT * FROM tbl_graduate LEFT JOIN studentbiodata on studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme on studentbiodata.sprogid = programme.progid where graddate LIKE YEAR(CURDATE()) ORDER BY graddate";
									$sql = "SELECT uin, studentbiodata.indexno, certno, firstname, middlename, surname, progname, gradclass, graddate, qualification_status FROM tbl_graduate LEFT JOIN studentbiodata on studentbiodata.indexno = tbl_graduate.indexno LEFT JOIN programme on studentbiodata.sprogid = programme.progid where graddate ='$dat'";
                                    $rs = mysqli_query($conn, $sql);
                                    
                                    if($rs) {
                                        $count = 0;
                                        while($row = mysqli_fetch_assoc($rs)) {
                                            $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['uin']; ?></td>
                                        <td><?php echo $row['indexno']; ?></td>
                                        <td><?php echo $row['certno']; ?></td>
                                        <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['surname']; ?></td>
                                        <td><?php echo $row['progname']; ?></td>
                                        <td><?php echo $row['gradclass']; ?></td>
                                        <td><?php echo $row['graddate']; ?></td>
                                        <td><?php echo $row['qualification_status']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
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
                                        <th>Entry Year</th>
                                        <th>Level</th>
                                        <th>Study Status</th>
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
                                            <select name="category" id="category" class="form-control" required>
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
                                                //require_once('../Db/connection.php');
                                                $sql = "SELECT * FROM programme order by progname ASC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                <option value="<?php echo $row['progid']; ?>"><?php echo $row['progname']; ?></option>
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
                                                //require_once('../Db/connection.php');
												//SELECT DATE_FORMAT(str_to_date(`graddate`,"%M %d, %Y"), "%M %d, %Y") FROM `tbl_graduate` WHERE 1 ORDER BY `DATE_FORMAT(str_to_date(``graddate``,"%M %d, %Y"), "%M %d, %Y")`
                                                $sql = "SELECT DISTINCT graddate FROM tbl_graduate order by UNIX_TIMESTAMP(str_to_date(graddate,'%M %d, %Y')) ASC";
                                                $rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($row = mysqli_fetch_array($rs)) {
                                                ?>
                                                <option value="<?php echo $row['graddate'] ?>"><?php echo $row['graddate']; ?></option>
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
                                                <option disabled selected value="">Admission Year</option>
                                                <?php
                                                //require_once('../Db/connection.php');
												$start_year=2010;
												$start_year2=10;
												$end_year=date('Y');
												$end_year2=date('y');
													
                                                //$sql = "SELECT DISTINCT exam_year FROM tbl_shs_results order by exam_year DESC";
                                                //$rs = mysqli_query($conn, $sql);
                                                if($rs) {
                                                    while($end_year>=$start_year) {
                                                        ?>
                                                <option value="<?php echo $end_year ?>"><?php echo $end_year ?></option>
                                                <?php
													$end_year--;
													$end_year2--;
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
                                                //require_once('../Db/connection.php');
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
                                                //require_once('../Db/connection.php');
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
                                    <div style="text-align: center;"><button id="export_btn" onclick="exportSearch()" class="btn btn-sm btn-danger">Search</button></div>
                        </div>
                    </div>


                    <!-- Upload Waec List-->
                    <div class="card-body" id="uploadBody" style="display:none;">
                        <div class="jumbotron" style="padding: 0px;text-align: center;">
                            <img src="../images/waec.png" width="250px" height="150px"> <b style="font-size: 55px">Upload WAEC Results</b>
                        </div>
						<form id="result_upload_form">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">

                                <!-- Our markup, the important part here! -->
                                <div id="drag-and-drop-zone" class="dm-uploader p-5">
                                    <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                                    <div class="btn btn-primary btn-block mb-5">
                                        <span>Open the file Browser</span>
                                        <input type="file" name="results_file" title='Click to add Files' />
                                    </div>
                                </div><!-- /uploader -->

                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        File List
                                    </div>

                                    <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                                        <li class="text-muted text-center empty">No files uploaded.</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /file list -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        Debug Messages
                                    </div>

                                    <ul class="list-group list-group-flush" id="debug">
                                        <li class="list-group-item text-muted empty">Loading plugin....</li>
                                    </ul>
                                </div>
                            </div>
						</form>
                        </div> <!-- /debug -->
                        <center><button class="btn btn-sm btn-success" data-target="#templateModal" data-toggle="modal">Download Template</button></center>
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
										<th>Remark</th>
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

        <!-- Template Modal-->
        <div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Modal</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- AdmissionNumber IndexNumber ExamMonth   ExamYear    DOB CandName    Subject1    Grade1  Subject2    Grade2  Subject3    Grade3  Subject4    Grade4  Subject5    Grade5  Subject6    Grade6  Subject7    Grade7  Subject8    Grade8  Subject9    Grade9  Subject10   Grade10 Subject11   Grade11 Subject12   Grade12              -->

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="templateTable">
                                <thead>
                                    <th>AdmissionNumber</th>
                                    <th>IndexNumber</th>
                                    <th>ExamMonth</th>
                                    <th>ExamYear</th>
                                    <th>DOB</th>
                                    <th>CandName</th>
                                    <th>Subject1</th>
                                    <th>Grade1</th>
                                    <th>Subject2</th>
                                    <th>Grade2</th>
                                    <th>Subject3</th>
                                    <th>Grade3</th>
                                    <th>Subject4</th>
                                    <th>Grade4</th>
                                    <th>Subject5</th>
                                    <th>Grade5</th>
                                    <th>Subject6</th>
                                    <th>Grade6</th>
                                    <th>Subject7</th>
                                    <th>Grade7</th>
                                    <th>Subject8</th>
                                    <th>Grade8</th>
                                    <th>Subject9</th>
                                    <th>Grade9</th>
                                    <th>Subject10</th>
                                    <th>Grade10</th>
                                    <th>Subject11</th>
                                    <th>Grade11</th>
                                    <th>Subject12</th>
                                    <th>Grade12</th>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>(Leave Empty)</td>
                                        <td>(Leave Empty)</td>
                                        <td>(Leave Empty)</td>
                                        <td>(Leave Empty)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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

        <!-- Graduation Search Modal-->
        <div class="modal fade" id="gradSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-graduate"></i> Graduand Custom Search</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="gradForm">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" name="grad_sid">
                                    <label>Student ID</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" name="grad_name">
                                    <label>Name</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <select name="grad_programme" class="form-control">
                                        <option disabled selected value="">Select Programme</option>
                                        <?php
                                                //require_once('../Db/connection.php');
                                                $sql = "SELECT * FROM programme order by progname";
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

                            <div class="form-group">
                                <div class="form-label-group">
                                    <select name="grad_graddate" class="form-control">
                                        <option disabled selected value="">Graduation Date</option>
                                        <?php
                                                //require_once('../Db/connection.php');
                                                //$sql = "SELECT DISTINCT graddate FROM tbl_graduate";
												$sql = "SELECT DISTINCT graddate FROM tbl_graduate order by UNIX_TIMESTAMP(str_to_date(graddate,'%M %d, %Y')) ASC";
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button id="gradsearchBtn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification Search Modal-->
        <div class="modal fade" id="veriSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Verification Custom Search</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="veriForm">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" name="veri_sid">
                                    <label>Student ID</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" name="veri_name">
                                    <label>Name</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group">
                                    <select name="veri_programme" class="form-control">
                                        <option selected value="">Select Programme</option>
                                        <?php
                                                //require_once('../Db/connection.php');
                                                $sql = "SELECT * FROM programme order by progname";
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
							
                            <div class="form-group" id="form_grp_5">
                                <div class="form-label-group">
                                    <select name="year" id="year" class="form-control">
                                        <option disabled selected value="">Admission Year</option>
                                        <?php
                                        //require_once('../Db/connection.php');
										$start_year=2010;
										$start_year2=10;
										$end_year=date('Y');
										$end_year2=date('y');
											
                                        //$sql = "SELECT DISTINCT exam_year FROM tbl_shs_results order by exam_year DESC";
                                        //$rs = mysqli_query($conn, $sql);
                                        if($rs) {
                                            while($end_year>=$start_year) {
                                                ?>
                                        <option value="<?php echo $end_year ?>"><?php echo $end_year ?></option>
                                        <?php
											$end_year--;
											$end_year2--;
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
                                        //require_once('../Db/connection.php');
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
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button id="verisearchBtn" class="btn btn-primary">Search</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- verify details Modal-->
        <div class="modal fade" id="verify_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Verifcation Details</h3>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="printable" class="table-responsive">
                            <table class="table table-hover table-striped" id="verify_table">
                                <thead>
                                    <tr>
                                        <td rowspan="2">UIN</td>
                                        <td rowspan="2">Student No.</td>
                                        <td rowspan="2">Index No.</td>
                                        <td colspan="3">Candidate Version</td>
                                        <td colspan="3">WAEC Version</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>Subject</td>
                                        <td>Grade</td>
                                        <td>Grade</td>
                                        <td>Subject</td>
                                        <td>Name</td>
										<td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody id="verify_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Ok</button>
                        <button onclick="print_single_verify()" class="btn btn-success btn-sm">Print</button>

                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="../vendor/chart.js/Chart.min.js"></script>
        <script src="../vendor/datatables/jquery.dataTables.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js "></script>
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
        <script src="../js/plugins/uploader-master/uploader-master/dist/js/jquery.dm-uploader.min.js"></script>
        <script src="../js/plugins/uploader-master/uploader-master/demo/demo-config.js"></script>
        <script src="../js/plugins/uploader-master/uploader-master/demo/demo-ui.js"></script>

        <script type="text/html" id="files-template">
            <li class="media">
                <div class="media-body mb-1">
                    <p class="mb-2">
                        <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                    </p>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <hr class="mt-1 mb-1" />
                </div>
            </li>

        </script>

        <!-- Debug item template -->
        <script type="text/html" id="debug-template">
            <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>

        </script>

        <script type="text/javascript">
            $(document).ready(function() {

            keep_open("keep-open,index");
            
                $("#gradTable").DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdf',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7]
                                }
                            }
                        ]
                    });
                    
                    $("#export_gradTable").DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdf',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7]
                                }
                            }
                        ]
                    });

                    $("#templateTable").DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdf',
                                orientation: 'landscape',
                                pageSize: 'LEGAL'
                                
                            },
                            {
                                extend: 'excel',
                                title: ''
                            }
                        ]
                    });
                    
                    // $("#veriTable").DataTable({
                        
                    // });

                    $("#gradList").addClass("activeTab");
                    $("#gradList").click(function() {
                        $("#gradList").addClass("activeTab");
                        $("#veriList").removeClass("activeTab");
                        $("#uploadList").removeClass("activeTab");
                        $("#export").removeClass("activeTab");

                        document.getElementById("gradBody").style.display = 'block';
                        document.getElementById("veriBody").style.display = 'none';
                        document.getElementById("uploadBody").style.display = 'none';
                        document.getElementById("exportBody").style.display = 'none';
                        document.getElementById("exportTable").style.display = 'none';
                        document.getElementById("exportTableVerify").style.display = 'none';
                    });

                    $("#veriList").click(function() {
                        $("#veriList").addClass("activeTab");
                        $("#gradList").removeClass("activeTab");
                        $("#uploadList").removeClass("activeTab");
                        $("#export").removeClass("activeTab");

                        document.getElementById("veriBody").style.display = 'block';
                        document.getElementById("gradBody").style.display = 'none';
                        document.getElementById("uploadBody").style.display = 'none';
                        document.getElementById("exportBody").style.display = 'none';
                        document.getElementById("exportTable").style.display = 'none';
                        document.getElementById("exportTableVerify").style.display = 'none';
                    });

                    $("#uploadList").click(function() {
                        $("#uploadList").addClass("activeTab");
                        $("#veriList").removeClass("activeTab");
                        $("#gradList").removeClass("activeTab");
                        $("#export").removeClass("activeTab");

                        document.getElementById("uploadBody").style.display = 'block';
                        document.getElementById("gradBody").style.display = 'none';
                        document.getElementById("veriBody").style.display = 'none';
                        document.getElementById("exportBody").style.display = 'none';
                        document.getElementById("exportTable").style.display = 'none';
                        document.getElementById("exportTableVerify").style.display = 'none';
                    });

                    $("#export").click(function() {
                        $("#uploadList").removeClass("activeTab");
                        $("#veriList").removeClass("activeTab");
                        $("#gradList").removeClass("activeTab");
                        $("#export").addClass("activeTab");

                        document.getElementById("uploadBody").style.display = 'none';
                        document.getElementById("gradBody").style.display = 'none';
                        document.getElementById("veriBody").style.display = 'none';
                        document.getElementById("exportBody").style.display = 'block';
                        document.getElementById("exportTable").style.display = 'none';
                        document.getElementById("exportTableVerify").style.display = 'none';
                    });
            });


        </script>


</body>

</html>

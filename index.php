<?php 
session_start();
require_once("Db/connection.php");
$tt = "Students Information System | Login";
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $tt ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--PNotify-->
    <link href="vendor/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendor/pnotify/dist/pnotify.buttons.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
      <style type="text/css">
          .bg-color {
              background-color:#092f11 !important;
          }
          #header {
/*              text-shadow: 1px 2px 0.5px;*/
              font-size: 15px;
              font-weight: bold;
          }
          #inputEmail {
              text-align: center;
          }
          #inputPassword {
              text-align: center;
          }
          .mt-5, .my-5 {
    margin-top: 9rem!important;
}
footer.sticky-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    position: absolute;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 50px;
    background-color: rgba(0,0,0,.1);
}
      </style>
  </head>

  <body class="bg-color" onload="<?php session_destroy();?>" style="background-image: linear-gradient(to top, #077721 , #092f11);">

       <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header" style="font-weight: bolder;font-size: 13px"><img src="images/uds.png" width = "70px" height="70px"><span id="header">Students Information System | Login</span></div>
        <div class="card-body">
          <form>
            <div class="form-group">
                <select id="access" name="access" class="form-control" style="text-transform: uppercase;">
                  <option disabled="" selected="">Select Access Level</option>
                  <?php
                  require_once('Db/connection.php');
                  $sql = "Select * from tbl_user_dept order by dept_descr ASC";
                  $rs = mysqli_query($conn, $sql);
                  if($rs) {
                    while($row = mysqli_fetch_assoc($rs)) {
                      ?>
                      <option value="<?php echo $row['dept_id'] ?>"><?php echo $row['dept_descr'] ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
                
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Email address" required="required" autocomplete="off" >
                <label for="inputEmail"><i class="fa fa-user" style="color: green;"></i>&nbsp;&nbsp;Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword"><i class="fas fa-user-secret" style="color: green;"></i>&nbsp;&nbsp;Password</label>
              </div>
            </div>

          </form>
          <button id="submit" class="btn btn-success btn-block">Login</button>
        </div>
      </div>
    </div>

    <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span id=""><img src="images/uds.png" width="30px" height="30px"><a href="http://uds.edu.gh" target="_blank">UDS</a> &copy; 2019</span>
            </div>
          </div>
        </footer>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    

    <script>
      $(document).ready(function(){

      $('#submit').click(function(){ 
          $("#submit").html("<img src='images/ellipse.gif' width='40px' height='40px'>");
      var username = $("#inputEmail").val();
      var pass = $("#inputPassword").val();
      var access = $("#access").val();
 
      if(username == '' || pass == '' || access == '' || access == null){
        new PNotify({
          title:'Error',
          text:'Incomplete Fields',
          type:'error',
          styling:'bootstrap3'
        })
          $("#submit").html("Login");
      }else {

      $.ajax({
        type: 'POST',
        url: 'loginConn.php',        
        data: 'username='+username+'&pass='+pass+'&access='+access,

        success:function(responseText){
          //console.log(responseText);
          if(responseText == 1){
            window.location = "./1753";
            localStorage.setItem("status", "login");

          }else if(responseText == 0){
           new PNotify({
          title:'Access Denied!!!',
          text:'Access, Username or Password Invalid',
          type:'error',
          styling:'bootstrap3'
        })
            $("#submit").html("Login");
          }else if(responseText == 2){
            window.location = './6532';
          }else{
            new PNotify({
          title:'Something Went Wrong!!!',
          text:responseText,
          type:'information',
          styling:'bootstrap3'
        })
              $("#submit").html("Login");
          }
        }
      });
      }

            });

      document.getElementById("inputPassword").addEventListener('keydown', function(e) {
              if(e.keyCode == 13) {
                          $("#submit").html("<img src='images/ellipse.gif' width='40px' height='40px'>");
      var username = $("#inputEmail").val();
      var pass = $("#inputPassword").val();
      var access = $("#access").val();
 
      if(username == '' || pass == '' || access == '' || access == null){
        new PNotify({
          title:'Error',
          text:'Incomplete Fields',
          type:'error',
          styling:'bootstrap3'
        })
          $("#submit").html("Login");
      }else {

      $.ajax({
        type: 'POST',
        url: 'loginConn.php',        
        data: 'username='+username+'&pass='+pass+'&access='+access,

        success:function(responseText){
          //console.log(responseText);
          if(responseText == 1){
            window.location = "./1753";
            localStorage.setItem("status", "login");

          }else if(responseText == 0){
           new PNotify({
          title:'Access Denied!!!',
          text:'Access, Username or Password Invalid',
          type:'error',
          styling:'bootstrap3'
        })
            $("#submit").html("Login");
          }else if(responseText == 2){
            window.location = './6532';
          }else{
            new PNotify({
          title:'Something Went Wrong!!!',
          text:responseText,
          type:'information',
          styling:'bootstrap3'
        })
              $("#submit").html("Login");
          }
        }
      });
      }
              }
            });
    });
    </script>
<!--PNotify-->
    <script src="vendor/pnotify/dist/pnotify.js"></script>
      <script src="./update_function.js"></script>
  </body>

</html>

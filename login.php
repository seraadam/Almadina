<!DOCTYPE html>
<html lang="en">
<?php

session_start();
$loginError = false;

if( isset( $_POST['inputEmail'] ))
{

  $link = mysqli_connect("localhost", "nomowtec_tayba", "");

  if (! $link)
  {
    die("could not connect:".mysqli_error());
  }

  $db_selected = mysqli_select_db($link, "nomowtec_tayba");
  if(! $db_selected)
  {
    echo "we could not find this database";
  }

  $ID = $_POST["inputEmail"];
  $password = $_POST["inputPassword"];


  $sql = "SELECT * FROM admins WHERE adminID = '$ID' AND password = '$password' ";
  //echo $sql;
  $result = mysqli_query($link,$sql);
	if(mysqli_num_rows($result) > 0)
        {
          $row = mysqli_fetch_array($result);
          //if(password_verify($password, $row["Ppassword"]))
          if( $password == $row["password"] )
            {
              $_SESSION['login_user'] = $ID;
              $_SESSION['Username'] = $_POST['adminID'];
              //date_default_timezone_set("Asia/Riyadh");
              //$sql = "UPDATE pr SET ts ='".date("Y-m-d H:i:s")."' where adminID= '".$ID."'";
              //$result = mysqli_query($link, $sql);
              header("Location: index.php");

            }
          else
            {
              echo "Password is not correct";
              $loginError = true;
            }
        }
       else
        {
          echo "ID does not exist";
          $loginError = true;
        }
      }

      if($loginError)
      {

         echo ("<p style=\"color:#e63c19; font-size:17px; font-family:\"Roboto\", sans-serif; padding-top:220px;\">"); echo "Login error"; echo ("</p>");

          mysqli_close($link);
      }

?>
  <head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Taiba Guide Admin Page</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style type="text/css">
    .bg-dark .container .card.card-login.mx-auto.mt-5 .card-header {
	font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana, sans-serif;
}
    </style>
  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">

      <img src="TGL.png" width="392" height="271">
        <div class="card-header" text-align="center">Taiba Guide Administration Page</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Username" required="required" autofocus>
                <label for="Email">username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="Password">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <!-- <a class="btn btn-primary btn-block" href="index.php">Login</a> -->
            <input type="submit" id="submit" name ="submit" class="btn btn-primary btn-block" value="Login">
            <!--<input type="submit" id="submit" name ="submit" class="btn btn-primary btn-block" value="Login">-->
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.html">Register an Account</a>
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>

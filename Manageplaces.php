<!DOCTYPE html>
<html lang="en">

  <head>
<?php
	    session_start();
	  if ( !isset($_SESSION['login_user']) )
		  header("Location: login.php");
	  else
		  echo "Welcome ".$_SESSION['login_user'];

$servername = "localhost";
$username = "nomowtec_tayba";
$password = "12345678910";

// Create connection
//$conn = new mysqli($servername, $username, $password);
$link = mysqli_connect($servername, $username, $password);
 if (! $link)
  {
    die("could not connect:".mysqli_error());
  }

  $db_selected = mysqli_select_db($link, "nomowtec_tayba");
  if(! $db_selected)
  {
    echo "we could not find this database";
  }


?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Places</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

        <script>
				function deleteplace(pid)
			{
				var x = confirm ("Are you sure you want to delete?");

				if (x)
				{
				//var y = confirm ("Are you sure?");
				window.location.replace("deletepage.php?pid="+pid);

				}

				else

					return false;
			}

					  </script>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Taiba Guide</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.php">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>

          </div>
        </li>

         <li class="nav-item active">
          <a class="nav-link" href="Manageplaces.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage places</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Reports</span></a>
        </li>

      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">



          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
             Places' Table</div>
            <div class="card-body">
              <div class="table-responsive">

                <input type="button" onclick="location.href='addplaces.php'" value=" Add New Place " />
                <br><br>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Lat</th>
                      <th>Lang</th>
                      <th>Start</th>
                      <th>End</th>



                  </thead>



                  <tbody>


			<?php

			$sql = "select * from place";
			//$result = $conn->query($sql);
			$result = mysqli_query($link, $sql);



			if(mysqli_num_rows($result) > 0){
    			  // output data of each row
    			  while($row = mysqli_fetch_array($result)) {
        					echo "<tr>";
                      		echo "<td>".$row['Title']."</td>";
                      		echo "<td>".$row['Category']."</td>";
                      		echo "<td>".$row['Description']."</td>";
					  		echo "<td>".$row['lat']."</td>";
                	echo "<td>".$row['lang']."</td>";
                  	echo "<td>".$row['Start']."</td>";
                    	echo "<td>".$row['End']."</td>";

                      		echo "<td> <input type='button' onclick=\"location.href='Editpage.php?pid=".$row['PID']."'\"  value=\" Edit \" /> </td>";
					  		echo "<td> <input onclick=\" deleteplace('".$row['PID']."');\" type=\"button\" name=\"delete\" value=\" Delete \" /> </td>";
                     		echo "</tr>";
    			}
			} else {
    				echo "0 results";
			}


			?>


                  </body>
                </table>

             <script>
        function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("dataTable").deleteRow(i);
                              }
        </script>

              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>



        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Taiba Guide 2019</span>
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
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

</html>

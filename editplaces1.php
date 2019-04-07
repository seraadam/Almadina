
<?php
  session_start();
	  if ( !isset($_SESSION['login_user']) )
		  header("Location: login.php");
	  else
		  echo "Welcome ".$_SESSION['login_user'];


//if(isset($_POST['send']))
{

$host="localhost";
//host name
$username="nomowtec_tayba";
//database username
$word="";
//database word
$db_name="nomowtec_tayba";
//database name
$tbl_name="place";
//table name
$con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");

//connection string



	$pid = $_POST['pid'];
	$category = $_POST['category'];
	$title = $_POST['title'];
	$desc = $_POST['description'];
	$lat = $_POST['lat'];
  $lang = $_POST['lang'];
  $start = $_POST['start'];
  $end = $_POST['end'];

	$sql= "update place set Category='".$category."',Title='".$title."',Description='".$desc."',
  lat='".$lat."',lang='".$lang. "',Start='".$start."',
  End='".$end."' where PID =$pid";
	echo $sql;

$in_ch=mysqli_query($con,$sql);


if($in_ch==1)


{


 echo'<script>alert("POI Updated Successfully")</script>';
	header("Location:Manageplaces.php");


 }


else


 {


 echo'<script>alert("Failed To Insert")</script>';


 }


}


?>

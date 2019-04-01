
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
$username="root";
//database username  
$word="";
//database word  
$db_name="tayba guide";
//database name  
$tbl_name="pois";
//table name  
$con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");

//connection string  

	
	
	
	$category = $_POST['category'];
	$title = $_POST['title'];
	$desc = $_POST['description'];
	$location = $_POST['location'];

	$sql= "insert into pois(Category,Title,Description,Location) values ('".$category."','".$title."','".$desc."','".$location."')";
	echo $sql;
	
$in_ch=mysqli_query($con,$sql);


if($in_ch==1)  
   

{  
     

 echo'<script>alert("POI Added Successfully")</script>';  
 header("Location: manageplaces.php");


 } 

 
else  
  

 {  
     

 echo'<script>alert("Failed To Insert")</script>'; 
header("Location:addplaces1.php");
  

 }  


}  


?> 
 



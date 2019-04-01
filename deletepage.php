
<?php  


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

	
	
	$pid = $_GET['pid'];
	$sql= "delete from pois where PID =$pid";
	echo $sql;
	

$in_ch=mysqli_query($con,$sql);


if($in_ch==1)  
   

{  
     

 echo'<script>alert("POI Deleted Successfully")</script>'; 
	header("Location:Manageplaces.php");
  

 } 

 
else  
  

 {  
     

 echo'<script>alert("Failed To Delete")</script>';  
  

 }  


}  


?> 
 



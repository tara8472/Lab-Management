<?php
session_start();

//Check if someone is trying to access this page without logging in
if ($_SESSION["user_id"] == ""){
	header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teacher Portal</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<style>
table 
{
    border-collapse: collapse;
}

#table1 th, #table1 td, #table1 tr {
  border: 1px solid black;
  border-color: grey;
  line-height: 30px;
}

div.a {
  text-align: center;
} 

</style>


</head>
<body>


<table  style="width:100%">
	<tr>
		<td style="width:1%; vertical-align: top;>
			<a href="http://www.google.com"><img width="120" height="145" src="images/school-logo.png" /> </a>
		</td>

		<td>
    			<div class="wrapper">

			<table style="width: 80%">
			 <caption style="text-align: center; "><h1>Welcome <?php echo $_SESSION["user_name"]; ?></h1></caption>
			
	   		     <tr height=100px style="left-align">	
				<td  >
					<div class="a"><b>Select a function below</b></div>
				</td>	
			
				<td >
					<a href="logout.php" class="btn btn1"></i>Logout</a>
				</td>
			     </tr>
			     <tr height=100px>
				<td>
					<a href="teacher_pending.php" class="btn btn1"></i>Teacher Functions</a>
				</td>
				<td>
					<a href="teacher_student_approve.php" class="btn btn1"></i>Student Functions</a>
				</td>
			     </tr>
			     <tr height=100px>	
				<td>
					<a href="teacher_inventory_display.php" class="btn btn1"></i>Inventory Functions</a>
				</td>
				<td>
					<a href="teacher_user_display.php" class="btn btn1"></i>User Functions</a>
				</td>

			     </tr>

			</table>		

		<BR>
                     
    		</div>
	</td>
   </tr>
</table>
</body>
</html>
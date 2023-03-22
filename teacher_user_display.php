
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
    <title>List of Users</title>
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
</style>


</head>
<body>

<table  style="width:90%">
	<tr>
		<td style="width:1%; vertical-align: top;>
			<a href="http://www.google.com"><img width="120" height="145" src="images/school-logo.png" /> </a>
		</td>

		<td style="left-align">
    			<div class="wrapper">

			<table style="width: 100%">
			     <caption style="text-align: center; "><h1><?php echo $_SESSION["user_name"]; ?> List of Users</h1></caption>
			     <tr>
				<td>
					<a href="teacher_start.php" class="btn btn1"></i>Home</a>
				</td>

				<td>
					<a href="teacher_user_display.php" class="btn btn1"></i>Show Users</a>
				</td>
				<td>
					<a href="teacher_user_create.php" class="btn btn1"></i>New User</a>
				</td>
				<td>
					<a href="logout.php" class="btn btn1"></i> Logout</a>
				</td>

			     </tr>
			</table>		

		<BR>
                   <?php
 
 		    $_SESSION["error_msg"] = "";	
                    require_once "connection.php";
                    if ($_SESSION["error_msg"] <> ""){
		    	echo "<b>Message:</b> " . $_SESSION["error_msg"];
			exit();
		    }	
//                    require_once "connection.php";
                    
                    // Select query execution
		    try{
                    $sql = "SELECT * FROM user order by user_id" ;
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table id = "table1" style="width: 100%;">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>User Id</th>";
                                        echo "<th>User Name</th>";
                                        echo "<th>User Type</th>";
                                        echo "<th>User Batch</th>";
                                        echo "<th>&nbspUpdate&nbsp</th>";
                                        echo "<th>&nbspDelete&nbsp</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr style='text-align: center'>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . $row['user_name'] . "</td>";
					if ($row['user_type'] == 'S'){
	                                        echo "<td> Student </td>";
					}
					else{
                                        	echo "<td> Teacher </td>";
					}
                                        echo "<td>" . $row['user_batch'] . "</td>";


                                        echo "<td>";
	                                echo '<a href="teacher_user_update.php?id='. $row['user_id'] .'">Update</a>';
        	                        echo "</td>";

                                        echo "<td>";
	                                echo '<a href="teacher_user_delete.php?id='. $row['user_id'] .'">Delete</a>';
        	                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div"><em>No records were found.</em></div>';
                        }
                    } else{
			  throw new Exception($result);
//                        echo "Oops! Something went wrong. Please try again later.";
                    }
		    }

		    catch(Exception $e){
		    	echo "<b>Message:</b> " . $e->getMessage();
		    }	
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                    
    		</div>
	</td>
   </tr>
</table>
</body>
</html>
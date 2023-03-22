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
    <title>Pending Items from All Students</title>
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
			     <caption style="text-align: center; "><h1><?php echo $_SESSION["user_name"]; ?> History of All Students and Teacher </h1></caption>
			     <tr>
				<td>
					<a href="teacher_start.php" class="btn btn1"></i>Home</a>
				</td>
				<td>
					<a href="teacher_student_approve.php" class="btn btn1"></i>Approve</a>
				</td>
				<td>
					<a href="teacher_student_pending.php" class="btn btn1"></i> Pending</a>
				</td>
				<td>
					<a href="teacher_student_history.php" class="btn btn1"></i> History</a>
				</td>
				<td>
					<a href="logout.php" class="btn btn1"></i> Logout</a>
				</td>

			     </tr>
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
                    
                    // Attempt select query execution
		    try{
                    $sql = "SELECT * FROM activity where date_ret <> 0 Order by user_name, teacher_appr";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table id = "table1" style="width: 100%;">';
                                echo "<thead>";
                                    echo "<tr>";
					echo "<th>User Name</th>";
                                        echo "<th>Item Id</th>";
                                        echo "<th>Item Name</th>";
                                        echo "<th>Quantity Borrowed</th>";
                                        echo "<th>Date Borrowed</th>";
                                        echo "<th>Date Returned</th>";
                                        echo "<th>Student Info</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                	echo "<tr style='text-align: center'>";
                                       	echo "<td>" . $row['user_name'] . "</td>";
                                       	echo "<td>" . $row['item_id'] . "</td>";
                                      	echo "<td>" . $row['item_name'] . "</td>";
                                        echo "<td>" . $row['qty_borr'] . "</td>";
                                        echo "<td>" . $row['date_borr'] . "</td>";
                                        echo "<td>" . $row['date_ret'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
					if ($row['teacher_appr'] == 1){
						echo "<td> Processing </td>";
					}
					else{
						echo "<td> Approved </td>";
					}
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
//                  	echo "Oops! Something went wrong. Please try again later.";
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
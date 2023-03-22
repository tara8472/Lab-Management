<?php
session_start();

//Check if someone is trying to access this page without logging in
if ($_SESSION["user_id"] == ""){
	header("location:login.php");
}

//https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow Items</title>
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
			     <caption style="text-align: center; "><h1><?php echo $_SESSION["user_name"]; ?> Pending Items </h1></caption>
			     <tr>
				<td>
					<a href="teacher_start.php" class="btn btn1"></i>Home</a>
				</td>
				<td>
					<a href="teacher_pending.php" class="btn btn1"></i>Pending</a>
				</td>
				<td>
					<a href="teacher_history.php" class="btn btn1"></i> History</a>
				</td>
				<td>
					<a href="teacher_borrow.php" class="btn btn1"></i> Borrow</a>
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
                    
                    // Attempt select query execution
		    try{
                    $sql = "SELECT * FROM activity where user_id = '" . $_SESSION["user_id"] . "' and date_ret = 0"; 
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table id = "table1" style="width: 100%;">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Item Id</th>";
                                        echo "<th>Item Name</th>";
                                        echo "<th>Quantity Pending</th>";
                                        echo "<th>Date Borrowed</th>";
                                        echo "<th>Student Info</th>";
                                        echo "<th>Log Return</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr style='text-align: center'>";
                                        echo "<td>" . $row['item_id'] . "</td>";
                                        echo "<td>" . $row['item_name'] . "</td>";
                                        echo "<td>" . $row['qty_borr'] . "</td>";
                                        echo "<td>" . $row['date_borr'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="teacher_return_item.php?id='. $row['item_id'] .'">Return</a>';
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
//                      echo "Oops! Something went wrong. Please try again later.";
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
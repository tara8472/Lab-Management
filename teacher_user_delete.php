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
    <title>Delete User</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<?php
$error_msg="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	
        $_SESSION["error_msg"] = "";	
        require_once "connection.php";

        if ($_SESSION["error_msg"] <> ""){
	    	$error_msg = $_SESSION["error_msg"];
		echo $error_msg;
		exit();
	}	

	try{
		//Check if user has any pending items that he needs to return
		$sql = "SELECT * from activity where user_id = '".$_POST["user_id"] . "' and date_ret = 0";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){			
				$error_msg = "User cannot be deleted as there are pending items to be returned.";
           		     	mysqli_free_result($result);
			} 
		} 
		else{
			throw new Exception($result);
			echo "Oops! Something went wrong. Please try again later.";
		}
	}

	catch(Exception $e){
		$error_msg = $e->getMessage();
	}


	try{
		//Delete user from table
		if ($error_msg == ""){

			$sql = "DELETE from user where user_id = '".$_POST["user_id"]."'";
	
			if ($result = mysqli_query($link, $sql)){
				$error_msg = "";
			}
			else {
				$error_msg = "Delete Not Successful";	
			}

		}
	}


	catch(Exception $e){
		$error_msg = $e->getMessage();
	}


	if ($error_msg == ""){
		// Close connection
		mysqli_close($link);
		header("Location: /labmanagement/teacher_user_display.php");
		exit ();
	}	
}


//$error_msg = "This is a test message to check its position";

// Get the record to be modified
$user_id = $_GET['id'];

$_SESSION["error_msg"] = "";	
require_once "connection.php";
if ($_SESSION["error_msg"] <> ""){
	echo "<b>Message:</b> " . $_SESSION["error_msg"];
	exit();
}	

$sql = "SELECT * FROM user where user_id = '" . $user_id . "'";

if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
                mysqli_free_result($result);
	} 
	else{
		echo '<div"><em>No records were found.</em></div>';
        }
} else{
	echo "Oops! Something went wrong. Please try again later.";
}


// Close connection
mysqli_close($link);

?>


<table  style="width:90%">
	<tr>
		<td style="width:1%; vertical-align: top;>
			<a href="http://www.google.com"><img width="120" height="145" src="images/school-logo.png" /> </a>
		</td>
		<td style="left-align">
			<div class="wrapper">
                    		<h2>Delete User</h2>
                    		<p>Please note that deletion cannot be undone.</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>User Id: <u> <?php echo $row['user_id']; ?> </u></label>
 				<BR><BR>

				<label>User Name: <u> <?php echo $row['user_name']; ?> </u></label>
 				<BR><BR>

				<label>User Type: <u>
 
				<?php 
				if ($row['user_type'] == 'S'){
	                        	echo "Student";
				}
				else{
                                        echo "Teacher";
				}
				?>
				</u></label>
				<BR><BR>


				<label>User Batch <u> <?php echo $row['user_batch']; ?> </u></label>
 				<BR><BR>


				<BR><BR>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Delete User">
						</td>
						<td>
              						<a href="teacher_user_display.php" class="btn btn1">Cancel Delete</a>
						</td>
					</tr>
				</table>
                    		</form>       
	    		</div>
		</td>
	</tr>
</table>
</body>
</html>
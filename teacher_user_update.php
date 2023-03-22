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
    <title>Update User Details</title>
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

	//Check if user batch is less than current year for Students, and 0 for teacher
	if ($_POST["user_type"] == "S") {
		if ($error_msg == ""){
			//Convert string to integer
			$current_year = intval(date("Y"));
			$user_batch = intval($_POST["user_batch"]);
	
			if ($user_batch < $current_year){
				$error_msg = "User Batch cannot be less than current year for Student";
			}
			else{
				$error_msg = "";
			}
		}
	}
	else{
		//Convert string to integer
		$user_batch = intval($_POST["user_batch"]);

		if ($user_batch <> 0){
			$error_msg = "User Batch has to be 0 for a teacher";
		}
		else{
			$error_msg = "";
		}	
	}


	//Update user table.

	try{
		if ($error_msg == ""){
			$sql = "UPDATE user SET user_name = '".$_POST["user_name"]."', user_type = '".$_POST["user_type"]. "', user_pwd = '".$_POST["user_pwd"]. "', user_batch = '". $_POST["user_batch"]. "' where user_id = '".$_POST["user_id"]."'";

			if ($result = mysqli_query($link, $sql)){
				$error_msg = "";
			}
			else {
				$error_msg = "Update Not Successful";	
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
	$error_msg = $_SESSION["error_msg"];
	echo $error_msg;
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
                    		<h2>Update User Details</h2>
                    		<p>Please modify the fields below and submit</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>User ID: <u> <?php echo $row['user_id']; ?> </u></label>
 				<BR><BR>

				<label>User Name:</label><?php echo "<input type='text' name=user_name value='".$row['user_name']."' required>"; ?>
		     	    	<BR>
                            
				<label>User Password:</label><?php echo "<input type='text' name=user_pwd value='".$row['user_pwd']."' required min = '1'>"; ?>
				<BR>

				<label>User Type (S=Student, T=Teacher):</label><?php echo "<input type='text' name=user_type value='".$row['user_type']."' required pattern='[S,T]{1}' >"; ?>
				<BR>

				<label>User Batch:</label><?php echo "<input type='number' name=user_batch value='".$row['user_batch']."' required>"; ?>
				<BR>



				<BR>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Update User">
						</td>
						<td>
              						<a href="teacher_user_display.php" class="btn btn1">Cancel Update</a>
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
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
    <title>Create New User</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<?php
$error_msg="";
$current_year = 0;
$user_batch = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	$_SESSION["error_msg"] = "";	
	require_once "connection.php";
	if ($_SESSION["error_msg"] <> ""){
		echo "<b>Message:</b> " . $_SESSION["error_msg"];
		exit();
	}	

	try{
		//Check if the userid exists. If yes, show error message.
		$user_id = $_POST["user_id"];
		$sql = "SELECT * from user where user_id = '". $user_id . "'";

		if ($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				$error_msg = "User Id already exists. Try another one.";	
			}
			else{
				$error_msg = "";
			}
		}
		else {
			throw new Exception($result);	
			$error_msg = "Unable to check database. Try again.";	
		}
	}

	catch(Exception $e){
		$error_msg = $e->getMessage();
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

	try{
		if ($error_msg == ""){
			//Insert into user table. 
		$sql = "INSERT INTO user(user_id, user_name, user_pwd, user_type, user_batch) VALUES ('". $_POST["user_id"]   . "','". $_POST["user_name"] . "','". $_POST["user_pwd"]     . "','". $_POST["user_type"] . "','". $_POST["user_batch"]    . "')";

			if ($result = mysqli_query($link, $sql)){
				$error_msg = "";
			}
			else {
				throw new Exception($result);
				$error_msg = "Insert Not Successful";	
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

?>


<table  style="width:90%">
	<tr>
		<td style="width:1%; vertical-align: top;>
			<a href="http://www.google.com"><img width="120" height="145" src="images/school-logo.png" /> </a>
		</td>
		<td style="left-align">
			<div class="wrapper">
                    		<h2>Create New User</h2>
                    		<p>Please note that all fields are mandatory</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>User Id: </label>
				<input type='text' name=user_id value='' required>
		     	    	<BR>

				<label>User Name:</label>
				<input type='text' name=user_name value='' required>
		     	    	<BR>
                            
				<label>User Password:</label>
				<input type='text' name=user_pwd value='' required>
				<BR>

				<label>User Type (S=Student, T=Teacher):</label>
				<input type='text' name=user_type value='' required pattern='[S,T]{1}'>
				<BR>

				<label>User Batch: </label>
				<input type='number' name=user_batch value='' required min = 0>

				<BR>

				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Create User">
						</td>
						<td>
              						<a href="teacher_user_display.php" class="btn btn1">Cancel Create</a>
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
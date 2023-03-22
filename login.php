<?php 
	session_start();
?>

<!DOCTYPE HTML>  
<html>
<head>
<title>Lab Management System</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<!-- Insert the logo -->
<img width="120" height="145" src="images/school-logo.png" />

<?php
//define variables and set to default values
$user_id = "UserID";
$user_password = "Password";
$login_successful="0";
$license_key_Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	//Validate userid with database
	require("validateuser.php");

	if ($license_key_Err == ""){						
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_password"] = $user_password;

		//Call the relevant module depending upon the user type		
		if ($_SESSION["user_type"] == "S"){	
			header("Location: /labmanagement/student_pending.php");		
		}
		else {
			header("Location: /labmanagement/teacher_start.php");
		}
		$login_successful = 1;
	    	exit ();
	}
	else {
		$login_successful = 0;
	}
}

//Function to check if userid only contains letters and whitespace
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<?php
	//Show the login page the first time, and at any time when the login fails
	if ($login_successful <> 1) {
?>
	<div class="login">
		<h1>LAB MANAGEMENT SYSTEM</h1>
<?php 
	$user_id = "UserID";
	$user_password = "Password";	
?>
		<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">    	
			<input name="user_id" placeholder=<?php echo $user_id;?> required="required" type="text"> 
			<input name="user_password" placeholder=<?php echo $user_password;?> required="required" type="password"> 
			<!--Error Message is printed here, before the buttons-->
    			<span class="error"><?php echo $license_key_Err;?></span>
       			<button type="submit" class="btn btn1" value="mainlogin">Let me in</button> 
		</form>
	</div>
<?php
	}
?>

</body>
</html>
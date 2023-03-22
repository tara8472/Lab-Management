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
    <title>Return Item</title>
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
		if ($error_msg == ""){
			//Update activity table. Teacher_appr will be set to 0.
			$sql = "UPDATE activity SET teacher_appr = 0 WHERE user_id = '".$_POST["user_id"]."' and item_id = ".$_POST["item_id"] . " and teacher_appr = 1 ";
	
			if ($result = mysqli_query($link, $sql)){
				$error_msg = "";
			}
			else {
				throw new Exception($result);
//				$error_msg = "Update Not Successful";	
			}
		}
	}


	catch(Exception $e){
		$error_msg = $e->getMessage();
	}	


	if ($error_msg == ""){
		// Close connection
		mysqli_close($link);
		header("Location: /labmanagement/teacher_student_approve.php");
		exit ();
	}
}


//$error_msg = "This is a test message to check its position";

// Get the record to be modified
$fetch_parameter = array();
$fetch_parameter = explode("-", $_GET['id']);

$item_id = $fetch_parameter[0];
$user_id = $fetch_parameter[1]; //student id

$_SESSION["error_msg"] = "";	
require_once "connection.php";
if ($_SESSION["error_msg"] <> ""){
	echo "<b>Message:</b> " . $_SESSION["error_msg"];
	exit();
}	


//require_once "connection.php";

$sql = "SELECT * FROM activity where user_id = '" . $user_id . "' and teacher_appr = 1 and item_id = '" . $item_id . "'";

if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
//		echo $row['item_name'];
//		echo "<BR>";
//		echo $row['qty_borr'];
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
                    		<h2>Approve Returned Item</h2>
                    		<p>Please confirm that the item has been returned by the student</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>Student Name:<u> <?php echo $row['user_name']; ?> </u></label>
			    	<BR><BR>

				<label>Item Id:<u> <?php echo $row['item_id']; ?> </u></label>
		     	    	<BR><BR>
                            
				<label>Item Name: <u><?php echo $row['item_name']; ?> </u></label>
				<BR><BR>
		
				<label>Quantity Borrowed: <u><?php echo $row['qty_borr']; ?> </u></label>
				<BR><BR>

				<label>Date Borrowed: <u><?php echo $row['date_borr']; ?> </u></label>
				<BR><BR>

				<label>Date Returned: <u><?php echo $row['date_ret']; ?></u> </label>
				<BR><BR>

				<BR>
				<input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
				<input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"/>	
		
				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Approve Return">
						</td>
						<td>
              						<a href="teacher_student_approve.php" class="btn btn1">Cancel Approval</a>
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
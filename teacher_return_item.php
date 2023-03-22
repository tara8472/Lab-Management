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
	require ("datevalidation.php");
	$date_ret = $_POST["date_ret"];
	
	//echo $date_ret;
	$date_ret = str_replace("T"," ",$date_ret);
	$date_ret = $date_ret . ":00";

        $_SESSION["error_msg"] = "";	
	require_once "connection.php";

        if ($_SESSION["error_msg"] <> ""){
	    	$error_msg = $_SESSION["error_msg"];
		echo $error_msg;
		exit();
	}			

	//Check if the return date is greater than today, or less than a week ago
	if ($error_msg == ""){
		$error_msg = check_date($date_ret);
	}


	//Check if the return date is greater than borrow date
	if ($error_msg == ""){
		$error_msg = compare_ret_borr_dates($date_ret, $_POST["date_borr"]);
	}

	try{
	//Update activity table. teacher_appr will be set to 0 because her return, need not be verified by teacher.
	if ($error_msg == ""){
	$sql = "UPDATE activity SET date_ret='". $date_ret. "', teacher_appr = 0 WHERE user_id = '".$_SESSION["user_id"]."' and item_id = ".$_POST["item_id"] . " and date_ret = '0000-00-00 00:00:00' and date_borr = '" . $_POST["date_borr"] . "'";

		if ($result = mysqli_query($link, $sql)){
			$error_msg = "";
		}
		else {
			throw new Exception($result);
//			$error_msg = "Update Not Successful";	
		}
	}
	}

	catch(Exception $e){
		$error_msg = $e->getMessage();
	}	

	
	try{	
	if ($error_msg == ""){
		// Update quantity in stock in inventory
		// First fetch the record from inventory
		$sql = "SELECT * FROM inventory where item_id = '" . $_POST["item_id"] . "'";

		if($result = mysqli_query($link, $sql)){
        		if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				$item_instock = $row['item_instock'];
        	                mysqli_free_result($result);
           		} else{
                		$error_msg = "No records were found.";
				//echo '<div><em>No records were found.</em></div>';
 	            	}
    		} else{
			throw new Exception($result);
//			$error_msg = "Oops! Something went wrong. Please try again later.";

  	 	}
	}
	}

	catch(Exception $e){
		$error_msg = $e->getMessage();
	}

	
	try{
	if ($error_msg == ""){	
		// Then update stock in inventory
		$item_instock = $item_instock + $_POST["qty_borr"];

		$sql = "UPDATE inventory SET item_instock='". $item_instock. "'WHERE item_id = ".$_POST["item_id"];

		if (mysqli_query($link, $sql)){
			$error_msg = "";
		}
		else {
			throw new Exception($result);
//			$error_msg = "Update Not Successful. Try again.";	
		}
    	}
	}

	catch(Exception $e){
		$error_msg = $e->getMessage();
	}


	
	if ($error_msg == ""){
		// Close connection
		mysqli_close($link);
		header("Location: /labmanagement/teacher_pending.php");
		exit ();
	}
}


//$error_msg = "This is a test message to check its position";

// Get the record to be modified
$item_id = $_GET['id'];

$_SESSION["error_msg"] = "";	
require_once "connection.php";
if ($_SESSION["error_msg"] <> ""){
	echo "<b>Message:</b> " . $_SESSION["error_msg"];
	exit();
}			

//require_once "connection.php";

$sql = "SELECT * FROM activity where user_id = '" . $_SESSION["user_id"] . "' and date_ret='' and item_id = '" . $item_id . "'";

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
                    		<h2>Return Item</h2>
                    		<p>Please enter the return date of the item.</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>Item ID:<u> <?php echo $row['item_id']; ?> </u></label>
			    	<BR><BR>

				<label>Item Name:<u> <?php echo $row['item_name']; ?> </u></label>
		     	    	<BR><BR>
                            
				<label>Quantity: <u><?php echo $row['qty_borr']; ?> </u></label>
				<BR><BR>
		
				<label>Date Borrowed: <u><?php echo $row['date_borr']; ?> </u></label>
				<BR><BR>

				<label>Student Info: <u><?php echo $row['description']; ?></u> </label>
				<BR><BR>

				<label>Date Returned: </label>
 				<input type="datetime-local" step ="1" name="date_ret" required>

				<BR>
				<input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
				<input type="hidden" name="qty_borr" value="<?php echo $row['qty_borr']; ?>"/>	
				<input type="hidden" name="date_borr" value="<?php echo $row['date_borr']; ?>"/>					
				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Submit">
						</td>
						<td>
              						<a href="teacher_pending.php" class="btn btn1">Cancel</a>
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
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
    <title>Create Inventory Item</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<?php
$error_msg="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	$_SESSION["error_msg"] = "";	
	require_once "connection.php";
	if ($_SESSION["error_msg"] <> ""){
		echo "<b>Message:</b> " . $_SESSION["error_msg"];
		exit();
	}	

	//Check if total qty is more than item in stock
	if ($_POST["item_qty"] < $_POST["item_instock"]){
		$error_msg = "Total Quantity cannot be less than Quantity in Stock.";
	}

	try{
	if ($error_msg == ""){
//		require_once "connection.php";
		//Insert new record into inventory

		$sql = "INSERT INTO inventory (item_id, item_name, item_qty, item_instock, item_desc, item_auth) VALUES ('". $_POST["item_id"]   . "','". $_POST["item_name"] . "','". $_POST["item_qty"]     . "','". $_POST["item_instock"] . "','". $_POST["item_desc"]    . "','". $_POST["item_auth"]    . "')";

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

	if ($error_msg == ""){
		// Close connection
		mysqli_close($link);
		header("Location: /labmanagement/teacher_inventory_display.php");
		exit ();
	}

}


//$error_msg = "This is a test message to check its position";

// Get the record to be modified

$_SESSION["error_msg"] = "";	
require_once "connection.php";
if ($_SESSION["error_msg"] <> ""){
	echo "<b>Message:</b> " . $_SESSION["error_msg"];
	exit();
}	


//require_once "connection.php";

$sql = "SELECT Max(item_id) FROM inventory";
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

//echo $row[0];
//exit();
$item_id = $row[0] + 1;

/*
$sql = "SELECT * FROM inventory where item_id = '" . $item_id . "'";

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
*/


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
                    		<h2>Create Inventory Item</h2>
                    		<p>Please note that all fields are mandatory</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>Item ID: <u> <?php echo $item_id; ?> </u></label>
 				<BR><BR>

				<label>Item Name:</label>
				<input type='text' name=item_name value='' required>
		     	    	<BR>
                            
				<label>Total Quantity:</label>
				<input type='number' name=item_qty value='' required min = "1">
				<BR>

				<label>Quantity in Stock:</label>
				<input type='number' name=item_instock value='' required min = "1">
				<BR>

				<label>Item Description:</label>
				<input type='text' name=item_desc value='' required>
				<BR>

				<label>Authorisation Required (0 = No, 1 = Yes):</label>
				<input type='number' name=item_auth value='' required min = "0" max = "1">

				<BR>
				<input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Create Item">
						</td>
						<td>
              						<a href="teacher_inventory_display.php" class="btn btn1">Cancel Create</a>
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
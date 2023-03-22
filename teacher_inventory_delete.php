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
    <title>Delete Inventory Item</title>
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

	//Check if item_instock is equal to item_qty. Only then allow delete. 
	if ($_POST["item_instock"] <> $_POST["item_qty"]){
		$error_msg = "Total quantity must be equal to quantity in stock before deleting the item.";
	}
	
	try{
	if ($error_msg == ""){
		//Delete item from table
	
		$sql = "DELETE from inventory where item_id = '".$_POST["item_id"]."'";

		if ($result = mysqli_query($link, $sql)){
			$error_msg = "";
		}
		else {
			throw new Exception($result);
//			$error_msg = "Delete Not Successful";	
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
$item_id = $_GET['id'];

$_SESSION["error_msg"] = "";	
require_once "connection.php";
if ($_SESSION["error_msg"] <> ""){
	echo "<b>Message:</b> " . $_SESSION["error_msg"];
	exit();
}	

$sql = "SELECT * FROM inventory where item_id = '" . $item_id . "'";

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
                    		<h2>Delete Inventory Item</h2>
                    		<p>Please note that deletion cannot be undone.</p>

				<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

				<label>Item ID: <u> <?php echo $row['item_id']; ?> </u></label>
 				<BR><BR>

				<label>Item Name: <u> <?php echo $row['item_name']; ?> </u></label>
 				<BR><BR>

				<label>Total Quantity: <u> <?php echo $row['item_qty']; ?> </u></label>
 				<BR><BR>
                            
				<label>Quantity in Stock: <u> <?php echo $row['item_instock']; ?> </u></label>
 				<BR><BR>

				<label>Item Descripto: <u> <?php echo $row['item_desc']; ?> </u></label>
 				<BR><BR>

				<label>Authorisation Required (0 = No, 1 = Yes): <u> <?php echo $row['item_auth']; ?> </u></label>

				<BR><BR>
				<input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
				<input type="hidden" name="item_instock" value="<?php echo $row['item_instock']; ?>"/>
				<input type="hidden" name="item_qty" value="<?php echo $row['item_qty']; ?>"/>
				<span class="error"><?php echo $error_msg;?></span>		
				<table>
					<tr>	
						<td>
             						<input type="submit" class="btn btn1" value="Delete Item">
						</td>
						<td>
              						<a href="teacher_inventory_display.php" class="btn btn1">Cancel Delete</a>
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
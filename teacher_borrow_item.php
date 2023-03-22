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
    <title>Borrow Item</title>

    <link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<body>

<?php
$error_msg = "";
$query_result = "";
$item_instock = 0;
$item_already_borrowed = 0;



if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	require ("datevalidation.php");
	$date_borr = $_POST["date_borr"];

	//date_borr has a "T" in it. It needs to be replaced by a space for proper date-time formatting
	$date_borr = str_replace("T"," ",$date_borr);

        $_SESSION["error_msg"] = "";	
	require_once "connection.php";

        if ($_SESSION["error_msg"] <> ""){
	    	$error_msg = $_SESSION["error_msg"];
		echo $error_msg;
		exit();
	}			

//	require_once "connection.php";

	//Check if the borrow date is greater than today, or less than a week ago
	$error_msg = check_date($date_borr);


	//Check if item has already been borrowed
	//This check need not be done for the teacher. She can borrow as many times as she wants for any student.
/*
$sql = "SELECT * FROM activity where user_id = '" . $_SESSION["user_id"] . "' and item_id = " . $_POST["item_id"] . " order by date_borr desc" ;

if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		if($row['qty_borr'] <> 0){
			$error_msg = "Item already borrowed. Return the item before it borrowing again.";
		}
		elseif($row['teacher_appr'] <> 0){
			$error_msg = "Item has been returned but is awating teacher approval. Contact your teacher.";	
		}		
		else{
			$error_msg = "";
		}
	}
}
*/

	//Check if qty borrowed is more than item in stock
	if ($error_msg == ""){
		if ($_POST["qty_borr"] > $_POST["item_instock"]){
			$error_msg = "Quantity borrowed cannot be greater than quantity in stock.";
		}
	}
		
	//If there are no errors, insert a record into the activity table
	try{
	if ($error_msg == ""){
	$sql = "INSERT INTO activity (user_id, user_name, item_id, item_name, date_borr, date_ret, qty_borr, teacher_appr, description) VALUES ('". $_SESSION["user_id"]   . "','". $_SESSION["user_name"] . "','". $_POST["item_id"]      . "','". $_POST["item_name"]    . "','". $_POST["date_borr"]    . "','0000-00-00 00:00:00',". $_POST["qty_borr"] . ",0, '".$_POST["description"] ."')";

		if ($result = mysqli_query($link, $sql)){
			$query_result = "Update Successful";

			// Update quantity in stock in inventory
			$item_instock = $_POST["item_instock"] - $_POST["qty_borr"];
			$sql = "UPDATE inventory SET item_instock='". $item_instock. "'WHERE item_id = ".$_POST["item_id"];
			if ($result = mysqli_query($link, $sql)){
				$error_msg = "";
			}
			else {
				throw new Exception($result);
//				$error_msg = "Update Not Successful. Try again.";	
			}
		}
		else {
			throw new Exception($result);
//			$error_msg = "Update Not Successful. Try again.";
		}    
		// Close connection
		mysqli_close($link);
	}
	}

	catch(Exception $e){
		$error_msg = $e->getMessage();
	}

	if ($error_msg == ""){
		header("Location: /labmanagement/teacher_borrow.php");
		exit ();
	}
}


// Get the record to be modified
$item_id = $_GET['id'];

$_SESSION["error_msg"] = "";	
require_once "connection.php";
if ($_SESSION["error_msg"] <> ""){
	echo "<b>Message:</b> " . $_SESSION["error_msg"];
	exit();
}	


//require_once "connection.php";

$sql = "SELECT * FROM inventory where item_id = '" . $item_id . "'";
	if($result = mysqli_query($link, $sql)){
        	if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result);
			$item_name = $row['item_name'];
			$item_instock = $row['item_instock'];
                        mysqli_free_result($result);
           	} else{
                	echo '<div><em>No records were found.</em></div>';
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
                    <h2>Borrow Item</h2>
                    <p>Please enter details of the item you want to borrow</p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">


                            <label>Item ID: <u><?php echo $row['item_id']; ?></u> </label>
			    <BR><BR>

                            <label>Item Name: <u><?php echo $row['item_name']; ?></u> </label>
		     	    <BR><BR>

                            <label>Item Description: <u><?php echo $row['item_desc']; ?></u> </label>
		     	    <BR><BR>

			    <label>Quantity in Stock: <u><?php echo $row['item_instock']; ?></u> </label>
			    <BR><BR>

                            <label>Quantity Required:  </label>
			    <BR>
                            <input type="number" name="qty_borr" required min="1">

			    <BR>
                            <label>Date Borrowed: </label>
                            <input type="datetime-local" step ="1" name="date_borr" required>
			    
			    <BR>
                            <label>Student info: </label>
                            <input type="text" name="description" required>

			<BR>
			     <input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
			     <input type="hidden" name="item_name" value="<?php echo $item_name; ?>"/>
			     <input type="hidden" name="item_instock" value="<?php echo $item_instock; ?>"/>

<span class="error"><?php echo $error_msg;?></span>
<table>

	<tr>	

		<td>

                        <input type="submit" class="btn btn1" value="Submit">
		</td>
		<td>
                        <a href="teacher_borrow.php" class="btn btn1">Cancel</a>
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
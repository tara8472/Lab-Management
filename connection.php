<?php require("constants.php"); ?>
<?php

try{
        $link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS, DB_NAME);
        if(!$link) {
             die("Database Connnection failed : " .mysql_error());
	     throw new Exception("This is a problem");
        }
}

catch(Exception $e){
	$_SESSION["error_msg"] = $e->getMessage();
	return;
}
	


?>

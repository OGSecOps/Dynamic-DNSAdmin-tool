<?php 
session_start();//check the session creation in the server
$success=array();
$info=array();
$zone_id= $_GET["zone_id"];
$zone_name= $_GET["zone_name"];
if(isset($_SESSION["email_address"]) && $_SESSION["clearance_lvl"] == 1000){//if session is active do the job otherwise if the session has expired it will throw u out the page to the index page 
		
		$con = getConection();
		// Check connection
		if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{
		$row = getDataAdmin($con,$_SESSION["email_address"]);
		$info = array();
		$info[] = "<p><h1>User: ".$row["profile_name"]."</h1></p>";
		$info[] = "<p><h1>Member since: ".$row["date_started"]."</h1></p>";
}

}else{
header("Location: index.php");//if session has expired redirec you to the home page
	}	
?>


<?php 
$errors = array();
$success = array();
if(isset($_POST["email_address"])!=0){
	$date = date("Y-d-m");
	$required = array("email_address","password");
	foreach($required as $required_fieldname){
		if(!isset($_POST[$required_fieldname]) || empty($_POST[$required_fieldname])){
			$errors[] = "<p><h1>Error! the ".$required_fieldname." field must be entered.</h1></p>";}
			} 
		if(!preg_match("/\w+@[a-zA-Z0-9_]+?\.[a-zA-Z0-9]{2,6}/" , $_POST["email_address"])){
			$errors[] = "<p><h1>It must be a valid email address</h1></p>";
		}		
		if(!preg_match("/[A-Za-z0-9-]+/" , $_POST["password"])){
			$errors[] = "<p><h1>the password should have only numbers and letters</h1></p>";
		}
	$con = getConection();
	// Check connection
	if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{
	$row = getLoginIncludes($con,$_POST["email_address"],$_POST["password"]);
	if(count($row) == 0){
		$errors[] = "<p><h1>Check User name or Password</h1></p>";}											}
		
		if(count($errors) == 0){
			   //session
			   session_set_cookie_params(3600);//time to live for the session
			   session_start();
			   $hostname = gethostname();
			   $os = PHP_OS;
			   $level = $row["clearance_lvl"];
			   $browser = $_SERVER['HTTP_USER_AGENT'];
			   $success[] = "<p><h1>Welcome ".$row["profile_name"]." start manage your <a href=\"zonelist.php\">zones</a> now</h1></p>
							 <p>&nbsp;</p>
							 <p>&nbsp;</p>
							 <p>&nbsp;</p>
							 <p><h1>Hostname:</h1></p>
							 <p>".$hostname." (".$_SERVER['REMOTE_ADDR'].")</p>
							 <p><h1>System:</h1></p>
							 <p>".$os."</p>
							 <p><h1>Browser:</h1></p>
							 <p>".$browser."</p>";
			   $_SESSION["email_address"] = $_POST["email_address"];
			   $_SESSION["profile_name"] = $row["profile_name"];
			   $_SESSION["clearance_lvl"] = $row["clearance_lvl"];
		}
}	
?>

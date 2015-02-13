<?php 
$errors = array();
$success = array();
$clear = 0;
$date = date("Y-m-d");
if(isset($_POST["email_address"])!=0){
$required = array("email_address","profile_name","password","cpassword");
foreach($required as $required_fieldname){
	if(!isset($_POST[$required_fieldname]) || empty($_POST[$required_fieldname])){
		$errors[] = "<p><h1>Error! the ".$required_fieldname." field must be entered.</h1></p>";}
		} 
if(!preg_match("/\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6}/" , $_POST["email_address"])){
	$errors[] = "<p><h1>It must be a valid email address</h1></p>";
	}		
if(!preg_match("/[A-Za-z]+/" , $_POST["profile_name"])){
	$errors[] = "<p><h1>Your profile name should have only letters</h1></p>";
	}
if(!preg_match("/[A-Za-z0-9-]+/" , $_POST["password"])){
	$errors[] = "<p><h1>the password should have only numbers and letters</h1></p>";
	}
if($_POST["password"] != $_POST["cpassword"]){
	$errors[] = "<p><h1>the password and confirm password are not the same</h1></p>";
	}
$con = getConection();
// Check connection
if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{
$result = mysqli_query($con, "SELECT * FROM `dnsadmin_user` WHERE `user_email` = '".$_POST["email_address"]."'");
$row = mysqli_fetch_array($result);
if(count($row) != 0){
	$errors[] = "<p><h1>This user is member already</h1></p>";
	session_start();
	$sid = session_id();
	if($sid){$clear = 1;}
		}											
	}
	
if(count($errors) == 0){
	//insert
	mysqli_query($con,"INSERT INTO dnsadmin_user (user_email,password,profile_name,date_started,clearance_lvl)
		   VALUES 
		   ('".$_POST["email_address"]."','".$_POST["password"]."','".$_POST["profile_name"]."','".$date."',0000)");
		   $success[] = "<p><h1>Congratulations!!! successful registration, start manage your <a href=\"zonesadd.php\">zones</a> now</h1></p>";
		   session_set_cookie_params(3600);//time to live for the session
		   session_start();
		   $_SESSION["email_address"] = $_POST["email_address"];
		   $_SESSION["profile_name"] = $_POST["profile_name"];
		   $clear = 1;
	}
}	
?>

<?php 
session_start();
if(isset($_SESSION["email_address"])){
	$errors = array();
	$success = array();
	$con = getConection();
	$row = getEditUserIncludes($con,$_SESSION["email_address"]);
	if(isset($_POST["edit_user"])){
		$date = date("Y-m-d");
		$required = array("email_address","profile_name","password","cpassword");
		/*cheking for fields*/
		foreach($required as $required_fieldname){
			if(!isset($_POST[$required_fieldname]) || empty($_POST[$required_fieldname])){
				$errors[] = "<p><h1>Error! the ".$required_fieldname." field must be entered.</h1></p>";}
				} 
			if(!preg_match("/\w+@[a-zA-Z0-9_]+?\.[a-zA-Z0-9]{2,6}/" , $_POST["email_address"])){
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
		/*cheking for fields*/
			
		if(count($errors) == 0){
			//no errors then update
				   setUserUpdateIncludes($con,$_POST["email_address"],$_POST["password"],$_POST["profile_name"],$row["user_id"]);
				   $success[] = "<p><h1>User details updated</h1></p>";
				   session_set_cookie_params(3600);//time to live for the session
				   session_start();
				   $_SESSION["email_address"] = $_POST["email_address"];
				   $_SESSION["profile_name"] = $_POST["profile_name"];
				   $_SESSION["clearance_lvl"] = $row["clearance_lvl"];
				   $row = getEditUserIncludes($con,$_SESSION["email_address"]);
			}
		}
}else{
header("Location: index.php");}	
?>

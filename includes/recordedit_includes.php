<?php 
session_start();//check the session creation in the server
$success=array();
$info=array();
if(isset($_SESSION["email_address"])){//if session is active do the job otherwise if the session has expired it will throw u out the page to the index page 
	$record_id= $_GET["edit"];
	$zone_id= $_GET["zone_id"];
	$zone_name= $_GET["zone_name"];
	$con = getConection();
	// Check connection
	if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{					
				$row = getRecordRemoveIncludes($con,$record_id);
	if(isset($_POST["submit_edit"])){
				$record_id= $_POST["record_id"];
				$zone_id= $_POST["zone_id"];
				$zone_name= $_POST["zone_name"];
				$record_name= $_POST["record_name"];
				$record_ip8= $_POST["record_ip8"];
				$record_ip16= $_POST["record_ip16"];
				$record_ip32= $_POST["record_ip32"];
				$record_ip64= $_POST["record_ip64"];
				$record_ip = $record_ip8.".".$record_ip16.".".$record_ip32.".".$record_ip64;
				$required = array("record_name","record_ip8","record_ip16","record_ip32","record_ip64");
			foreach($required as $required_fieldname){
				if(!isset($_POST[$required_fieldname]) || empty($_POST[$required_fieldname])){
					$errors[] = "<p><h1>Error! the ".$required_fieldname." field must be entered.</h1></p>";}
					} 
			
					if(!preg_match("/[0-9-]+/" , $_POST["record_ip8"])){
						$errors[] = "<p><h1>first octep should have only numbers</h1></p>";
						}
					if(!preg_match("/[0-9-]+/" , $_POST["record_ip16"])){
						$errors[] = "<p><h1>second octep should have only numbers</h1></p>";
						}
					if(!preg_match("/[0-9-]+/" , $_POST["record_ip32"])){
						$errors[] = "<p><h1>third octep should have only numbers</h1></p>";
						}
					if(!preg_match("/[0-9-]+/" , $_POST["record_ip64"])){
						$errors[] = "<p><h1>fourth octep should have only numbers</h1></p>";
						}
		
					if(count($errors) == 0){
					$option = "EDIT";	
					//calling my nsupdate function
					$oldHost = $_POST["oldHost"];
					$status = nsupdate($zone_name,$record_name,$record_ip,$oldHost,$option);
					//insert, if the ddns update failed (!=0), the data will not be inserted on the database
					if ($status == 0){
						setRecordUpdate($con,$record_name,$record_ip,$record_id);
						$success[] = "<p><h1>Host: ".$record_name.".".$zone_name." (".$record_ip.") details updated</h1></p>";
						$success[] = "<p><h1>PLEASE BE AWARE THAT CHANGES WILL HAVE EFFECT ON THE ZONE FILE AFTER 15 TO 20 MIN</h1></p>";
						$clear = 1;
					}else{
					    $errors[] = "<p><h1>DDNS update failed check your DNS configuration</h1></p>";
							}
					}
			$row = getRecordRemoveIncludes($con,$record_id);
			}
	}
}else{
header("Location: index.php");//if session has expired redirec you to the home page
	}	
?>

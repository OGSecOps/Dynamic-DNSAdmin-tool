<?php 
session_start();//check the session creation in the server
$errors = array();
$success = array();
$info=array();
$zone_id= $_GET["zone_id"];
$zone_name= $_GET["zone_name"];
if(isset($_SESSION["email_address"])){//if session is active do the job otherwise if the session has expired it will throw u out the page to the index page 
	$con = getConection();
	// Check connection
	if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{
	$rowF = getUserRecordIncludes($con,$_SESSION["email_address"]);
	$adjacents = 3;
	$total_pages = getCountRecordIncludes($con,$zone_id);
	$url = "record.php?zone_id=".$zone_id."&zone_name=".$zone_name."&"; 	//url for the paginator target
	$limit = 5;
	$page = 0;
	if(isset($_GET["page"])){$page = $_GET["page"];}
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;//default status
	$num_of_host = $total_pages;
	$result = getRecordZoneIncludesList($con,$_GET["zone_id"],$start,$limit);
	$row = mysqli_fetch_array($result);	
	if($_SESSION["clearance_lvl"] == 1000){
		$rowAdmin = getDataAdmin($con,$_SESSION["email_address"]);
		$info[] = "<p><h1>User: ".$rowAdmin["profile_name"]."</h1></p>";
		$info[] = "<p><h1>Member since: ".$rowAdmin["date_started"]."</h1></p>";
		}else{									
		$info[] = "<p><h1>User: ".$rowF["profile_name"]."</h1></p>";
		$info[] = "<p><h1>Member since: ".$rowF["date_started"]."</h1></p>";
		}
	}


	if(isset($_GET["remove"])){
	$record_id = $_GET["remove"];
	/*dns deleted and sql*/
	$rowDelete = getRecordRemoveIncludes($con,$record_id);
	$zone_id = $rowDelete["zone_id"];
	$zone_name = $rowDelete["zone_name"];
	$record_name = $rowDelete["record_name"];
	$record_ip = $rowDelete["record_ip"];
	$option = "DELETE";
	$oldHost = " ";
	//calling my nsupdate function
	$status = nsupdate($zone_name,$record_name,$record_ip,$oldHost,$option);
				if ($status == 0){
					setRecordDelete($con,$record_id);//delete from db
					$success[] = "<p><h1>Host: ".$record_name.".".$zone_name." (".$record_ip.") removed from zone</h1></p>";
					$success[] = "<p><h1>PLEASE BE AWARE THAT CHANGES WILL HAVE EFFECT ON THE ZONE FILE AFTER 15 TO 20 MIN</h1></p>";
					$clear = 1;
				}else{
					$errors[] = "<p><h1>DDNS update failed removing this record</h1></p>";
						}
	$adjacents = 3;
	$total_pages = getCountRecordIncludes($con,$zone_id);
	$url = "record.php?zone_id=".$zone_id."&zone_name=".$zone_name."&"; 	//url for the paginator target
	$limit = 5;
	$page = 0;
	if(isset($_GET["page"])){$page = $_GET["page"];}
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;//default status
	$num_of_host = $total_pages;
	$result = getRecordZoneIncludesList($con,$zone_id,$start,$limit);
	$row = mysqli_fetch_array($result);
	}

}else{
header("Location: index.php");//if session has expired redirec you to the home page
	}	
?>


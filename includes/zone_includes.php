<?php 
session_start();

if(isset($_SESSION["email_address"])){
	
	$con = getConection();

	if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{
		$adjacents = 3;
		$total_pages = getCountZoneIncludes($con,$_SESSION["email_address"],$_SESSION["clearance_lvl"]);
		$url = "zonelist.php?"; 	//url for the paginator target
		$limit = 5;//how many zones to show per page
		$page = 0;
		if(isset($_GET["page"])){$page = $_GET["page"];}
			if($page) 
				$start = ($page - 1) * $limit; //first item to display on this page
			else
				$start = 0;//default status
		$result = getUserZoneIncludesList($con,$_SESSION["email_address"],$_SESSION["clearance_lvl"],$start,$limit);
		$row = mysqli_fetch_assoc($result);//for records
		$num_of_zones = $total_pages;									
		$info = array();
		if($_SESSION["clearance_lvl"] == 1000){
		$rowAdmin = getDataAdmin($con,$_SESSION["email_address"]);
		$info[] = "<p><h1>User: ".$rowAdmin["profile_name"]."</h1></p>";
		$info[] = "<p><h1>Member since: ".$rowAdmin["date_started"]."</h1></p>";
		$info[] = "<p><h1>Supervised zones: ".$total_pages."</h1></p>";
		}else{
		$info[] = "<p><h1>User: ".$row["profile_name"]."</h1></p>";
		$info[] = "<p><h1>Member since: ".$row["date_started"]."</h1></p>";
		$info[] = "<p><h1>Supervised zones: ".$total_pages."</h1></p>";
		}
	}

if(isset($_GET["stop"])){
						
		if (mysqli_connect_error($con)){echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";}else{
		$adjacents = 3;
		$total_pages = getCountZoneIncludes($con,$_SESSION["email_address"],$_SESSION["clearance_lvl"]);
		$url = "friendlist.php?"; 	//url for the paginator target
		$limit = 5;//how many zones to show per page
		if(isset($_GET["page"])){$page = $_GET["page"];}
			if($page) 
				$start = ($page - 1) * $limit; 			//first item to display on this page
			else
				$start = 0;//default status
		$result = getUserZoneIncludesList($con,$_SESSION["email_address"],$_SESSION["clearance_lvl"],$start,$limit);
		$row = mysqli_fetch_assoc($result);
		$num_of_zones = $total_pages;	}
	}
	
}else{
header("Location: index.php");}	
?>

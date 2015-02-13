<?php
function getConection(){
	$conObject = mysqli_connect("localhost","YOURUSER","YOURPASSWD","dnsAdmin_db");//create the object connection to return
	return $conObject;
	}
function getDataAdmin($con,$email_address){
	$result = mysqli_query($con, "SELECT * FROM  dnsadmin_user U WHERE U.user_email = '".$email_address."'");//getting data  of the user logged
	$row = mysqli_fetch_array($result);
	return $row; 
	}
function getCountZoneIncludes($con,$email_address,$clearance_lvl){
	if($clearance_lvl == 1000){
			$result = mysqli_query($con,"SELECT count(*) FROM  my_zones ");
			$total_pages = mysqli_fetch_array($result);//result of the count(*) to determine the number of records
			$total_pages = $total_pages[0];
			return $total_pages;
				
			}else{
				
			$result = mysqli_query($con,"SELECT count(*) FROM  dnsadmin_user U INNER JOIN my_zones Z ON U.user_id = Z.user_id 
			WHERE U.user_email = '".$email_address."'");
			$total_pages = mysqli_fetch_array($result);//result of the count(*) to determine the number of records
			$total_pages = $total_pages[0];
			return $total_pages;		
			}
	}
function getUserZoneIncludesList($con,$email_address,$clearance_lvl,$start,$limit){
	if($clearance_lvl == 1000){
	$result = mysqli_query($con, "SELECT * FROM my_zones LIMIT ".$start.", ".$limit."");//query with the start and the end of the data per page
	return $result;
	}else{
	$result = mysqli_query($con, "SELECT * FROM dnsadmin_user U INNER JOIN my_zones Z ON U.user_id = Z.user_id 
	WHERE U.user_email = '".$email_address."' LIMIT ".$start.", ".$limit."");//query with the start and the end of the data per page
	return $result;}
	}
function getLoginIncludes($con,$email_address,$password){
	$result = mysqli_query($con, "SELECT * FROM `dnsadmin_user` 
	WHERE `user_email` = '".$email_address."' AND `password` = '".$password."'");
	$row = mysqli_fetch_array($result);
	return $row;
	}
function getEditUserIncludes($con,$email_address){
	$result = mysqli_query($con, "SELECT * FROM `dnsadmin_user` 
	WHERE `user_email` = '".$email_address."'");
	$row = mysqli_fetch_array($result);
	return $row;
	}
function setUserUpdateIncludes($con,$email_address,$password,$profile_name,$user_id){
	mysqli_query($con,"UPDATE dnsadmin_user 
	SET user_email = '".$email_address."' , password = '".$password."', profile_name = '".$profile_name."' 
	WHERE user_id = ".$user_id);
	}
function getUserRecordIncludes($con,$email_address){
	$result = mysqli_query($con, "SELECT * FROM  dnsadmin_user U INNER JOIN my_zones Z ON U.user_id = Z.user_id 
	WHERE U.user_email = '".$email_address."'");//getting data  of the user logged
	$row = mysqli_fetch_array($result);
	return $row;
	}
function getCountRecordIncludes($con,$zone_id){
	$result = mysqli_query($con, "SELECT count(*) FROM zone_records
									WHERE zone_id = ".$zone_id);
	$total_pages = mysqli_fetch_array($result);//result of the count(*) to determine the number of records
	$total_pages = $total_pages[0];//total of pages to set the limit of the query	
	return $total_pages;
	}
function getRecordZoneIncludesList($con,$zone_id,$start,$limit){
	$result = mysqli_query($con, "SELECT * FROM zone_records
									WHERE zone_id = ".$zone_id." LIMIT ".$start.", ".$limit."");
	return $result;
	}
function getRecordRemoveIncludes($con,$record_id){
	$result = mysqli_query($con, "SELECT * FROM zone_records R INNER JOIN my_zones Z ON R.zone_id = Z.zone_id 
	WHERE R.record_id = ".$record_id);
	$row = mysqli_fetch_array($result);
	return $row;
	}
function setRecordDelete($con,$record_id){
	mysqli_query($con,"DELETE FROM zone_records WHERE record_id = ".$record_id);
	}
function createRecordID($con){
	$result = mysqli_query($con, "SELECT count(*) FROM zone_records");
	$total_zones = mysqli_fetch_array($result);//result of the count(*) to determine the number of records
	$num = $total_zones[0];
	$record_id = $num + 1;
	return $record_id;
	}
function setRecordInsert($con,$record_id,$zone_id,$record_name,$record_ip){
	mysqli_query($con,"INSERT INTO zone_records (record_id,zone_id,record_name,record_ip)
					   VALUES 
					   ('".$record_id."','".$zone_id."','".$record_name."','".$record_ip."')");
	}
function setRecordUpdate($con,$record_name,$record_ip,$record_id){
	mysqli_query($con,"UPDATE zone_records
	SET record_name = '".$record_name."' , record_ip = '".$record_ip."'
	WHERE record_id = ".$record_id);
	}
function nsupdate($zone,$Host,$ip,$hostDelete,$option){
$reverse_ip = explode(".",$ip);
$lastnumber = $reverse_ip[3];
// open log session in case of error for the ddns update (you can check the logs in var/logs/http-*)
openlog("DDNS-dnsAdmin", LOG_PID | LOG_PERROR, LOG_LOCAL0);
if($option == "ADD"){
$add = $Host.".".$zone;
$add = escapeshellcmd($add);
$ip = escapeshellcmd($ip);
//CHANGE SCOPE FOR ARPA RESOLUTION
$stream = "<<EOF
update add $add 86400 A $ip
send
update add $lastnumber.0.0.0.in-addr.arpa 7200 PTR $add
send
quit
EOF";
}
if($option == "DELETE"){
$delete = $Host.".".$zone;
$delete = escapeshellcmd($delete);
$stream = "<<EOF
update delete $delete A
send
update delete $Host.0.0.0.in-addr.arpa PTR
send
quit
EOF";
}
if($option == "EDIT"){
$delete = $hostDelete.".".$zone;
$delete = escapeshellcmd($delete);
$add = $Host.".".$zone;
$add = escapeshellcmd($add);
$ip = escapeshellcmd($ip);
$stream = "<<EOF
update delete $delete A
send
update delete $hostDelete.0.0.0.in-addr.arpa PTR
send
update add $add 86400 A $ip
send
update add $lastnumber.0.0.0.in-addr.arpa 3600 PTR $add
send
quit
EOF";
}
// run DNS update command in background (-v for TCP comm and -k to specify the key file) CHANGE DIRECTORY FOR NSUPDATE PROGRAM
//REMENBER TO GENERATED THE KEY FIRST
exec("/usr/local/bin/nsupdate -v -k /usr/local/etc/namedb/dynamic/Kddns-key.+157+21187.private $stream", $output, $return);
if ($return != 0){syslog(LOG_INFO, "Adding DNS record failed");}
return $return;
}
function Read($file){
                $f=$file;
				echo file_get_contents( $f);
               }

function Write($f,$d){
                   $file = $f;
                   $fp = fopen($file, "w");
                   $data = $d;
                   fwrite($fp, $data);
                   fclose($fp);
               }
               					
function getPaginator($adjacents,$total_pages,$url,$limit,$page,$start){
					/* vars for the pagination logic. */
					if ($page == 0) $page = 1;					//if no page var is given, default to 1.
					$prev = $page - 1;							//previous page is page - 1
					$next = $page + 1;							//next page is page + 1
					$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
					$lpm1 = $lastpage - 1;						//last page minus 1	
						/* 
							creating the rules of pagination and the html output.
						*/
					$pagination = "";
					if($lastpage > 1)
					{  
						$pagination .= "<ul class='pagination'>";
								$pagination .= "<li class='details'>Page $page of $lastpage</li>";
						if ($lastpage < 7 + ($adjacents * 2))
						{  
							for ($counter = 1; $counter <= $lastpage; $counter++)
							{
								if ($counter == $page)
									$pagination.= "<li><a class='current'>$counter</a></li>";
								else
									$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";                   
							}
						}
						elseif($lastpage > 5 + ($adjacents * 2))
						{
							if($page < 1 + ($adjacents * 2))    
							{
								for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
								{
									if ($counter == $page)
										$pagination.= "<li><a class='current'>$counter</a></li>";
									else
										$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";                   
								}
								$pagination.= "<li class='dot'>...</li>";
								$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
								$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";     
							}
							elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
							{
								$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
								$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
								$pagination.= "<li class='dot'>...</li>";
								for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
								{
									if ($counter == $page)
										$pagination.= "<li><a class='current'>$counter</a></li>";
									else
										$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";                   
								}
								$pagination.= "<li class='dot'>..</li>";
								$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
								$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";     
							}
							else
							{
								$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
								$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
								$pagination.= "<li class='dot'>..</li>";
								for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
								{
									if ($counter == $page)
										$pagination.= "<li><a class='current'>$counter</a></li>";
									else
										$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";                   
								}
							}
						}
						 
						if ($page < $counter - 1){
							$pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
							$pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
						}else{
							$pagination.= "<li><a class='current'>Next</a></li>";
							$pagination.= "<li><a class='current'>Last</a></li>";
						}
						$pagination.= "</ul>\n";     
					}
					return $pagination;
	}
?>

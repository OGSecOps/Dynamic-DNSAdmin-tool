<?php      $con = getConection();
			// Check connection
			if (mysqli_connect_error($con))
			  {
			  echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error()."</h1>";
			  }else{

			// Perform queries
		   mysqli_query($con, "CREATE TABLE IF NOT EXISTS `dnsadmin_user` (
		   `user_id` int(4) NOT NULL auto_increment,
		   `user_email` varchar(50) NOT NULL,
		   `password` varchar(20) NOT NULL,
		   `profile_name` varchar(30) NOT NULL,
		   `date_started` date NOT NULL,
		   `clearance_lvl` int(10) unsigned,
		   PRIMARY KEY  (`user_id`)
		   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
		  mysqli_query($con, "CREATE TABLE IF NOT EXISTS `my_zones` (
		   `user_id` int(4) NOT NULL,
		   `zone_id` int(4) NOT NULL,
		   `zone_name` varchar(30) NOT NULL,
		   `zone_type` varchar(30) NOT NULL,
		   PRIMARY KEY (`user_id` , `zone_id`)
		   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
		   if(mysqli_query($con, "CREATE TABLE IF NOT EXISTS `zone_records` (
		   `record_id` int(4) NOT NULL,
		   `zone_id` int(4) NOT NULL,
		   `record_name` varchar(30) NOT NULL,
		   `record_ip` varchar(30) NOT NULL,
		   PRIMARY KEY (`record_id` , `zone_id`)
		   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8") == 0 ) {echo "<h1>Tables successfully created.</h1>";}   
		   mysqli_close($con);
			}
?>

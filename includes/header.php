<div id="heading">
		<!--logo-->
		<div class="logo">
			<img src="images/logo.png" alt="logo"/>
		</div>
		<!--End logo-->
				<!-- Navigation -->
				<div id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<?php if(isset($_SESSION["email_address"])){ 
							if($_SESSION["clearance_lvl"] == 1000){
							?>
						<li><a href="serveradmin.php">BIND DNS Server</a></li>
						<!-- <li><a href="create_user.php">Create User</a></li> -->
						<?php }?>
						<li><a href="zonelist.php">My DNS Zones</a></li>
						<li><a href="edit_user.php">My Account</a></li>
						<li><a href="logout.php">Log out</a></li>
						<?php }else{?>
						<li><a href="login.php">Log in</a></li>
						<?php }?>
						<li><a href="about.php">About</a></li>
					</ul>
				</div>
				<!-- End Navigation -->
</div>

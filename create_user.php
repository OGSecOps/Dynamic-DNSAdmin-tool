<?php include "functions/functions.php";?>
<?php include "includes/create_user_includes.php";?>
<?php include "includes/metas.php";?>
<!-- Start of the body -->
<body>
	<div id="container">
<!-- Heading -->
	<?php include "includes/header.php";?>
<!-- End Heading -->	
	<!-- Information -->
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
			<?php
			if(count($errors) != 0){ 
			foreach($errors as $error){
			echo $error;//print fields need it
					} 
				}
				foreach($success as $succ){
			     echo $succ;//print succes queries
					}
			?>
		</div>
	</div>
	<!-- End Information -->
	<hr />
	<div id="inner_pages_container">
	<!-- Vote information -->
	<?php if($clear != 1){ ?>
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
				<form id="sign_up" class="form_box" action="create_user.php" method="post">
					<fieldset>
					 <legend>Sign up</legend>
					  <label>Email address:</label><input id="email_address" name="email_address" type="text" value="<?php if(isset($_POST["email_address"])){echo $_POST["email_address"];}?>"/>
					   <label>Profile Name:</label><input id="profile_name" name="profile_name" type="text" value="<?php if(isset($_POST["profile_name"])){echo $_POST["profile_name"];}?>"/>
					    <label>Password:</label><input id="password" name="password" type="password"/>
					     <label>Confirm Pass:</label><input id="cpassword" name="cpassword" type="password"/>
					     <input id="date" name="date" type="hidden" value="<?php echo $date;?>"/>
						  <label></label><input name="submit" type="submit" value="Sign up" />
					</fieldset>
				</form><br />
		</div>
	</div>
	<?php } ?>
	<!-- End Vote information -->
	</div>
	<!-- Footer -->
	<?php include "includes/footer.php";
	mysqli_free_result($result);
	mysqli_close($con);
	?>
</body>
</html>

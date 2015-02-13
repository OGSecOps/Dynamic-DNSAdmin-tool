<?php include "functions/functions.php";?>
<?php include "includes/edit_user_includes.php";?>
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
	<!-- user information -->
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
				<form id="sign_up" class="form_box" action="edit_user.php" method="post">
					<fieldset>
					 <legend>Edit Account</legend>
					  <label>Email address:</label><input id="email_address" name="email_address" type="text" value="<?php echo $row["user_email"];?>"/>
					   <label>Profile Name:</label><input id="profile_name" name="profile_name" type="text" value="<?php echo $row["profile_name"];?>"/>
					    <label>Password:</label><input id="password" name="password" type="password" value="<?php echo $row["password"];?>"/>
					     <label>Confirm Pass:</label><input id="cpassword" name="cpassword" type="password" value="<?php echo $row["password"];?>"/>
						  <label></label><input name="edit_user" type="submit" value="Update details" />
					</fieldset>
				</form><br />
		</div>
	</div>
	<!-- End user information -->
	</div>
	<!-- Footer -->
	<?php include "includes/footer.php";
	mysqli_free_result($result);
	mysqli_close($con);
	?>
</body>
</html>


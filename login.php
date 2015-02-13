<?php include "functions/functions.php";?>
<?php include "includes/login_includes.php";?>
<?php include "includes/metas.php"; ?>
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
			if (is_array($success))
				{
				foreach($success as $succ){
			     echo $succ;//print succes queries
					}
				}
			?>
		</div>
	</div>
	<!-- End Information -->
	<hr />
	<div id="inner_pages_container">
	<!-- Vote information -->
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
			<?php if(isset($_SESSION["email_address"])){ }else{?>
				<form id="login" class="form_box" action="login.php" method="post">
					<fieldset>
					 <legend>Log in</legend>
					  <label>Email address:</label><input id="email_address" name="email_address" type="text" value="<?php if(isset($_POST["email_address"])){echo $_POST["email_address"];}?>"/>
					    <label>Password:</label><input id="password" name="password" type="password"/>
					     <input id="date" name="date" type="hidden" value="<?php echo $date;?>"/>
						  <label></label><input name="submit" type="submit" value="Log in" />
					</fieldset>
				</form><br />
				<?php } ?>
		</div>
	</div>
	<!-- End Vote information -->
	</div>
	<!-- Footer -->
	<?php include "includes/footer.php";
	mysqli_free_result($result);
	mysqli_close($con);
	?>
</body>
</html>

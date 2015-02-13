<?php include "functions/functions.php";?>
<?php include "includes/recordadd_includes.php";?>
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
			<h1>Add record for zone: <?php echo $zone_name. " | <a href=record.php?zone_id=".$zone_id."&zone_name=".$zone_name.">back to Hosts page</a>"; ?></h1>
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
				<form id="addrecord" class="form_add" action="recordadd.php" method="post">
					<fieldset>
					 <legend>Enter info</legend>
					  <label>Hostname:</label><input id="record_name" name="record_name" size="36" type="text"/>
					    <label>IP address:</label>
					    <div class="ipfields">
							<input id="record_ip8" name="record_ip8" value = "136" type="text" size="4" maxlength="3" readonly="readonly"/>
							<input id="record_ip16" name="record_ip16" value = "186" type="text" size="4" maxlength="3" readonly="readonly"/>
							<input id="record_ip32" name="record_ip32" value = "230" type="text" size="4" maxlength="3" readonly="readonly"/>
							<input id="record_ip64" name="record_ip64" type="text" size="4" maxlength="3"/>
					    </div> 					    
					     <input id="zone_id" name="zone_id" type="hidden" value="<?php echo $zone_id;?>"/>
					     <input id="zone_name" name="zone_name" type="hidden" value="<?php echo $zone_name;?>"/>
					     <input id="date" name="date" type="hidden" value="<?php echo $date;?>"/>
						  <label></label><input name="submit" type="submit" value="Submit" />
					</fieldset>
				</form><br />
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


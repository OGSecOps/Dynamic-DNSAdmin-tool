<?php include "functions/functions.php";?>
<?php include "includes/recordedit_includes.php";?>
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
			<h1>Edit record for zone: <?php echo $row["zone_name"]. " | <a href=record.php?zone_id=".$row["zone_id"]."&zone_name=".$row["zone_name"].">back to Hosts page</a>"; ?></h1>
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
				<form id="addrecord" class="form_add" action="recordedit.php" method="post">
					<fieldset>
					 <legend>Enter info</legend>
					  <label>Hostname:</label><input id="record_name" name="record_name" size="36" value="<?php echo $row["record_name"];?>" type="text"/>
					  <input id="oldHost" name="oldHost" type="hidden" value="<?php echo $row["record_name"];?>"/>
					    <label>IP address:</label>
					    <div class="ipfields"><?php $full_ip = $row["record_ip"]; $octets_ip = explode(".",$full_ip);?>
							<input id="record_ip8" name="record_ip8" type="text" size="4" value="<?php echo $octets_ip[0];?>" maxlength="3" readonly="readonly"/>
							<input id="record_ip16" name="record_ip16" type="text" size="4" value="<?php echo $octets_ip[1];?>" maxlength="3" readonly="readonly"/>
							<input id="record_ip32" name="record_ip32" type="text" size="4" value="<?php echo $octets_ip[2];?>" maxlength="3" readonly="readonly"/>
							<input id="record_ip64" name="record_ip64" type="text" size="4" value="<?php echo $octets_ip[3];?>" maxlength="3" />
					    </div>
					     <input id="record_id" name="record_id" type="hidden" value="<?php echo $row["record_id"];?>"/>					    
					     <input id="zone_id" name="zone_id" type="hidden" value="<?php echo $row["zone_id"];?>"/>
					     <input id="zone_name" name="zone_name" type="hidden" value="<?php echo $row["zone_name"];?>"/>
					     <input id="date" name="date" type="hidden" value="<?php echo $date;?>"/>
						  <label></label><input name="submit_edit" type="submit" value="Submit New Details" />
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

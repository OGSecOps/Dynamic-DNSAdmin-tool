<?php include "functions/functions.php";?>
<?php include "includes/serveradmin_includes.php";?>
<?php include "includes/metas.php";?>
<!-- Start of the body -->
<body>
<div id="container">
<!-- Heading -->
<?php include "includes/header.php";?>
<!-- End Heading -->	
	<!-- Image information -->
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
			<?php
				foreach($info as $in){
			     echo $in;//print succes queries
					}
			?>
		</div>
	</div>
	<!-- End Image information -->
	<hr />
		<div id="inner_pages_container">
				<!-- Server information -->
				<div id="main_tab">
					<ul class="tabs" data-persist="true">
						<li><a href="#view1">named.conf</a></li>
						<li><a href="#view2">DNS Zones</a></li>
						<li><a href="#view3">httpd-error.log</a></li>
					</ul>
					<div class="tabcontents">					
							<!-- Tab one -->
							<div id="view1">
								<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<?php
										if ($_POST["submit"]){
											$file = "/usr/local/etc/namedb/named.conf";
											$data = $_POST["named"];
											Write($file,$data);
										};
										?>      
										<form class="form_box" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
										<fieldset>
													 <legend>Edit</legend>
													  <label>named.conf</label><textarea name="named" rows="30" cols="70"><?php $file="/usr/local/etc/namedb/named.conf"; Read($file); ?></textarea>
													  <label></label><input name="submit" type="submit" value="Edit named.conf" />
													</fieldset>
										</form> 		
										</div>
								</div>
							</div>
							<!-- tab two -->
							<div id="view2">
								<b>All zones in BIND server:</b>
								<p><a href="javascript:slide4.slideit()">dyn.</a></P>
								<div id="expand_4">
									<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<form class="form_box"  method="post">
										<fieldset>
													 <legend>View Zone</legend>
													  <label></label><textarea name="zones" rows="30" cols="70"><?php $file="/usr/local/etc/namedb/working/dyn"; Read($file); ?></textarea>
													</fieldset>
										</form> 		
										</div>
									</div>
								</div>
								<p><a href="javascript:slide5.slideit()">.in-addr.arpa.</a></P>
								<div id="expand_5">
									<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<form class="form_box"  method="post">
										<fieldset>
													 <legend>View Zone</legend>
													  <label></label><textarea name="zones" rows="30" cols="70"><?php $file="/usr/local/etc/namedb/working/230.186.136.in-addr.arpa"; Read($file); ?></textarea>
													</fieldset>
										</form> 		
										</div>
									</div>
								</div>
								<p><a href="javascript:slide1.slideit()">mordor.</a></P>
								<div id="expand_1">
									<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<form class="form_box"  method="post">
										<fieldset>
													 <legend>View Zone</legend>
													  <label></label><textarea name="zones" rows="30" cols="70"><?php $file="/usr/local/etc/namedb/working/mordor"; Read($file); ?></textarea>
													</fieldset>
										</form> 		
										</div>
									</div>
								</div>
								<p><a href="javascript:slide2.slideit()">rohan.</a></p>
								<div id="expand_2">
									<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<form class="form_box"  method="post">
										<fieldset>
													 <legend>View Zone</legend>
													  <label></label><textarea name="zones" rows="30" cols="70"><?php $file="/usr/local/etc/namedb/working/rohan"; Read($file); ?></textarea>
													</fieldset>
										</form> 		
										</div>
									</div>
								</div>
								<p><a href="javascript:slide3.slideit()">gondor.</a></P>
								<div id="expand_3">
									<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<form class="form_box"  method="post">
										<fieldset>
													 <legend>View Zone</legend>
													  <label></label><textarea name="zones" rows="30" cols="70"><?php $file="/usr/local/etc/namedb/working/gondor"; Read($file); ?></textarea>
													</fieldset>
										</form> 		
										</div>
									</div>
								</div>                
							<script type="text/javascript">
							var slide1=new animatedcollapse("expand_1", 200, true);
							var slide2=new animatedcollapse("expand_2", 200, true);
							var slide3=new animatedcollapse("expand_3", 200, true);
							var slide4=new animatedcollapse("expand_4", 200, true);
							var slide5=new animatedcollapse("expand_5", 200, true);
							</script>
							</div>
							<!-- tab three -->
							<div id="view3">
								<div class="style_forms_clear_backgroung">
										<div class="style_forms_dark_backgroung">
										<form class="form_box"  method="post">
										<fieldset>
													 <legend>View</legend>
													  <label>httpd-error.log</label><textarea name="logs" rows="30" cols="70"><?php $file="/var/log/httpd-error.log"; Read($file); ?></textarea>
													</fieldset>
										</form> 		
										</div>
								</div>
							</div>
					</div>
				</div>
				<!-- End Server information -->	
		</div>
</div>
	<!-- Footer -->
	<?php include "includes/footer.php";
	mysqli_free_result($result);
	mysqli_close($con);
	?>
</body>
</html>

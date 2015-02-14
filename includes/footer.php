<div id="footer">
		<div class="footer-container">
				<div class="img_left"><img src="images/footer_map.jpg" alt="map_au" title="map_au"/></div>
				<!-- Search  -->
				<div class="style_forms_dark_backgroung">
					<?php if(isset($_SESSION["email_address"])){ }else{?>
				<form id="login" class="search_vote" action="login.php" method="post">
					<fieldset>
					 <legend>Log in</legend>
					  <input id="email_address" name="email_address" type="text" value="Email address" size="20"/><br /><br />
					    <input id="password" name="password" type="password" value="Password" size="20"/><br /><br />
						  <input name="submit" type="submit" value="Log in" />
					</fieldset>
				</form><?php }?>
				</div>
				<!-- End Search -->
		</div>
	</div> 
	<div class="rights"><p>Website developed by <a href="#">Oswaldo Gonzalez</a>, © 2014 SwinBurne University<br />
	</p>
	<div class="validation"><p>
    <a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" /></a>
    </p></div>
	</div>
</div>

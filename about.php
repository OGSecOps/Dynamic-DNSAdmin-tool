<?php session_start();?>
<?php include "includes/metas.php";?>
<!-- Start of the body -->
<body>
	<div id="container">
<!-- Heading -->
	<?php include "includes/header.php";?>
<!-- End Heading -->	
<!-- Stores and details -->
	<div id="contact">
				<div class="map">
					<a href="images/screenshot.jpg"><img src="images/meme.png" alt="SreentShot"/></a>
				</div>
				<div class="stores">
					<div class="stores">
						<h2 id="stores">What is DNS?</h2>
						<div class="store_details">Domain Name Service, is a protocol (and a mix of technologies) that provide IP address translation
						over the Internet. As we know every host, server or website has an IP address attached to it, that identifies it in a network
						, in order to access any object or service in this host it is necessary the translation of their IP address to hostname, hostnames are far more easy to remember than ip addresses. 
						A Domain Name Server keeps track of all this names in a distributed Data Base structure, so that it will be possible to find any hostname over the network. <br /></div>
						<h2 id="stores">What is DDNS?</h2>
						<div class="store_details">Dynamic DNS is a DNS feature that allows the administration of the zone db files without the need of 
						restart or stop the service, the idea is to allow any entity that holds a shared secret to add, remove entries into the DNS records, so this 
						way any client could easily manage their DNS zone with a minimum of down time of the service. DNSAmin is a web and Command-line tool
						that will provide Dynamic updates to your DNS server by making use of a intuitive interface in a easy way.<br /></div>
			    </div>
	</div>
</div>		
	<!-- End Stores and details -->
	<hr />
	<!-- Footer -->
	<?php include "includes/footer.php";?>
</body>
</html>

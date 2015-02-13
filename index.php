<?php session_start();?>
<?php include "functions/functions.php";?>
<?php include "includes/metas.php";?>
<!-- Start of the body -->
<body>
	<div id="container">
	<!-- Heading -->
	<?php include "includes/header.php";?>
	<!-- End Heading -->
	<!-- Info -->
	<div id="header_pages">	
	<h1>What is DNSAdmin?</h1>
	<p>DNS is an abbreviation for Domain Name System. It is the system created to translate human-readable names of servers to IP addresses, 
	which computers and networking devices can understand. DNSAdmin is a tool that provide support for dynamic DNS updates and the capability to propagated this updates as soon as a change is made.
    DNSAdmin client allow you to perform nsupdates by passing parameters to an HTTP request.</p>
	</div>
	<hr />
	<!-- End Info -->
	<!-- SQL for create tables-->
	<div id="menu">
		<?php include "includes/index_includes.php";?>
	</div>
	<!-- end SQL for create tables -->
	<!-- Footer -->
	<?php include "includes/footer.php";?>
</body>
</html>

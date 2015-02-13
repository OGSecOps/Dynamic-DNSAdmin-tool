<?php include "functions/functions.php";?>
<?php include "includes/record_includes.php";?>
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
	<!-- End Image information -->
	<hr />
	<div id="inner_pages_container">
	<!-- Vote information -->
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
			<h1>Records for zone: <?php echo $zone_name. " | <a href=recordadd.php?zone_id=".$zone_id."&zone_name=".$zone_name.">Add new host</a>"; ?></h1>
			<?php
				/*foreach($success as $succes){
			     echo $succes;//print succes queries
					}*/
			?>			
			<table cellspacing='0'>
				<!-- Table Header -->
				<thead>
					<tr>
						<th width="20%">Hostname</th>
						<th width="20%">IP address</th>
						<th width="20%">Task</th>
					</tr>
				</thead>
				<!-- Table Header -->
				<!-- Table Body -->
				<tbody>
				<?php
				//list
					while ($row) {
						echo "<tr>";
						echo "<td>".$row["record_name"]."</td>";
						echo "<td>".$row["record_ip"]."</td>";
						echo "<td><a href=\"record.php?remove=".$row["record_id"]."\">Remove</a> | <a href=\"recordedit.php?edit=".$row["record_id"]."&zone_id=".$zone_id."&zone_name=".$zone_name."\">Edit</a></td>";
						echo "</tr>";
						$row = mysqli_fetch_assoc($result);
					}
				?>
				</tbody>
				<!-- Table Body -->
			</table>
			<?php echo getPaginator($adjacents,$total_pages,$url,$limit,$page,$start);//function that generate the pagination ?>
			<?php echo "<br /><p><h1>Number of hosts: ".$num_of_host."</h1></p>";?>	
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


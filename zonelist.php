<?php include "functions/functions.php";?>
<?php include "includes/zone_includes.php";?>
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
	<!-- Vote information -->
	<div class="style_forms_clear_backgroung">
		<div class="style_forms_dark_backgroung">
			<h1>My Zones</h1>			
			<table cellspacing='0'>
				<!-- Table Header -->
				<thead>
					<tr>
						<th width="30%">Zone Name</th>
						<th width="15%">Zone Type</th>
						<th width="30%">Task</th>
					</tr>
				</thead>
				<!-- Table Header -->
				<!-- Table Body -->
				<tbody>
				<?php
				//list
				if($num_of_zones != 0){
					while ($row){
						echo "<tr>";
						echo "<td>".$row["zone_name"]."</td>";
					    echo "<td>".$row["zone_type"]."</td>";
					    echo "<td><a href=\"record.php?zone_id=".$row["zone_id"]."&zone_name=".$row["zone_name"]."\">View Host records</a></td>";
					    echo "</tr>";
						$row = mysqli_fetch_assoc($result);
					}
					}else{ echo "<br /><p><h1>You don't currently have zones under your supervision</h1></p>";}
				?>
				</tbody>
				<!-- Table Body -->
			</table>
			<?php echo getPaginator($adjacents,$total_pages,$url,$limit,$page,$start);//function that generate the pagination ?>
			<?php echo "<br /><p><h1>Number of zones: ".$num_of_zones."</h1></p>";?>	
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

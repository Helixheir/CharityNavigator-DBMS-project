<?php

	include('config/db_connect.php');

	// write query for all pizzas
	$sql = 'SELECT fname, lname, id,email FROM trustee ORDER BY created_at';
	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);
	// fetch the resulting rows as an array
	$donation = mysqli_fetch_all($result, MYSQLI_ASSOC);
	// free the $result from memory (good practise)
	mysqli_free_result($result);
	// close connection
	mysqli_close($conn);


?>
<!DOCTYPE html>
<html>

	<?php include('templates/admin_dashboard_header.php'); ?>

	<h4 class="center grey-text">Organisations</h4>

	<div class="container">
		<div class="row">

			<?php foreach($donation as $d): ?>

				<div class="col s6 md3">
					<div class="card">
						<img src="w.png" class="pizza">
						<div class="card-content center">
						<h6><?php echo htmlspecialchars($d['fname']) ,htmlspecialchars($d['lname']); ?></h6>
							<div><?php echo htmlspecialchars($d['email']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $d['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

<?php include('templates/admin_footer.php');?>

</html>
<?php

	include('config/db_connect.php');

	// write query for all pizzas
	$sql = 'SELECT name, location, id FROM organisations ORDER BY created_at';
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

<?php include('templates/header.php')?>

	<h4 class="center grey-text">Organisations</h4>

	<div class="container">
		<div class="row">

			<?php foreach($donation as $d): ?>

				<div class="col s6 md3">
					<div class="card">
						<img src="w.png" class="pizza">
						<div class="card-content center">
							<h5><?php echo htmlspecialchars($d['name']); ?></h5>
							<h6>Location : <?php echo htmlspecialchars($d['location']); ?></h6>
						</div>
						<div class="card-action right-align">
							<a class="btn brand" href="add.php?id=<?php echo $d['id'] ?>">Donate</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>
<?php include('templates/modal.html');?>
<?php include('templates/footer.php');?>

</html>
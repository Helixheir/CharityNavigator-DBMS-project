<?php
include('config/db_connect.php');
$name=$_POST['oname'];


//sql to delete a record
$sql="SELECT * FROM reciept WHERE oname='$name'";

$records=mysqli_query($conn,$sql);
$donation = mysqli_fetch_all($records, MYSQLI_ASSOC);
	// free the $result from memory (good practise)
	mysqli_free_result($records);
	// close connection
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php');?>
<h4 class="center grey-text">Donations Recieved by </h4>
<h3 class="center grey-text"><?php echo $name?> </h4>
	<div class="container">
		<div class="row">

			<?php foreach($donation as $d): ?>

				<div class="col s6 md3">
					<div class="card">
						<img src="icon.jpg" class="pizza">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($d['oname']); ?></h6>
							
							<div>Donation Type : <?php echo htmlspecialchars($d['donation_type']); ?></div>
							<div>Quantity : <?php echo htmlspecialchars($d['quantity']); ?></div>
							<div>Timestamp : <?php echo htmlspecialchars($d['created_at']); ?></div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>
	<center>
		<div class="card-action">
		<a class="btn brand" href="donations.php">Back</a>
						</div>

						<?php include('templates/footer.php');?>



<?php
include('config/db_connect.php');



$sql1="CALL get_donations";
$result=mysqli_query($conn,$sql1);
?>
<!DOCTYPE html>
<html>

<?php include('templates/header.php');?>

<h4 class="center grey-text">Donation </h4>

<h3 class="center grey-text"></h4>
	<div class="container">
		<div class="row">
			<?php

if(mysqli_num_rows($result)==0)
{ 
 echo "no records found";
}
else
{
   $row=mysqli_fetch_all($result,MYSQLI_ASSOC); 
   mysqli_free_result($result);
 
}

mysqli_close($conn);

?>

			<?php foreach($row as $d): ?>

				<div class="col s6 md3">
					<div class="card">
						<img src="icon.jpg" class="pizza">
						<div class="card-content center">
							<h6>Donator :<?php echo htmlspecialchars($d['name']); ?></h6>
							<div>Organization Name : <?php echo htmlspecialchars($d['oname']); ?></div>
							<div>Donation Type : <?php echo htmlspecialchars($d['donation_type']); ?></div>
							<div>Quantity : <?php echo htmlspecialchars($d['quantity']); ?></div>
													</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>
	<center>
		<div class="card-action">
		<a class="btn brand" href="index.php">Back</a>
						</div>

						<?php include('templates/footer.php');?>
</center>
</h3>
</html>


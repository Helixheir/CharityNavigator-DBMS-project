<?php 
	include('config/db_connect.php');

	if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM organisations WHERE id = $id_to_delete";
		$sql1 = "DELETE FROM trustee WHERE id = $id_to_delete";
		$sql2 = "DELETE FROM o_login WHERE id = $id_to_delete";
		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)&& mysqli_query($conn, $sql2)){
			header('Location: admin_dashboard.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
	}

	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql
		
		$sql="SELECT * FROM organisations WHERE id = $id";
		// get the query result
		$result = mysqli_query($conn, $sql);
		
		// fetch result in array format
		$o = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>

	<?php include('templates/admin_dashboard_header.php'); ?>

	<div class="container center">
		
		<?php if($o): ?>
			<h4><?php echo $o['name']; ?></h4>
			<p>Domain : <?php echo $o['domain']; ?></p>
			<p><?php echo $o['description']; ?></p>
			<p><?php echo $o['location']; ?></p>
			<p>Added by : <?php echo $o['a_name']; ?></p>
			<p>Timestamp : <?php echo $o['created_at']; ?></p>


			<!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $o['id']; ?>">
				<input type="submit" name="delete" value="Remove" class="btn brand z-depth-0">
			</form>
		<?php else: ?>
			<h5>Invalid organisation address.</h5>
		<?php endif ?>

		
	</div>

	<?php include('templates/admin_footer.php'); ?>

</html>
<?php 
	include('config/db_connect.php');

	if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM organisations WHERE id = $id_to_delete";
		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}
	}

	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql
		$sql = "SELECT * FROM trustee WHERE id = $id";
		$sql1="SELECT * FROM organisations WHERE id = $id";
		// get the query result
		$result = mysqli_query($conn, $sql);
		$o= mysqli_fetch_assoc(mysqli_query($conn, $sql1));
		// fetch result in array format
		$trustee = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if($trustee): ?>
			<h4><?php echo $trustee['fname'],$trustee['lname']; ?></h4>
			<p>contact at <?php echo $trustee['email']; ?></p>
			<p><?php echo $trustee['phno']; ?></p>
			<p><?php echo date($trustee['created_at']); ?></p>
		<?php if($o): ?>
			<h4><?php echo $o['name']; ?></h4>
			<p>Domain : <?php echo $o['domain']; ?></p>
			<p><?php echo $o['description']; ?></p>
			<p><?php echo $o['location']; ?></p>


			<!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $organisation['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
		<?php else: ?>
			<h5>Invalid organisation address.</h5>
		<?php endif ?>

		<?php else: ?>
			<h5>Invalid organisation address.</h5>
		<?php endif ?>
	</div>

	<?php include('templates/admin_footer.php'); ?>

</html>
<?php
include('session.php');
	
	include('config/db_connect.php');
	$email = $username = $password = '';
	$errors = array('email' => '', 'username' => '', 'password' => '');

	if(isset($_POST['submit'])){

		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$errors['email'] = 'Email must be a valid email address';
			}
		}
		// check title
		if(empty($_POST['username'])){
			$errors['username'] = 'A name is required';
		} else{
			$username = $_POST['username'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $username))
			{
				$errors['username'] = 'name must be letters and spaces only';
			}
		}

		// check title
		if(empty($_POST['password'])){
			$errors['password'] = 'A name is required';
		} else{
			$password = $_POST['password'];
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			//escape sql chars
			$password = mysqli_real_escape_string($conn,$_POST['password']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$username = mysqli_real_escape_string($conn,$_POST['username']);
			//create sql
			$sql = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";

			//save to db and check
			if(mysqli_query($conn,$sql)){
				//success
				header('Location: admin_dashboard.php');
			}else{
				echo 'query error:' .mysqli_error($conn);
			}
			
		}


	}

?>
<!DOCTYPE html>
<html>

<?php include('templates/admin_dashboard_header.php');?>

<section class="container grey-text">
	<h4 class="center">Add New Admin</h4>
	<form class="white z-depth-1" action="addadmin.php" method="POST">
		<label>Admin name :</label>
		<input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
		<div class="red-text"><?php echo $errors['username']; ?></div>
		
		<label>Email :</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Password :</label>
		<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
		<div class="red-text"><?php echo $errors['password']; ?></div>

		<div class="center">
		<input type="submit" name="submit" value="submit" class="btn brand ">
		</div>
	</form>
</h2>
</section>

<?php include('templates/admin_footer.php');?>
	

</html>









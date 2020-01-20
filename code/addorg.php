<?php
include('session.php');
	
	include('config/db_connect.php');
	$id = $domain = $fname = $lname = $phno ='';
	$email = $oname = $location = $description = '';
	$errors = array('email' => '', 'oname' => '', 'location' => '', 'description' => '','id' => '','fname' => '','lname' => '','domain' => '','phno' => '');

	if(isset($_POST['submit'])){

		// check id
		if(empty($_POST['id'])){
			$errors['id'] = 'id is required';
		} else
		{
			$id = $_POST['id'];
		}

		// check phno
		if(empty($_POST['phno'])){
			$errors['phno'] = 'phno is required';
		} else
		{
			$phno = $_POST['phno'];
		}

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
		if(empty($_POST['oname'])){
			$errors['oname'] = 'A name is required';
		} else{
			$oname = $_POST['oname'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $oname))
			{
				$errors['oname'] = 'name must be letters and spaces only';
			}
		}

		// check title
		if(empty($_POST['fname'])){
			$errors['fname'] = 'A name is required';
		} else{
			$fname = $_POST['fname'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $fname))
			{
				$errors['fname'] = 'name must be letters and spaces only';
			}
		}

		if(empty($_POST['lname'])){
			$errors['lname'] = 'A name is required';
		} else{
			$lname = $_POST['lname'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $lname))
			{
				$errors['oname'] = 'name must be letters and spaces only';
			}
		}


		if(empty($_POST['domain'])){
			$errors['domain'] = 'A domain is required';
		} else{
			$domain = $_POST['domain'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $domain))
			{
				$errors['oname'] = 'name must be letters and spaces only';
			}
		}

		// check location
		if(empty($_POST['location'])){
			$errors['location'] = 'A location is required';
		} else{
			$location = $_POST['location'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $location))
			{
				$errors['location'] = 'location must be letters and spaces only';
			}
		}

		// check decription
		if(empty($_POST['description'])){
			$errors['description'] = 'description is required';
		} else
		{
			$description = $_POST['description'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $description))
			{
				$errors['description'] = 'description must be letters and spaces only';
			}
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			//escape sql chars
			$id = mysqli_real_escape_string($conn,$_POST['id']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$oname = mysqli_real_escape_string($conn,$_POST['oname']);
			$location = mysqli_real_escape_string($conn,$_POST['location']);
			$description = mysqli_real_escape_string($conn,$_POST['description']);
			$lname = mysqli_real_escape_string($conn,$_POST['lname']);
			$fname = mysqli_real_escape_string($conn,$_POST['fname']);
			$domain = mysqli_real_escape_string($conn,$_POST['domain']);
			$phno = mysqli_real_escape_string($conn,$_POST['phno']);
			//create sql
			$sql = "INSERT INTO organisations(id,domain,name,location,description,a_name) VALUES($id,'$domain','$oname','$location','$description','$login_session')";

			$sql1 = "INSERT INTO trustee(id,fname,lname,oname,email,phno) 
			VALUES($id,'$fname','$lname','$oname','$email','$phno')";

			

			//save to db and check
			if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){
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
	<h4 class="center">Add Organisation</h4>
	<form class="white z-depth-1" action="addorg.php" method="POST">
		<label>Id :</label>
		<input type="number" name="id" value="<?php echo htmlspecialchars($id) ?>">
		<div class="red-text"><?php echo $errors['id']; ?></div>
		<label>Organisation Name :</label>
		<input type="text" name="oname" value="<?php echo htmlspecialchars($oname) ?>">
		<div class="red-text"><?php echo $errors['oname']; ?></div>
		<label>Domain :</label>
		<input type="text" name="domain" value="<?php echo htmlspecialchars($domain) ?>">
		<div class="red-text"><?php echo $errors['domain']; ?></div>
		<label>Description :</label>
		<input type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
		<div class="red-text"><?php echo $errors['description']; ?></div>
		<label>Location :</label>
		<input type="text" name="location" value="<?php echo htmlspecialchars($location) ?>">
		<div class="red-text"><?php echo $errors['location']; ?></div>
		
		<label>Email :</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Trustee First Name :</label>
		<input type="text" name="fname" value="<?php echo htmlspecialchars($fname) ?>">
		<div class="red-text"><?php echo $errors['fname']; ?></div>
		<label>Trustee Last Name :</label>
		<input type="text" name="lname" value="<?php echo htmlspecialchars($lname) ?>">
		<div class="red-text"><?php echo $errors['lname']; ?></div>
		<label>Phno :</label>
		<input type="text" name="phno" value="<?php echo htmlspecialchars($phno) ?>">
		<div class="red-text"><?php echo $errors['phno']; ?></div>

		<div class="center">
		<input type="submit" name="submit" value="submit" class="btn brand ">
		</div>
	</form>
</h2>
</section>

<?php include('templates/admin_footer.php');?>
	

</html>









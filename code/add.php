<?php

	
	include('config/db_connect.php');

	$did = $email = $name =$oname = $location = $dtype = $phno = $quantity = '';
	$errors = array('did' => '','email' => '', 'name' => '','oname' => '', 'location' => '', 'dtype' => '','phno' => '','quantity' => '');
	
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
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name))
			{
				$errors['name'] = 'name must be letters and spaces only';
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
		// check location
		if(empty($_POST['oname'])){
			$errors['oname'] = 'A name is required';
		} else{
			$oname = $_POST['oname'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $oname))
			{
				$errors['oname'] = 'name must be letters and spaces only';
			}
		}

		
		// check amount
		if(empty($_POST['dtype'])){
			$errors['dtype'] = 'donation type is required';
		} else
		{
			$dtype = $_POST['dtype'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $dtype))
			{
				$errors['dtype'] = 'it must be letters and spaces only';
			}
		}
		// check amount
		if(empty($_POST['did'])){
			$errors['did'] = 'id is required';
		} else
		{
			$did = $_POST['did'];
		}

		// check amount
		if(empty($_POST['phno'])){
			$errors['phno'] = 'phno is required';
		} else
		{
			$phno = $_POST['phno'];
		}

		// check amount
		if(empty($_POST['quantity'])){
			$errors['quantity'] = 'quantity is required';
		} else
		{
			$quantity = $_POST['quantity'];
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			//escape sql chars
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$name = mysqli_real_escape_string($conn,$_POST['name']);
			$location = mysqli_real_escape_string($conn,$_POST['location']);
			$quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
			$dtype = mysqli_real_escape_string($conn,$_POST['dtype']);
			$phno = mysqli_real_escape_string($conn,$_POST['phno']);
			$oname = mysqli_real_escape_string($conn,$_POST['oname']);
			$did = mysqli_real_escape_string($conn,$_POST['did']);

			//create sql
			$sql = "INSERT INTO donations(id,email,name,location,phno) VALUES($did,'$email','$name','$location','$phno')";
			$sql1 = "INSERT INTO reciept(id,oname,donation_type,quantity) VALUES($did,'$oname','$dtype','$quantity')";


			//save to db and check
			if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){
				//success
				header('Location: index.php');
			}else{
				echo 'query error:' .mysqli_error($conn);
			}
			
		}


	}

		if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql
		
		$sql="SELECT * FROM organisations WHERE id = $id";
		$sql1="SELECT * FROM trustee WHERE id = $id";
		$result1 = mysqli_query($conn, $sql1);
		
		// fetch result in array format
		$t = mysqli_fetch_assoc($result1);
		mysqli_free_result($result1);
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

<?php include('templates/header.php');?>

      
<section class="container grey-text">
	<div class="container center"  >
		<?php if($o): ?>
			<h4><?php echo $o['name']; ?></h4>
			<p><?php echo $o['domain']; ?>&nbsp Organisation</p>
			<p><?php echo$o['description']; ?></p>
			<p><?php echo $o['location']; ?></p>

		<?php else: ?>
			<h5>Invalid organisation address.</h5>
		<?php endif ?>
		<?php if($t): ?>
			<h4><?php echo $t['fname'];echo $t['lname']; ?></h4>
			<p>Email : <?php echo $t['email']; ?></p>
			<p>Phone number : <?php echo $t['phno']; ?></p>
			

		<?php else: ?>
			<h5>Invalid organisation address.</h5>
		<?php endif ?>
	</div>
	
	<form class="white z-depth-1" action="add.php" method="POST">
		<h4 class="center">Donate</h4>
		<label>id :</label>
		<input type="text" name="did" value="<?php echo htmlspecialchars($did) ?>">
		<div class="red-text"><?php echo $errors['did']; ?></div>
		
		<label>Your Email :</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Name :</label>
		<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
		<div class="red-text"><?php echo $errors['name']; ?></div>
		<label>Location :</label>
		<input type="text" name="location" value="<?php echo htmlspecialchars($location) ?>">
		<div class="red-text"><?php echo $errors['location']; ?></div>
		<label>Phno :</label>
		<input type="number" name="phno" value="<?php echo htmlspecialchars($phno) ?>">
		<div class="red-text"><?php echo $errors['phno']; ?></div>
		<label>Organisation name :</label>
		<input type="text" name="oname" value="<?php echo htmlspecialchars($oname) ?>">
		<div class="red-text"><?php echo $errors['oname']; ?></div>
		<label>Donation type :</label>
		<input type="text" name="dtype" value="<?php echo htmlspecialchars($dtype) ?>">
		<div class="red-text"><?php echo $errors['dtype']; ?></div>
		<label>Quantity :</label>
		<input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity) ?>">
		<div class="red-text"><?php echo $errors['quantity']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand ">
		</div>
	</form>

</section>

<?php include('templates/footer.php');?>
	

</html>









<?php
include('session.php');
	
	include('config/db_connect.php');
	 $fname = $lname = $phno =$id='';
	
	$errors = array('id' => '','fname' => '','lname' => '','phno' => '');

	if(isset($_POST['submit'])){


		// check phno
		if(empty($_POST['id'])){
			$errors['id'] = 'id is required';
		} else
		{
			$phno = $_POST['id'];
		}
		// check phno
		if(empty($_POST['phno'])){
			$errors['phno'] = 'phno is required';
		} else
		{
			$phno = $_POST['phno'];
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

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			//escape sql chars
			
			$lname = mysqli_real_escape_string($conn,$_POST['lname']);
			$fname = mysqli_real_escape_string($conn,$_POST['fname']);
						$phno = mysqli_real_escape_string($conn,$_POST['phno']);
						$id = mysqli_real_escape_string($conn,$_POST['id']);
			//create sql
			
			$sql1 = "	UPDATE trustee SET fname='$fname',lname='$lname',phno='$phno' WHERE id='$id'";

			

			//save to db and check
			if( mysqli_query($conn,$sql1) ){
				//success
				header('Location: index.php');
			}else{
				echo 'query error:' .mysqli_error($conn);
			}
			
		}


	}

?>
<!DOCTYPE html>
<html>

<?php include('templates/o_header.php');?>

<section class="container grey-text">
	<h4 class="center">Update Organisation Info</h4>
	<form class="white z-depth-1" action="o_dashboard.php" method="POST">
		
		<label>Id :</label>
		<input type="text" name="id" value="<?php echo htmlspecialchars($id) ?>">
		<div class="red-text"><?php echo $errors['id']; ?></div>
		
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
	<h5 class="center"><a class ="btn brand"href = "logout.php">Log Out</a></h2>
</section>

<?php include('templates/footer.php');?>
	

</html>









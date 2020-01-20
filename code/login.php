<?php
$name = $password = '';

   include("config/db_connect.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $name = mysqli_real_escape_string($conn,$_POST['name']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE username = '$name' and password = '$password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['login_user'] = $name;
         
         header("location:admin_dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html>

<?php include('templates/header.php');?>

<section class="container grey-text">
	

	<form class="white z-depth-1" action="login.php" method="POST">
		<h5 class="center"><img src="q.png" class="pizza" class="card">Admin</h5>
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
		<label>password:</label>
		<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
		
		<div class="center">
			<input type="submit" name="login" value="submit" class="btn brand ">
		</div>
	</form>
</section>

<?php include('templates/footer.php');?>
	

</html>









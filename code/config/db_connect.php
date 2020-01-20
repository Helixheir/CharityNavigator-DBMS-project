<?php
	
	//connect to db
	$conn=mysqli_connect('localhost','harsha','test12','charity_navigator');

	//check connection
	if(!$conn){
			echo 'Connection error:' .mysql_connect_error(); 
	}

?>
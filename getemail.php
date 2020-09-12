<?php ob_start();
require      ('include/connection.php'); 
//header("Content-Type: Application/json");
	if(isset($_POST['email'])){
		$email=$_POST['email'];
	$query  = "SELECT * FROM customers where customer_email = '{$email}'";
	//echo $query;
	$result = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result) == 1)
	{
		echo "email founded";
	}
	else{
		echo "email not found";	}
	}
;
	<?php
	 require ('include/connection.php'); 
	 $id=$_GET['id'];
	 $query="DELETE FROM customers WHERE customer_id={$id}";
	 if(mysqli_query($conn,$query))	 {
	 	header("Location:manage_customers.php");	
	 }
	




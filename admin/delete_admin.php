	<?php
	 require ('include/connection.php'); 
	 $id=$_GET['id'];
	 $query="DELETE FROM admin WHERE admin_id={$id}";
	 if(mysqli_query($conn,$query))	 {
	 	header("Location:manage_admin.php");	
	 }
	




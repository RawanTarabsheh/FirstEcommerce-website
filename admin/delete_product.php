	<?php
	 require ('include/connection.php'); 
	 $id=$_GET['id'];
	 $query="DELETE FROM products WHERE product_id={$id}";
	 if(mysqli_query($conn,$query))	 {
	 	unlink('images/products/'.$id.'.jpg');
	 	header("Location:manage_product.php");	
	 }
	




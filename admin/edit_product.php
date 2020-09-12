	<?php 
	ob_start();
	include_once ('include/admin_header.php'); 
	require      ('include/connection.php'); 
	?>
<!-- MAIN CONTENT-->
<div class="main-content">
	<?php
	    $id=$_GET['id'];
		if(isset($_GET['id']))
		{
			
			$query="SELECT * FROM products WHERE product_id={$id}";
			if(mysqli_query($conn,$query)){
				$result=mysqli_query($conn,$query);
				$products=mysqli_fetch_assoc($result);
			}
		}
		if(isset($_POST['submit']))
	{
		$id            = $_GET['id'];
		unlink('images/products/'.$id.'.jpg');
		$productName   = $_POST['proname'];
		$productPrice  = $_POST['proprice'];
		$productDesc   = $_POST['prodes'];
		$Categoryid    = $_POST['catid'];
		$tmp_name      = $_FILES['product_image']['tmp_name'];
		$path          ="images/products/";
		$target_file   = $path . basename($_FILES["product_image"]["name"]);
		//$imageFileType = strtolower(pathinfo($tmp_name,PATHINFO_EXTENSION));
		$newnameimage  =$id."."."jpg";
		//move files to images folder
		move_uploaded_file($tmp_name, $path.$newnameimage);
		$query="UPDATE products SET product_name    ='$productName',
							        product_image   ='$newnameimage',
							        product_price   ='$productPrice',
							        product_desc    ='$productDesc',
							        cat_id          ='$Categoryid'
				WHERE product_id={$id}	";
				if(mysqli_query($conn,$query))
				{
					header("Location:manage_product.php");
		        }// if for query
		       else
			        echo "Error: " . $query . "<br>" . mysqli_error($conn);
	 
	}//end submit
	?>
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<!-- Add Product-->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong>Update</strong> Product
						</div>
						<div class="card-body card-block">
							<form action="" method="post"  class="form-horizontal" enctype="multiport/form-data">
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="text-input" class=" form-control-label">Product Name:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="text" id="text-input" name="proname" class="form-control" value="<?php echo $products['product_name'];?>">
										<small class="form-text text-muted">Enter Name Of product.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Product Price:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="number" name="proprice" class="form-control" value="<?php echo $products['product_price']; ?>">
										<small class="help-block form-text">Enter Price Of product.</small>
									</div>
								</div>

								<div class="row form-group">
									<div class="col col-md-3">
										<label for="textarea-input" class=" form-control-label">Product Description:</label>
									</div>
									<div class="col-12 col-md-9">
										<textarea name="prodes" id="prodes" rows="9" class="form-control" ><?php echo $products['product_desc']; ?></textarea>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="select" class=" form-control-label">Select Category:</label>
									</div>
									<div class="col-12 col-md-9">
										<select name="catid" id="select" class="form-control">
											<?php 
											$query="SELECT * FROM category WHERE cat_id={$products['cat_id']}";
											$result=mysqli_query($conn,$query);
											$category=mysqli_fetch_assoc($result);

											?>
											<option value="<?php echo $products['cat_id'];?>"><?php echo $category['cat_name'];?></option>

											<?php 
											$query="SELECT * FROM category";
											$result=mysqli_query($conn,$query);
											while($category=mysqli_fetch_assoc($result))
											{

											?>
											<option value="<?php echo $category['cat_id'];?>"><?php echo $category['cat_name'];?></option>
										
										<?php } ?>
										</select>
									</div>
								</div>
								
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="file-multiple-input" class=" form-control-label">Insert Images:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="file" id="file-multiple-input" name="product_image" class="form-control-file">
									</div>
								</div>
								<div class="card-footer">
							<button type="submit" class="btn btn-primary btn-sm" name="submit">
								<i class="fa fa-dot-circle-o"></i> Update
							</button>
						       </div>
							</form>
						</div>
						
					</div>

				</div>
			</div>
			<!-- Add Product-->				
					<!-- View Product-->
				</div>
			</div>
		</div>
		<?php include_once('include/admin_footer.php'); ?>
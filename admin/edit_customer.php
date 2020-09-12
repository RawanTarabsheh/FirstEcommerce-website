	<?php ob_start();
	include_once ('include/admin_header.php'); 
	require      ('include/connection.php'); 
	?>
<!-- MAIN CONTENT-->
<div class="main-content">
	<?php
	 $id=$_GET['id'];
		if(isset($_GET['id']))
		{
			
			$query="SELECT * FROM customers WHERE customer_id ={$id}";
			if(mysqli_query($conn,$query)){
				$result=mysqli_query($conn,$query);
				$customers=mysqli_fetch_assoc($result);
			}
		}
	if(isset($_POST['submit']))
	{
		$customerName      =$_POST['customername'];
		$customerEmail     =$_POST['customeremail'];
		$customerPassword  =$_POST['customerpassword'];
		$customerMobile    =$_POST['customerphone'];
		$customerAddress   =$_POST['customeraddress'];
		$lastLogin         =$_POST['lastlogin'];
		$id                =$_GET['id'];
		$tmp_name          =$_FILES['customer_image']['tmp_name'];
		$path              ="images/customers/";
		$target_file       = $path . basename($_FILES["customer_image"]["name"]);
		$imageFileType     = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$newnameimage      =$id.".".$imageFileType;
	    move_uploaded_file($tmp_name, $path.$newnameimage);


		$query="UPDATE customers SET customer_name       ='$customerName',
							         customer_email      ='$customerEmail',
							         customer_password   ='$customerPassword',
							         customer_image      ='$newnameimage',
							         mobile              ='$customerMobile',
							         address             ='$customerAddress',
							         last_login          ='$lastLogin' 
				WHERE customer_id ={$id}	";

		                    if(mysqli_query($conn,$query))
				{
					header("Location:manage_customers.php");
		        }// if for query
		       else
			        echo "Error: " . $query . "<br>" . mysqli_error($conn);

	}//end if submit
	?>
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<!-- Add Product-->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong>Update</strong> Customer
						</div>
						<div class="card-body card-block">
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="text-input" class=" form-control-label">Customer Name:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="text"  name="customername"  class="form-control" value="<?php echo $customers['customer_name'];?>">
										<small class="form-text text-muted">Enter Name Of customer.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="email-input" class=" form-control-label">Customer Email </label>
									</div>
									<div class="col-12 col-md-9">
										<input type="email"  name="customeremail"  class="form-control" value="<?php echo $customers['customer_email'];?>">
										<small class="help-block form-text">Enter email of customer </small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Customer Password </label>
									</div>
									<div class="col-12 col-md-9">
										<input type="password"  name="customerpassword"  class="form-control" value="<?php echo $customers['customer_password']; ?>">
										<small class="help-block form-text">Enter Password of customer </small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="text-input" class="form-control-label">Customer Address:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="text"  name="customeraddress" class="form-control" value="<?php echo $customers['address'];?>">
										<small class="form-text text-muted">Enter address Of customer.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Customer phone:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="number"  name="customerphone" class="form-control" value="<?php echo $customers['mobile'];?>">
										<small class="help-block form-text">Enter phone Of customer.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Last Login:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="date"  name="lastlogin"  class="form-control" value="<?php echo $customers['last_login'];?>">
										<small class="help-block form-text">Enter date Of customer.</small>
									</div>
								</div>

								
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="file-multiple-input" class=" form-control-label">Insert Images:</label>
									</div>
									<div class="col-12 col-md-9">
										<input type="file" id="file-multiple-input" name="customer_image" multiple="" class="form-control-file">
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
			<!-- Update Product-->
		
				</div>
			</div>
		</div>
		<?php include_once('include/admin_footer.php'); ?>
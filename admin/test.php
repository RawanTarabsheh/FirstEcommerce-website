	<?php ob_start();
	include_once ('include/admin_header.php'); 
	require      ('include/connection.php'); 
	?>
<!-- MAIN CONTENT-->
<div class="main-content">
	<?php
	if(isset($_POST['submit']))
	{
		$customerName      =$_POST['customername'];
		$customerEmail     =$_POST['customeremail'];
		$customerPassword  =$_POST['customerpassword'];
		$customerMobile    =$_POST['customerphone'];
		$customerAddress   =$_POST['customeraddress'];
		$lastLogin         =$_POST['lastlogin'];
		$imageName		   =$_FILES['customer_image']['name'];
		$query1="INSERT INTO customers (customer_name,customer_email,customer_password,customer_image ,
		                    mobile,address,last_login)
		                    VALUES 
		                    ('$customerName','$customerEmail','$customerPassword','$imageName',
		                    '$customerMobile','$customerAddress','$lastLogin') ";
	    mysqli_query($conn,$query1) ;    
		$id            =mysqli_insert_id($conn);      
		$tmp_name      =$_FILES['customer_image']['tmp_name'];
		$path          ="images/customers/";
		$target_file   = $path . basename($_FILES["customer_image"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$newnameimage  =$id.".".$imageFileType;
		//move files to images folder
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
	if(isset($_GET['idd'])){
		$id=$_GET['idd'];
		$query1="SELECT customer_image FROM customers WHERE customer_id={$id}";
		$customer_image=mysqli_fetch_assoc(mysqli_query($conn,$query1));
		unlink('images/customers/'.$customer_image['customer_image']);
	    $query="DELETE FROM customers WHERE customer_id={$id}";
	    if(mysqli_query($conn,$query))
	 	header("Location:manage_customers.php");
	 }//delete

 if(isset($_GET['ide'])){

	 	$id=$_GET['ide'];
	 	$query="SELECT * FROM customers WHERE customer_id ={$id}";
			if(mysqli_query($conn,$query)){
				$result=mysqli_query($conn,$query);
				$customers=mysqli_fetch_assoc($result);
			}
	 	
	 	if(isset($_POST['update'])){
	 	$newnameimage      =$customers['customer_image'];
	if($_FILES['customer_image']['error'] == 0)
	{
		unlink('images/customers/'.$customers['customer_image']);
		$tmp_name          =$_FILES['customer_image']['tmp_name'];
		$path              ="images/customers/";
		$target_file       = $path . basename($_FILES["customer_image"]["name"]);
		$imageFileType     = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$newnameimage      =$id.".".$imageFileType;
	    move_uploaded_file($tmp_name, $path.$newnameimage);

	}//uploded new file	        
	    $customerName      =$_POST['customername'];
		$customerEmail     =$_POST['customeremail'];
		$customerPassword  =$_POST['customerpassword'];
		$customerMobile    =$_POST['customerphone'];
		$customerAddress   =$_POST['customeraddress'];
		$lastLogin         =$_POST['lastlogin'];
		

	 		$query="UPDATE customers SET customer_name   ='$customerName',
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
}//update
	}//edit
	?>
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<!-- Add Product-->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<?php
								if(isset($_GET['ide'])) 
									$type= "Update"; 
								else
									$type="Add";
								?>
							<strong><?php echo $type; ?></strong> Customer
						</div>
						<div class="card-body card-block">
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="text-input" class=" form-control-label">Customer Name:</label>
									</div>
									<?php
											if(isset($_GET['ide'])) 
												$value= $customers['customer_name']; 
											else
											$value="";
									?>
									<div class="col-12 col-md-9">
										<input type="text"  name="customername"  class="form-control" value="<?php echo $value; ?>">
										<small class="form-text text-muted">Enter Name Of customer.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="email-input" class=" form-control-label">Customer Email </label>
									</div>
									<?php
											if(isset($_GET['ide'])) 
												$emailvalue= $customers['customer_email']; 
											else
											$emailvalue="";
									?>
									<div class="col-12 col-md-9">
										<input type="email"  name="customeremail" placeholder="Enter Email" class="form-control" value="<?php echo $emailvalue; ?>">
										<small class="help-block form-text">Enter email of customer </small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Customer Password </label>
									</div>
									<?php
											if(isset($_GET['ide'])) 
												$passvalue= $customers['customer_password']; 
											else
											$passvalue="";
									?>
									<div class="col-12 col-md-9">
										<input type="password"  name="customerpassword" placeholder="Enter Password" class="form-control" value="<?php echo $passvalue;?>">
										<small class="help-block form-text">Enter Password of customer </small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="text-input" class="form-control-label">Customer Address:</label>
									</div>
									<?php
											if(isset($_GET['ide'])) 
												$addresvalue= $customers['address']; 
											else
											$addresvalue="";
									?>
									<div class="col-12 col-md-9">
										<input type="text"  name="customeraddress" class="form-control" value="<?php echo $addresvalue; ?>">
										<small class="form-text text-muted">Enter address Of customer.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Customer phone:</label>
									</div>
									<?php
											if(isset($_GET['ide'])) 
												$mobilevalue= $customers['mobile']; 
											else
											$mobilevalue="";
									?>
									<div class="col-12 col-md-9">
										<input type="number"  name="customerphone" placeholder="Enter phone" class="form-control" value="<?php echo $mobilevalue; ?>">
										<small class="help-block form-text">Enter phone Of customer.</small>
									</div>
								</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label  class=" form-control-label">Last Login:</label>
									</div>
									<?php
											if(isset($_GET['ide'])) 
												$lastvalue= $customers['last_login']; 
											else
											$lastvalue="";
									?>
									<div class="col-12 col-md-9">
										<input type="date"  name="lastlogin"  class="form-control" value="<?php echo $lastvalue;?>">
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
							       <button type="submit" class="btn btn-primary btn-sm" name="submit" style="
									<?php
									if(isset($_GET['ide'])) echo 'display:none;';
									else echo "display: block;";
									?>
									">
										<i class="fa fa-dot-circle-o" ></i> Add
									</button>
									<button type="submit" class="btn btn-primary btn-sm" name="update" style="
									<?php 
									if(isset($_GET['ide'])) echo 'display:block;';
									else echo "display: none;";
									?>

									">
										<i class="fa fa-dot-circle-o" ></i> Update
									</button>
						</div>
							</form>
						</div>
						
					</div>

				</div>
			</div>
			<!-- Add Product-->
			<!-- View Product-->
			<!-- Table-->
			<div class="row">
				<div class="col-md-12">
					<!-- DATA TABLE -->
					<h3 class="title-5 m-b-35">View customer</h3>
						<div class="table-responsive table-responsive-data2">
							<table class="table table-data2">
								<thead>
									<tr>
										<th ></th>
										<th style="padding: 10px;">Number</th>
										<th style="padding: 10px;">Name</th>
										<th style="padding: 10px;">email</th>
										<th style="padding: 10px;">mobile</th>
										<th style="padding: 10px;">address</th>
										<th style="padding: 10px;">Images</th>
										<th style="padding: 10px;">Last Login</th>
										<th style="padding: 10px;"></th>
									</tr>
								</thead>
								<tbody>
	<?php
	$query="SELECT * FROM customers";
	if(mysqli_query($conn,$query)){
		$result=mysqli_query($conn,$query);
		while($customers=mysqli_fetch_assoc($result))
		{

?>
									<tr class="tr-shadow">
										<td  style="padding: 10px;">
											<label class="au-checkbox" style="top:20px;">
												<input type="checkbox">
												<span class="au-checkmark"></span>
											</label>
										</td>
										<td  style="padding: 10px;"><?php echo $customers['customer_id'];?></td>
										<td  style="padding: 10px;"><?php echo $customers['customer_name'];?></td>
										<td  style="padding: 10px;"><?php echo $customers['customer_email'];?></td>
										<td  style="padding: 10px;"><?php echo $customers['mobile'];?></td>
										<td  style="padding: 10px;"><?php echo $customers['address'];?></td>
										<td style="padding: 10px;"><img
										 src="images/customers/<?php echo $customers['customer_image'];?>" 
										 class="w-100 img-fluid rounded" style="width:100px; height:75px;"></td>
										<td style="padding: 10px;"><?php echo $customers['last_login'];?></td>
										<td  style="padding:10px;">
											<div class="table-data-feature">
												
												<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
													<a href="manage_customers.php?ide=<?php echo $customers['customer_id'];?>"><i class="zmdi zmdi-edit"></i></a>
												</button>
												<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
													<a href="manage_customers.php?idd=<?php echo $customers['customer_id'];?>"><i class="zmdi zmdi-delete"></i></a>
												</button>
												
											</div>
										</td>
									</tr>
				<?php
		}//admin data
	}// if query

	?>	
									</tbody>
								</table>
							</div>
							<!-- END DATA TABLE -->
						</div>
					</div>
					<!--Table -->					
					<!-- View Product-->
				</div>
			</div>
		</div>
		<?php include_once('include/admin_footer.php'); ?>
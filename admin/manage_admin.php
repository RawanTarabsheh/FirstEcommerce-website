<?php ob_start();?>
<?php include_once ('include/admin_header.php'); ?>
<?php require      ('include/connection.php'); ?>
<!-- MAIN CONTENT-->
<div class="main-content">
	<?php
	if(isset($_POST['submit']))	{
		$adminName       =$_POST['name'];
		$adminEmail      =$_POST['email'];
		$adminPassword   =md5($_POST['password']);

		$query="INSERT INTO admin (admin_email,admin_password,admin_fullname)
				VALUES  ('$adminEmail','$adminPassword','$adminName')";

		if(mysqli_query($conn,$query)){
			header("Location:manage_admin.php");
		}// if for query
		else
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}//if for submit

		if(isset($_GET['idd'])){
		$id=$_GET['idd'];
	    $query="DELETE FROM admin WHERE admin_id={$id}";
	    if(mysqli_query($conn,$query))	 {
	 	header("Location:manage_admin.php");
	 }
	 }//delete



	 if(isset($_GET['ide'])){

	 	$id=$_GET['ide'];
	 	$query1="SELECT * FROM admin WHERE admin_id={$id}";
	 	if(mysqli_query($conn,$query1))
	 	{
	 		$result=mysqli_query($conn,$query1);
	 		$admin=mysqli_fetch_assoc($result);
	 	}
	 	
	 	if(isset($_POST['update'])){
	    $adminName       =$_POST['name'];
		$adminEmail      =$_POST['email'];
		$adminPassword   =md5($_POST['password']);

		$query="UPDATE admin SET admin_email    ='$adminEmail',
							     admin_password ='$adminPassword',
							     admin_fullname ='$adminName'
				WHERE admin_id={$id}	";

		if(mysqli_query($conn,$query)){
			header("Location:manage_admin.php");
		}// if for query
		else
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
}//update
	}//edit
	?>
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<?php
								if(isset($_GET['ide'])) 
									$type= "Update"; 
								else
									$type="Add";
								?>
							<div class="card-header"><?php  echo $type; ?> Admin</div>
							<div class="card-body card-block">
								<form action="" method="post" class="">
									<div class="form-group">
										<div class="input-group">

											<div class="input-group-addon">AdminName</div>
											<?php
											if(isset($_GET['ide'])) 
												$value= $admin['admin_fullname']; 
											else
											$value="";
											?>
											<input type="text" id="username3" name="name" class="form-control" value="<?php echo $value; ?>">
											<div class="input-group-addon">
												<i class="fa fa-user"></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">Email</div>
											<?php
											if(isset($_GET['ide'])) 
												$emailvalue= $admin['admin_email']; 
											else
											$emailvalue="";
											?>
											<input type="email" id="email3" name="email" class="form-control" value="<?php echo $emailvalue;?>">
											<div class="input-group-addon">
												<i class="fa fa-envelope"></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">Password</div>
											<?php
											if(isset($_GET['ide'])) 
												$passvalue= $admin['admin_password']; 
											else
											$passvalue="";
											?>
											<input type="password" id="password3" name="password" class="form-control" value="<?php echo $passvalue; ?>">
											<div class="input-group-addon">
												<i class="fa fa-asterisk"></i>
											</div>
										</div>
									</div>
									<div class="form-actions form-group">
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
				</div><!-- form -->
				<!-- Table-->
				<div class="row mt-5">
					<div class="col-md-12">
						<!-- DATA TABLE -->
						<h3 class="title-5 m-b-35">View Admin</h3>
						<div class="table-data__tool">
							<div class="table-responsive table-responsive-data2">
								<table class="table table-data2">
									<thead>
										<tr>
											<th>Number</th>
											<th>name</th>
											<th>email</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
	<?php
	    $query="SELECT * FROM admin";
	if(mysqli_query($conn,$query)){
		$result    =mysqli_query($conn,$query);
		$autonumber=0;
	    while($admin=mysqli_fetch_assoc($result)){
	    $autonumber+=1;	

    ?>

										<tr class="tr-shadow">
											<td><?php echo $autonumber;?></td>

											<td><?php echo $admin['admin_fullname'];?></td>
											<td>
												<span class="block-email"><?php echo $admin['admin_email'];?></span>
											</td>
											<td>
										<div class="table-data-feature">
											<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
											<a href="manage_admin.php?ide=<?php {echo $admin['admin_id'];} ?>">
												<i class="zmdi zmdi-edit"></i>
											</a>	
											</button>
											<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
												<a href="manage_admin.php?idd=<?php {echo $admin['admin_id'];}?>">
													<i class="zmdi zmdi-delete"></i>
												</a>
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
				</div>
			</div>
		</div>
		<?php include_once('include/admin_footer.php'); ?>
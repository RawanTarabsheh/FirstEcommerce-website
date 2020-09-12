<?php ob_start();?>
<?php include_once ('include/admin_header.php'); ?>
<?php require      ('include/connection.php'); ?>


<!-- MAIN CONTENT-->
<div class="main-content">
	<?php
	    $id=$_GET['id'];
		if(isset($_GET['id']))
		{
			
			$query="SELECT * FROM admin WHERE admin_id={$id}";
			if(mysqli_query($conn,$query)){
				$result=mysqli_query($conn,$query);
				$admin=mysqli_fetch_assoc($result);
			}
		}
	if(isset($_POST['submit']))	{
		$adminName       =$_POST['name'];
		$adminEmail      =$_POST['email'];
		$adminPassword   =$_POST['password'];

		$query="UPDATE admin SET admin_email    ='$adminEmail',
							     admin_password ='$adminPassword',
							     admin_fullname ='$adminName'
				WHERE admin_id={$id}	";

		if(mysqli_query($conn,$query)){
			header("Location:manage_admin.php");
		}// if for query
		else
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}//if for submit
	?>
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">Update Admin</div>
							<div class="card-body card-block">
								<form action="" method="post" class="">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">AdminName</div>
											<input type="text" id="username3" name="name" class="form-control"value="<?php echo $admin['admin_fullname'];?>">
											<div class="input-group-addon">
												<i class="fa fa-user"></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">Email</div>
											<input type="email" id="email3" name="email" class="form-control"value="<?php echo $admin['admin_email'];?>">
											<div class="input-group-addon">
												<i class="fa fa-envelope"></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">Password</div>
											<input type="password" id="password3" name="password" class="form-control" value="<?php echo $admin['admin_password'];?>">
											<div class="input-group-addon">
												<i class="fa fa-asterisk"></i>
											</div>
										</div>
									</div>
									<div class="form-actions form-group">
										<button type="submit" class="btn btn-primary btn-sm" name="submit">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- form -->
			</div>
		</div>
		<?php include_once('include/admin_footer.php'); ?>
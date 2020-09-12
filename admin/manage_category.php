	<?php ob_start();
	include_once ('include/admin_header.php'); 
	require      ('include/connection.php'); 

	if(isset($_POST['submit'])){
		if(!isset($_POST['catname'])){
			echo '<script >
		          alert("Please Enter Category Name");
	              </script>';
		}
		else {
        $catName       =$_POST['catname'];
		//get file info
		if($_FILES['catimage']['error'] == 0) {
		$imagename     =$_FILES['catimage']['name'];
		$query1="INSERT INTO category (cat_name,cat_image)
		         VALUES ('$catName','$imagename')";
	    mysqli_query($conn,$query1) ;    
		$id            =mysqli_insert_id($conn);      
		$tmp_name      =$_FILES['catimage']['tmp_name'];
		$path          ="images/category/";
		$target_file   = $path . basename($_FILES["catimage"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$newnameimage  =$id.".".$imageFileType;
		//$newimage=time().$oldeimag;//another soulition
		//move files to images folder
		move_uploaded_file($tmp_name, $path.$newnameimage);
		 $query="UPDATE category SET cat_name ='$catName',
	 		                         cat_image='$newnameimage'
	 		     WHERE cat_id =$id";
		if(mysqli_query($conn,$query)){
			header("Location:manage_category.php");
		}
		else
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}//uploaded file
		else{
			echo '<script >
		          alert("Please Uploaded Category Image");
	              </script>';
		}
		
		}//category name empty
	}//add

	if(isset($_GET['idd'])){
		$id=$_GET['idd'];
		$query1="SELECT cat_image FROM category WHERE cat_id={$id}";
		$cat_image=mysqli_fetch_assoc(mysqli_query($conn,$query1));
		unlink('images/category/'.$cat_image['cat_image']);
		$query="DELETE FROM category WHERE cat_id={$id}";
		if(mysqli_query($conn,$query))
			header("Location:manage_category.php");
	 }//delete

	 if(isset($_GET['ide'])){

	 	$id=$_GET['ide'];
	 	$query="SELECT * FROM category WHERE cat_id={$id}";
	 	if(mysqli_query($conn,$query))
	 	{
	 		$result=mysqli_query($conn,$query);
	 		$category=mysqli_fetch_assoc($result);
	 	}
	 	
	 	if(isset($_POST['update'])){
	 		$newnameimage=$category['cat_image'];
	 		$catName       =$_POST['catname'];
		    if($_FILES['catimage']['error'] == 0) {
	    unlink('images/category/'.$category['cat_image']);
	    $tmp_name      = $_FILES['catimage']['tmp_name'];
		$path          ="images/category/";
		$target_file   = $path . basename($_FILES["catimage"]["name"]);
		$imageFileType = strtolower(pathinfo($tmp_name,PATHINFO_EXTENSION));
		$newnameimage  =$id.".".$imageFileType;
		move_uploaded_file($tmp_name, $path.$newnameimage);
	    }//uploaded file
	   
		
	 		$query2="UPDATE category SET cat_name='$catName',
	 		                             cat_image='$newnameimage'
	 		         WHERE cat_id=$id";
	 		if(mysqli_query($conn,$query2))
	 		{
		 header("Location:manage_category.php");
	 		}
}//update
	}//edit
	?>
	<!-- MAIN CONTENT-->
	
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="row">
					<!-- Add category-->
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<?php
								if(isset($_GET['ide'])) 
									$type= "Update"; 
								else
									$type="Add";
								?>
								<strong><?php echo $type;?></strong> Category
							</div>
							<div class="card-body card-block">
								<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
									<div class="row form-group">
										<div class="col col-md-3">
											<label  class=" form-control-label">Category Name:</label>
										</div>
										<div class="col-12 col-md-9">
											<?php
											if(isset($_GET['ide'])) 
												$value= $category['cat_name']; 
											else
											$value="";
											?>
											<input type="text"  name="catname" value="<?php echo $value;?>"  class="form-control">
											<span class="help-block">Please add new category</span>
										</div>
									</div>
								<div class="row form-group">
									<div class="col col-md-3">
										<label for="file-input" class=" form-control-label">Insert image</label>
									</div>
									<div class="col-12 col-md-9">
										<?php if(isset($_GET['ide'])){ ?>
										<img src="images/category/<?php echo $category['cat_image'] ;?>" style="width: 200px; height: 150px;" >
									    <?php } ?>
										<input type="file" id="file-input" name="catimage" class="form-control-file">
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
	<!-- Add category-->
	<!-- Table-->
	<div class="row mt-5">
		<div class="col-md-12">
			<!-- DATA TABLE -->
			<h3 class="title-5 m-b-35">View Category</h3>
			<div class="table-responsive table-responsive-data2">
				<table class="table table-data2">
					<thead>
						<tr>
							<th></th>
							<th>Number</th>
							<th>Name</th>
							<th></th>
							<th>Image</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
	<?php
    	$query="SELECT * FROM category";
		if(mysqli_query($conn,$query)){
		$result     =mysqli_query($conn,$query);
		$autonumber = 0;
		while($category=mysqli_fetch_assoc($result)){
			$autonumber+=1;
	?>

								<tr class="tr-shadow">
									<td></td>
									<td ><?php echo $autonumber;?></td>
									<td><?php echo $category['cat_name'];?></td>
									<td></td>
									<td style="padding-right: 0px;"><img src="images/category/<?php echo $category['cat_image'];?>"  class="w-25  img-fluid rounded" style="width:  75px; height: 75px;"></td>
									<td>
										<div class="table-data-feature">
											<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
											<a href="manage_category.php?ide=<?php {echo $category['cat_id'];} ?>">
												<i class="zmdi zmdi-edit"></i>
											</a>	
											</button>
											<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
												<a href="manage_category.php?idd=<?php {echo $category['cat_id'];}?>">
													<i class="zmdi zmdi-delete"></i>
												</a>
											</button>
										</div>

									</td>
									<td></td>
									<td></td>
								</tr>
	<?php
			}//end while

		}// end if query
	?>		
	</tbody>
</table>
</div>
<!-- END DATA TABLE -->
</div>
</div>
<!--Table -->
<!-- View category-->
</div>
</div>
</div>
<?php include_once('include/admin_footer.php'); ?>
	<?php ob_start();
	include_once ('include/admin_header.php'); 
	require      ('include/allclassPDO.php');
	require      ('include/database.php');
// get database connection
    $database = new Database();
    $db       = $database->getConnection();
   
// pass connection to category objects
    $category  = new Category($db);
	if(isset($_POST['submit'])){
		if(!isset($_POST['catname'])){
			echo '<script >
		          alert("Please Enter Category Name");
	              </script>';
		}
		else {
        $category->name  =$_POST['catname'];
		//get file info
		if($_FILES['catimage']['error'] == 0) {
		$category->image =$_FILES['catimage']['name'];
		$category->create();
	if($category->create()){
        $id               =$db->lastInsertId();     
		$tmp_name         =$_FILES['catimage']['tmp_name'];
		$path             ="images/category/";
		$target_file      = $path . basename($_FILES["catimage"]["name"]);
		$imageFileType    = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$category->image  =$id.".".$imageFileType;
		//$newimage=time().$oldeimag;//another soulition
		//move files to images folder
		move_uploaded_file($tmp_name, $path.$newnameimage);
		if($category->update()){
       header("Location:manage_categoryPDOclass.php");
              }  //update  
          }//crete 
		
		}//uploaded file

		else{
			echo '<script >
		          alert("Please Uploaded Category Image");
	              </script>';
		}
		
		}//category name empty
	}//add

	if(isset($_GET['idd'])){
		$category->id=$_GET['idd'];
		$category->readcatbyid();
		$cat_image=$category->image;
		unlink('images/category/'.$cat_image);
		$category->id=$_GET['idd'];
		if($category->delete()){
       header("Location:manage_categoryPDOclass.php");
    }
	 }//delete

	 if(isset($_GET['ide'])){

	 	$category->id=$_GET['ide'];
	 	$category->readcatbyid();
	 	
	 	
	 	if(isset($_POST['update'])){
	 		$newnameimage   =$category->image;
	 		$category->name =$_POST['catname'];
		    if($_FILES['catimage']['error'] == 0) {
	    unlink('images/category/'.$category['cat_image']);
	    $tmp_name      = $_FILES['catimage']['tmp_name'];
		$path          ="images/category/";
		$target_file   = $path . basename($_FILES["catimage"]["name"]);
		$imageFileType = strtolower(pathinfo($tmp_name,PATHINFO_EXTENSION));
		$newnameimage  =$category->id.".".$imageFileType;
		move_uploaded_file($tmp_name, $path.$newnameimage);
	    }//uploaded file
	   if($category->update()){
       header("Location:manage_categoryPDOclass.php");
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
												$value= $category->name; 
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
										<img src="images/category/<?php echo $category->image;?>" style="width: 200px; height: 150px;" >
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
	    $stmt       = $category->read();
	    $autonumber = 0;
	     while ($categoryrow = $stmt->fetch(PDO::FETCH_ASSOC)){
	     	//print_r($categoryrow);
        extract($categoryrow);
			$autonumber+=1;
	?>

								<tr class="tr-shadow">
									<td></td>
									<td ><?php echo $autonumber;?></td>
									<td><?php echo $cat_name;?></td>
									<td></td>
									<td style="padding-right: 0px;"><img src="images/category/<?php echo $cat_image;?>"  class="w-25  img-fluid rounded" style="width:  75px; height: 75px;"></td>
									<td>
										<div class="table-data-feature">
											<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
											<a href="manage_category.php?ide=<?php {echo $cat_id;} ?>">
												<i class="zmdi zmdi-edit"></i>
											</a>	
											</button>
											<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
												<a href="manage_category.php?idd=<?php {echo $cat_id;}?>">
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
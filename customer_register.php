<?php ob_start();
include_once("include/header.php");
      require ('include/connection.php'); 
?>

	<?php
	if(isset($_POST['submit']))
	{
		if($_FILES['customer_image']['error']==0){
		$customerName      =$_POST['customername'];
		$customerEmail     =$_POST['customeremail'];
		$customerPassword  =md5($_POST['customerpassword']);
		$customerMobile    =$_POST['customerphone'];
		$customerAddress   =$_POST['customeraddress'];
		$lastLogin         = date("Y-m-d");
		$imageName		   =$_FILES['customer_image']['name'];
		$query1="INSERT INTO customers (customer_name,customer_email,customer_password,customer_image ,
		                    mobile,address,last_login)
		                    VALUES 
		                    ('$customerName','$customerEmail','$customerPassword','$imageName',
		                    '$customerMobile','$customerAddress','$lastLogin') ";
	    mysqli_query($conn,$query1) ;    
		$id            =mysqli_insert_id($conn);      
		$tmp_name      =$_FILES['customer_image']['tmp_name'];
		$path          ="admin/images/customers/";
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
					//$_SESSION['customer_id']=$id;
					header("Location:login.php");
		        }// if for query
		       else
			        echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}
		else{
			$error="Try agin Something missing";
		}	
	}//end if submit
	?>
	 <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
        <!-- ##### Checkout Area Start ##### -->

<div class="checkout_area section-padding-80">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-page-heading mb-30">
                            <h5>Registration</h5>
                        </div>
							<?php
                        	if(isset($error))
                        	{
                        		echo '<div class="alert alert-danger">'.$error.'</div>';
                        	}
                        	?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="name">Your Name <span>*</span></label>
                                    <input type="text" class="form-control" id="name" value="" name="customername" required>
                                </div>
                   
                                <div class="col-12 mb-3">
                                    <label for="street_address">Your Address <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" value="" name="customeraddress" required>
                                </div>
                               
                                <div class="col-12 mb-3">
                                    <label for="customerphone">Phone No <span>*</span></label>
                                    <input type="number" class="form-control" id="customerphone" min="0" name="customerphone" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="email_address" value="" name="customeremail" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="customerpassword">Your Password <span>*</span></label>
                                    <input type="password" class="form-control" id="customerpassword" min="0" name="customerpassword" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="customer_image">Your Picture <span>*</span></label>
                                    <input type="file" class="d-block" id="customer_image" min="0" name="customer_image" required>
                                </div>
                                <button class="btn essence-btn" name="submit">Register</button>
                            </div>
                        </form>
                    </div>
			</div>

		
		</div>
	</div>
</div>
<?php include_once("include/footer.php"); ?>
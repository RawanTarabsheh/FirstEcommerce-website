<?php ob_start();
include_once("include/header.php");
require ('include/connection.php'); 
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

<div class="checkout_area section-padding-80">
	<div class="container">
		<div class="row">
				<div class="col-12 col-md-6 col-lg-6 ">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>
                       <form action="" method="post" enctype="multipart/form-data">
                        <ul class="order-details-form mb-4">
                            <li><span>Product</span><span>Quantity</span>  <span>Total</span></li>
                            <?php
                            $tota          =0;
                            $order_date    =date("Y-m-d");
                            $custmer_id    =$_SESSION['id'];
                            if(isset($_SESSION['shopping_cart']))
                            $product_count = count($_SESSION["shopping_cart"]);
                        else                                                 
                            $product_count =0;

                            $newarray=array();
                             if(isset($_SESSION['shopping_cart'])){
                                foreach ($_SESSION["shopping_cart"] as $key => $productsid) {
                                $newarray[]= $productsid;
                                   }//foreach
                               }
                    
                             $c=array_count_values($newarray);
                             foreach ($c as $pid => $qty) {
   								$query="SELECT * FROM products WHERE product_id={$pid}";
   								$result=mysqli_fetch_assoc(mysqli_query($conn,$query));
   								$subtotal=$result['product_price']*$qty;
   								$total=$total+($result['product_price']*$qty);
   								 if(isset($_POST['submit'])) {
                    	       $query="INSERT INTO orders (order_date,customer_id,product_id,qty,total) 
                    					VALUES ('$order_date','$custmer_id','$pid','$qty','$subtotal')";
                    	       mysqli_query($conn,$query);
                                           }   
                            	?>
                            <li><span><?php echo $result['product_name'];?></span><span><?php echo $qty;?></span> <span><?php echo $result['product_price'];?></span></li>
                        <?php
                        } 
                        if(isset($_POST['submit'])) {
                          $final_insert="INSERT INTO order_number (customer_id,order_date,product_count)
                                            VALUES ('$custmer_id',$order_date,'$product_count')";
                             if(mysqli_query($conn,$final_insert))         
                            $orderid   =mysqli_insert_id($conn); 
                             $message= "Thank You order number is:".$orderid;
                             unset($_SESSION['shopping_cart']);
                            // header("Location:index.php");
                         }
                        ?>
                           
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total</span> <span><?php echo $total;?></span></li>
                        </ul>
                     
                        <div id="accordion" role="tablist" class="mb-4">
                           <!-- <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Paypal</a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
                                    </div>
                                </div>
                            </div>-->
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-circle-o mr-3"></i>cash on delievery</a>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos.</p>
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-circle-o mr-3"></i>credit card</a>
                                    </h6>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingFour">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fa fa-circle-o mr-3"></i>direct bank transfer</a>
                                    </h6>
                                </div>
                                <div id="collapseFour" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est cum autem eveniet saepe fugit, impedit magni.</p>
                                    </div>
                                </div>
                            </div>-->
                        </div>

                        <button class="btn essence-btn" name="submit">Place Order</button>
                    </form>
                    <?php

                        	if(isset($message))
                        	{
                        		echo '<div class="alert alert-danger">'.$message.'</div>';
                        	}
                        	?>
                    </div>
                </div>
		</div>
	</div>
</div>
<?php include_once("include/footer.php"); ?>
<?php include_once("include/header.php");
      require ('include/connection.php'); 
      $pro_id=$_GET['id'];
$query="SELECT * FROM products WHERE product_id={$pro_id}";
$product=mysqli_fetch_assoc(mysqli_query($conn,$query));

?>
   <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="admin/images/products/<?php echo $product['product_image'];?>" alt="">
                <img src="img/product-img/product-big-2.jpg" alt="">
                <img src="img/product-img/product-big-3.jpg" alt="">
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>mango</span>
            <a href="cart.html">
                <h2><?php echo $product['product_name'];?></h2>
            </a>
           
            <?php
            if($product['product_special_price']!== 0)
            {
            	$newprice=$product['product_special_price'];
            	echo '<p class="product-price"><span class="old-price">'.$product['product_price'].'</span>'.'$'.$newprice.'</p>';
            }
            else 
            {
            	$newprice="";
            	echo ' <p class="product-price">' . '$'.$product['product_price'].'</p>';
            }
            ?>
            <p class="product-desc"><?php echo $product['product_desc']; ?></p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                   
                    <a href="addcart.php?id=<?php echo $product['product_id']; ?>" name="addtocart" value="5" class="btn essence-btn">Add to cart</a>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

<?php include_once("include/footer.php"); ?>
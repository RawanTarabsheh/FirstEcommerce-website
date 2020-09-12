<?php include_once("include/header.php");
      require ('include/connection.php'); 
?>

    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>asoss</h6>
                        <h2 class="slideUp">New Collection</h2>
                        <a href="#" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                $query="SELECT * FROM category";
                $result=mysqli_query($conn,$query);
                while($category=mysqli_fetch_assoc($result)){
                    $catimage=$category['cat_image'];


                ?>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(admin/images/category/<?php echo $catimage; ?>);">
                        <div class="catagory-content">
                            <a href="shop.php?id=<?php echo $category['cat_id']; ?>&name=<?php echo $category['cat_name']; ?>"><?php echo $category['cat_name']; ?></a>
                        </div>
                    </div>
                </div>

<?php } ?>
              
             
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="#" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

                       
<?php 
$query="SELECT * FROM products ORDER BY product_id DESC LIMIT 0,5  ";
$result=mysqli_query($conn,$query);
    while ($products=mysqli_fetch_assoc($result)) {
            
      

?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                               <img src="admin/images/products/<?php echo $products['product_image'];?>" alt="" style="width: 300px; height: 345px;">
                               <!-- Hover Thumb -->
                               <img class="hover-img" src="admin/images/products/<?php echo $products['product_image'];?>" alt="" style="width: 300px; height: 345px;">

                               <!-- Product Badge -->
                                <div class="product-badge offer-badge">
                                    <span>-30%</span>
                                </div>

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>Top Shop</span>
                               
                                   <a href="single-product-details.php?id=<?php echo $products['product_id']; ?>">
                                            <h6><?php echo $products['product_name'];?></h6>
                                    </a>
                                    <p class="product-price"><span class="old-price">$75.00</span> $55.00</p>
                                     <?php
                                        if($products['product_special_price']!== 0)
                                        {
                                            $newprice=$products['product_special_price'];
                                            echo '<p class="product-price"><span class="old-price">'.$products['product_price'].'</span>'.'$'.$newprice.'</p>';
                                        }
                                        else 
                                        {
                                            $newprice="";
                                            echo ' <p class="product-price">' . '$'.$products['product_price'].'</p>';
                                        }
                                        ?>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                         <a href="addcart.php?id=<?php echo $products['product_id']; ?>" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php } ?>
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand1.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand2.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand3.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand4.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand5.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand6.png" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->
<?php include_once("include/footer.php"); ?>
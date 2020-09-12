<?php 
ob_start();
session_start();
      require ('include/connection.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Template</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/animaterawan.css">
    <link rel="stylesheet" href="style.css">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="#">Shop</a>
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Women's Collection</li>
                                        <li><a href="shop.html">Dresses</a></li>
                                        <li><a href="shop.html">Blouses &amp; Shirts</a></li>
                                        <li><a href="shop.html">T-shirts</a></li>
                                        <li><a href="shop.html">Rompers</a></li>
                                        <li><a href="shop.html">Bras &amp; Panties</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Men's Collection</li>
                                        <li><a href="shop.html">T-Shirts</a></li>
                                        <li><a href="shop.html">Polo</a></li>
                                        <li><a href="shop.html">Shirts</a></li>
                                        <li><a href="shop.html">Jackets</a></li>
                                        <li><a href="shop.html">Trench</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Kid's Collection</li>
                                        <li><a href="shop.html">Dresses</a></li>
                                        <li><a href="shop.html">Shirts</a></li>
                                        <li><a href="shop.html">T-shirts</a></li>
                                        <li><a href="shop.html">Jackets</a></li>
                                        <li><a href="shop.html">Trench</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="img/bg-img/bg-6.jpg" alt="">
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop.php">Shop</a></li>
                                    <li><a href="single-product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single-blog.html">Single Blog</a></li>
                                    <li><a href="regular-page.html">Regular Page</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="#" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="#"><img src="img/core-img/heart.svg" alt=""></a>
                </div>
                <!-- User Login Info -->
                <div class="user-login-info">
                    <?php
                    if(isset($_SESSION['id'])){
                        $value="Sign out";
                        $link="logout.php";
                    }
                    else{
                        $value="Sign in";
                        $link="login.php";
                    }
                    ?>
                    <a href="<?php echo $link;?>"><img src="img/core-img/user.svg" alt=""><?php echo $value; ?></a>
                </div>
                <?php
if(!empty($_SESSION["shopping_cart"])) 
$cart_count = count($_SESSION["shopping_cart"]);
else
$cart_count=0;

?>
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""> <span><?php echo $cart_count; ?></span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span><?php echo $cart_count; ?></span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <?php
                $total=0;
           
                if(!empty($_SESSION["shopping_cart"])) {
                    foreach ($_SESSION["shopping_cart"] as $key => $product) {
                    $query    ="SELECT * FROM products WHERE product_id={$product}";                   
                    $productcart  =mysqli_fetch_assoc(mysqli_query($conn,$query));
                    $total=$total+$productcart['product_price'];
                 ?>
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="addcart.php?idd=<?php echo $key; ?>" class="product-image">
                        <img src="admin/images/products/<?php echo $productcart['product_image']; ?>" class="cart-thumb" alt="" style="height: 150px;">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove" ><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6><?php echo $productcart['product_name'];?></h6>
                            <p class="price"><?php echo $productcart['product_price'];?></p>
                        </div>
                    </a>
                </div>
<?php }}

?>
             
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                   <!-- <li><span>subtotal:</span> <span><?php // echo $total;?></span></li>
                    <li><span>discount:</span> <span>-15%</span></li>-->
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>total:</span> <span><?php echo $total;?></span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <?php 
                    if(isset($_SESSION['id']))
                        $href="checkout.php?id=".$_SESSION['id'];
                    else
                       $href="customer_register.php";  
                    ?>
                    <a href="<?php echo $href; ?>" class="btn essence-btn">check out</a>
                </div>
            </div>

        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->
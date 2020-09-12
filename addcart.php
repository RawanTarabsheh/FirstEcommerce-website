<?php ob_start();
session_start();
require ('include/connection.php'); 
//old code
/*$pro_id   =$_GET['id'];
$query    ="SELECT * FROM products WHERE product_id={$pro_id}";
$product  =mysqli_fetch_assoc(mysqli_query($conn,$query));
$name     = $product['product_name'];
$id       = $product['product_id'];
$price    = $product['product_price'];
$image    = $product['product_image'];
 

$cartArray = array(
 $id=>array(
 'name'=>$name,
 'id'=>$id,
 'price'=>$price,
 'quantity'=>1,
 'image'=>$image)
);
if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = array();
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($id,$array_keys)) {
 $status = "<div class='box' style='color:red;'>
 Product is already added to your cart!</div>"; 
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
 }
 
 }*/

//new anas try
 if(isset($_GET['id']))
{
    $pro_id   =$_GET['id'];
 if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = array();
} 
array_push($_SESSION['shopping_cart'],$pro_id); 
//header("Location:index.php");
header('Location: ' . $_SERVER['HTTP_REFERER']);
}//get is set




if(isset($_GET['idd']))
{
    $id=$_GET['idd'];
    echo $id;
    unset($_SESSION["shopping_cart"][$id]);
   // header("Location:index.php");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 


?>
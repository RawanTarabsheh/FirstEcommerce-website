
  <!DOCTYPE html>
<html>
<head>
<title>Font Awesome Icons</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!--Get your own code at fontawesome.com-->
</head>
<body>

<p>Some Font Awesome icons:</p>
<i class="fas fa-band-aid" style="color: red"></i>
<i class="fas fa-cat"></i>
<i class="fas fa-dragon"></i>
<i class="far fa-clock"></i>
<i class="fas fa-clock"></i>

<p>Styled Font Awesome icons (size, color, and shadow):</p>
<i class="fas fa-clock" style="font-size:24px;"></i>
<i class="fas fa-clock" style="font-size:36px;"></i>
<i class="fas fa-clock" style="font-size:48px;color:red;"></i>
<i class="fas fa-clock" style="font-size:60px;color:lightblue;text-shadow:2px 2px 4px #000000;"></i>
	<?php //ob_start();
	//include_once ('include/admin_header.php'); 
	require      ('include/allclassPDO.php');
	require      ('include/database.php');
// get database connection
    $database = new Database();
    $db       = $database->getConnection();
   
// pass connection to product objects
    $category  = new Category($db);
    $category->id=26;
    $category->readcatbyid();
    echo $category->id;
    echo "<br>";

        echo $category->name;
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page = 5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
  // query products
$stmt = $category->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
if($num>0){
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>category</th>";
            echo "<th>image</th>";
            echo "<th>id</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$cat_name}</td>";
                echo "<td>{$cat_image}</td>";
                echo "<td>{$cat_id}</td>";
            echo "</tr>";
  
        }
  
    echo "</table>";
  
    // paging buttons will be here
    // the page where this paging is used
$page_url = "testoop.php?";
  
// count all products in the database to calculate total pages
$total_rows = $category->countAll();
  
// paging buttons here
include_once 'paging.php';
}
  
// tell the user there are no products
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}
// retrieve records here
  //  $stmt=$category->read();
   //  while ($categoryrow = $stmt->fetch(PDO::FETCH_ASSOC)){
    //   extract($categoryrow);
       // echo $cat_image;
    //}

   $category->name="ooptest";
    $category->image="1.png";
      if($category->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
   /*$category->name="o8888optest";
    $category->image="18888.png";
    $category->id=33;
      if($category->update()){
        echo "<div class='alert alert-success'>Product was created.</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }*/

       // $category->id=33;
  //if($category->delete()){
        //echo "<div class='alert alert-success'>Product was delete.</div>";
    //}
  
    // if unable to create the product, tell the user
   // else{
        //echo "<div class='alert alert-danger'>Unable to delete product.</div>";
   // }?>

   <?php
// check if value was posted
if($_POST){
  
    // include database and object file
  //  include_once 'config/database.php';
  //  include_once 'objects/product.php';
  
    // get database connection
 //   $database = new Database();
   // $db = $database->getConnection();
  
    // prepare product object
    //$catogry = new Category($db);
      
    // set product id to be deleted
    $category->id = $_POST['object_id'];
      
    // delete the product
    if($category->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>

<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
  
    var id = $(this).attr('delete-id');
  
    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
  
            if(result==true){
                $.post('testoop.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });
  
    return false;
});
</script>
</body>
</html>

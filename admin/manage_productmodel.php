 <?php  ob_start();
 include_once ('include/admin_header.php'); 
 require      ('include/connection.php'); 
 ?>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".open", function() {
        //var myBookId = $(this).data('catid');
        var myproid = this.getAttribute('data-proid');
        var myproName = this.getAttribute('data-proName');
         var myprodes = this.getAttribute('data-prodes');
          var mycatid = this.getAttribute('data-catid');
        var myproprice = this.getAttribute('data-proprice');
        var myspprice = this.getAttribute('data-spprice');
        var myimage = this.getAttribute('data-image');
        //console.log(myCatName);
        //console.log(typeof(myCatName));
        //console.log(this.getAttribute('data-catName'));
        $('input[name=pro_id]').val(myproid);
        $('input[name=proname1]').val(myproName);
        $('textarea[name=prodes1]').val(myprodes);
        $('select[name=catid1]').val(mycatid);
        $('input[name=proprice1]').val(myproprice);
        $('input[name=special_price1]').val(myspprice);
        $('img[name=proimg]').attr("src",'images/products/'+myimage);
        console.log(myproid);
        // As pointed out in comments, 
        // it is unnecessary to have to manually call the modal.
        $('#largeModal1').modal('show');
    });
</script>
<!-- MAIN CONTENT-->
<div class="main-content">
 <?php
  if(isset($_POST['submit']))
 {
  $productName  = $_POST['proname'];
  $productPrice = $_POST['proprice'];
  $productDesc  = $_POST['prodes'];
  $Categoryid   = $_POST['catid'];
  $special_price= $_POST['special_price']; 
  //get file info
  if($_FILES['product_image']['error'] == 0){
  $imagename     =$_FILES['product_image']['name'];
  $query1="INSERT INTO products (product_name,product_image,product_price,product_desc,product_special_price,cat_id)
          VALUES ('$productName','$imagename','$productPrice','$productDesc','$special_price','$Categoryid')";
     mysqli_query($conn,$query1) ;    
  $id            =mysqli_insert_id($conn);      
  $tmp_name      =$_FILES['product_image']['tmp_name'];
  $path          ="images/products/";
  $target_file   = $path . basename($_FILES["product_image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $newnameimage  =$id.".".$imageFileType;

  //move files to images folder
  move_uploaded_file($tmp_name, $path.$newnameimage);
  $query="UPDATE products SET product_name          ='$productName',
               product_image         ='$newnameimage',
               product_price         ='$productPrice',
               product_desc          ='$productDesc',
               product_special_price ='$special_price', 
               cat_id                ='$Categoryid'
    WHERE product_id={$id} ";
    if(mysqli_query($conn,$query))
    {
     header("Location:manage_product.php");
          }// if for query
         else
           echo "Error: " . $query . "<br>" . mysqli_error($conn);
  
  }//uploaded file
  else
  {
    echo '<script >
            alert("Please Uploaded Product Image");
               </script>';
  }
  
 }//end submit add

 if(isset($_GET['idd'])){
  $id=$_GET['idd'];
  $query1="SELECT product_image FROM products WHERE product_id={$id}";
  $product_image=mysqli_fetch_assoc(mysqli_query($conn,$query1));
  $query="DELETE FROM products WHERE product_id={$id}";
  if(mysqli_query($conn,$query))  {
   unlink('images/products/'.$product_image['product_image']);
   header("Location:manage_product.php");
  }
  }//delete
   if(isset($_GET['ide'])){

   $id=$_GET['ide'];
   $query="SELECT * FROM products WHERE product_id={$id}";
   if(mysqli_query($conn,$query)){
    $result=mysqli_query($conn,$query);
    $products=mysqli_fetch_assoc($result);
   }
   
   if(isset($_POST['update'])){
    $newnameimage=$products['product_image'];
  if($_FILES['product_image']['error']==0){
    unlink('images/products/'.$products['product_image']);
    $tmp_name      = $_FILES['product_image']['tmp_name'];
    $path          ="images/products/";
    $target_file   = $path . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $newnameimage  =$id.".".$imageFileType;
    move_uploaded_file($tmp_name, $path.$newnameimage);
  }// uploded new file
          $productName   = $_POST['proname'];
    $productPrice  = $_POST['proprice'];
    $productDesc   = $_POST['prodes'];
    $Categoryid    = $_POST['catid'];
    $special_price = $_POST['special_price']; 

    $query="UPDATE products SET product_name          ='$productName',
                 product_image         ='$newnameimage',
                 product_price         ='$productPrice',
                 product_desc          ='$productDesc',
                 product_special_price ='$special_price', 
                 cat_id                ='$Categoryid'
    WHERE product_id={$id} ";
    if(mysqli_query($conn,$query)){
     header("Location:manage_product.php");
          }// if for query
         else
           echo "Error: " . $query . "<br>" . mysqli_error($conn);
}//update
 }//edit

if(isset($_POST['submit1']))
{
 
    $newnameimage=$products['product_image'];
  if($_FILES['product_image']['error']==0){
    unlink('images/products/'.$products['product_image']);
    $tmp_name      = $_FILES['product_image']['tmp_name'];
    $path          ="images/products/";
    $target_file   = $path . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $newnameimage  =$id.".".$imageFileType;
    move_uploaded_file($tmp_name, $path.$newnameimage);
  }// uploded new file
          $productName   = $_POST['proname1'];
    $productPrice  = $_POST['proprice1'];
    $productDesc   = $_POST['prodes1'];
    $Categoryid    = $_POST['catid1'];
    $special_price = $_POST['special_price1']; 

    $query="UPDATE products SET product_name          ='$productName',
                 product_image         ='$newnameimage',
                 product_price         ='$productPrice',
                 product_desc          ='$productDesc',
                 product_special_price ='$special_price', 
                 cat_id                ='$Categoryid'
    WHERE product_id={$id} ";
    if(mysqli_query($conn,$query)){
     header("Location:manage_product.php");
          }// if for query
         else
           echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
 ?>
 <div class="section__content section__content--p30">
  <div class="container-fluid">
   <!-- Add Product-->
   <div class="row">
    <div class="col-lg-12">
     <div class="card">
      <div class="card-header">
        <?php
        if(isset($_GET['ide'])) 
         $type= "Update"; 
        else
         $type="Add";
        ?>
       <strong><?php echo $type; ?></strong> Product
      </div>
      <div class="card-body card-block">
       <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="text-input" class=" form-control-label">Product Name:</label>
         </div>
         <?php
           if(isset($_GET['ide'])) 
            $value= $products['product_name']; 
           else
           $value="";
           ?>
         <div class="col-12 col-md-9">
          <input type="text" id="text-input" name="proname" class="form-control" value="<?php echo $value;?>">
          <small class="form-text text-muted">Enter Name Of product.</small>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label  class=" form-control-label">Product Price:</label>
         </div>
          <?php
           if(isset($_GET['ide'])) 
            $pricevalue= $products['product_price']; 
           else
           $pricevalue="";
           ?>
         <div class="col-12 col-md-9">
          <input type="number" id="email-input" name="proprice" class="form-control" value="<?php echo $pricevalue;?>">
          <small class="help-block form-text">Enter Price Of product.</small>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label  class=" form-control-label">Product offer:</label>
         </div>
          <?php
           if(isset($_GET['ide'])) 
            $special_price= $products['product_special_price']; 
           else
           $special_price="";
           ?>
         <div class="col-12 col-md-9">
          <input type="number"  name="special_price" class="form-control" value="<?php echo $special_price;?>">
          <small class="help-block form-text">Enter offer price </small>
         </div>
        </div>

        <div class="row form-group">
         <div class="col col-md-3">
          <label for="textarea-input" class=" form-control-label">Product Description:</label>
         </div>
         <?php
           if(isset($_GET['ide'])) 
            $desvalue= $products['product_desc']; 
           else
           $desvalue="";
           ?>
         <div class="col-12 col-md-9">
          <textarea name="prodes" id="prodes" rows="9" class="form-control" ><?php echo $desvalue;?></textarea>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="select" class=" form-control-label">Select Category:</label>
         </div>
         <div class="col-12 col-md-9">
          <select name="catid" id="select" class="form-control">
           <option value="0">Please select</option>

           <?php 
           if(isset($_GET['ide'])){
           $query="SELECT * FROM category WHERE cat_id={$products['cat_id']}";
           $result=mysqli_query($conn,$query);
           $category=mysqli_fetch_assoc($result);

           ?>
           <option  selected="" value="<?php echo $products['cat_id'];?>"><?php echo $category['cat_name'];?></option>

           <?php 
               }
           $query="SELECT * FROM category";
           $result=mysqli_query($conn,$query);
           while($category=mysqli_fetch_assoc($result))
           {

           ?>
           <option value="<?php echo $category['cat_id'];?>"><?php echo $category['cat_name'];?></option>
          
          <?php } ?>
          </select>
         </div>
        </div>
        
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="file-multiple-input" class=" form-control-label">Insert Images:</label>
         </div>
         <div class="col-12 col-md-9">
          <?php if(isset($_GET['ide'])){ ?>
          <img src="images/products/<?php echo $products['product_image'] ;?>" style="width: 200px; height: 150px;" >
             <?php } ?>
          <input type="file" name="product_image" class="form-control-file">
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
   <!-- Add Product-->
   <!-- View Product-->
   <!-- Table-->
   <div class="row">
    <div class="col-md-12">
     <!-- DATA TABLE -->

     <h3 class="title-5 m-b-35">View Product</h3>
     <div class="table-data__tool-right" style="float: right;">
      <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#largeModal">
                                            <i class="zmdi zmdi-plus"></i>add Product</button>
     </div>
       <div class="table-responsive table-responsive-data2">

        <table class="table table-data2">
         <thead>
          <tr>
           <th>Number</th>
           <th>Name</th>
           <th>Price</th>
           <th>offer Price</th>
           <th>Category Name</th>
           <th>Image</th>
           <th>Description</th>
           <th></th>
          </tr>
         </thead>
         <tbody>
 <?php
 $query="SELECT * FROM products ";
  if(mysqli_query($conn,$query)){
  $result    =mysqli_query($conn,$query);
  $autonumber=0;
  while($products=mysqli_fetch_assoc($result)){
   $autonumber+=1;

 ?>
          <tr class="tr-shadow">
          
           <td style="line-height: 8;"><?php echo $autonumber;?></td>
           <td><?php echo $products['product_name'];?></td>
           <td><?php echo $products['product_price'];?></td>
           <td><?php echo $products['product_special_price'];?></td>

           <?php
           $proid        =$products['product_id'];


           $query2       ="SELECT cat_name
                    FROM category
                    INNER JOIN products
                    ON category.cat_id= products.cat_id
                    WHERE products.product_id=$proid";
            
           $result2       =mysqli_query($conn,$query2);
           $categoryname  =mysqli_fetch_assoc($result2);


            
           ?>
           <td><?php echo $categoryname['cat_name'];?></td>
           <td ><img src="images/products/<?php echo $products['product_image']; ?>" class="w-50  img-fluid rounded" style="width:  75px; height: 75px;"></td>
           <td><?php echo $products['product_desc'];?></td>
           <td>
            <div class="table-data-feature">
           <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
           <a href="manage_product.php?ide=<?php {echo $products['product_id'];} ?>">
            <i class="zmdi zmdi-edit"></i>
           </a> 
           </button>
           <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
            <a href="manage_product.php?idd=<?php {echo $products['product_id'];}?>">
             <i class="zmdi zmdi-delete"></i>
            </a>
           </button>
           <a data-toggle="modal" 
                                        data-proid      ="<?php echo $products['product_id'];?>"
                                        data-proName    ="<?php echo $products['product_name'];?>"
                                        data-prodes     ="<?php echo $products['product_desc'];?>"
                                        data-catid      ="<?php echo $products['cat_id'];?>"
                                        data-proprice   ="<?php echo $products['product_price'];?>"
                                        data-spprice    ="<?php echo $products['product_special_price'];?>"
                                        data-image      ="<?php echo $products['product_image'];?>"
                                        class="open btn btn-warning" id="editplz">Edit</a>
          </div>
           </td>
          </tr>
  <?php
  }//product data
 }// if query

 ?>  
 
            </tbody>
        </table>
       </div>
       <!-- END DATA TABLE -->
      </div>
     </div>
     <!--Table -->     
     <!-- View Product-->
    </div>
   </div>
  </div>
  <!-- modal large -->
   <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
      <div class="modal-header">
      
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <div class="row">
    <div class="col-lg-12">
     <div class="card">
      <div class="card-header">
       <strong>Add</strong> Product
      </div>
      <div class="card-body card-block">
       <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="text-input" class=" form-control-label">Product Name:</label>
         </div>
        
         <div class="col-12 col-md-9">
          <input type="text" id="text-input" name="proname" class="form-control" value="">
          <small class="form-text text-muted">Enter Name Of product.</small>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label  class=" form-control-label">Product Price:</label>
         </div>
         <div class="col-12 col-md-9">
          <input type="number" id="email-input" name="proprice" class="form-control" value="">
          <small class="help-block form-text">Enter Price Of product.</small>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label  class=" form-control-label">Product offer:</label>
         </div>
         <div class="col-12 col-md-9">
          <input type="number"  name="special_price" class="form-control" value="">
          <small class="help-block form-text">Enter offer price </small>
         </div>
        </div>

        <div class="row form-group">
         <div class="col col-md-3">
          <label for="textarea-input" class=" form-control-label">Product Description:</label>
         </div>
         <div class="col-12 col-md-9">
          <textarea name="prodes" id="prodes" rows="9" class="form-control" ></textarea>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="select" class=" form-control-label">Select Category:</label>
         </div>
         <div class="col-12 col-md-9">
          <select name="catid" id="select" class="form-control">
           <option value="0">Please select</option>
           <?php 
               
           $query="SELECT * FROM category";
           $result=mysqli_query($conn,$query);
           while($category=mysqli_fetch_assoc($result))
           {

           ?>
           <option value="<?php echo $category['cat_id'];?>"><?php echo $category['cat_name'];?></option>
          
          <?php } ?>
          </select>
         </div>
        </div>
        
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="file-multiple-input" class=" form-control-label">Insert Images:</label>
         </div>
         <div class="col-12 col-md-9">
          <input type="file" name="product_image" class="form-control-file">
         </div>
        </div>
        <div class="card-footer">
      
        <button type="submit" class="btn btn-primary" name="submit" >
          <i class="fa fa-dot-circle-o" ></i> Add
         </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

             </div>
       </form>
      </div>
      
     </div>

    </div>
   </div>
   <!-- Add Product-->
      </div>
      
     </div>
    </div>
   </div>
   <!-- end modal large -->
    <!-- modal large -->
   <div class="modal fade" id="largeModal1" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
      <div class="modal-header">
      
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
      </div>
      <div class="modal-body">
       <div class="row">
    <div class="col-lg-12">
     <div class="card">
      <div class="card-header">
       <strong>Update</strong> Product
      </div>
      <div class="card-body card-block">
       <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="text-input" class=" form-control-label">Product Name:</label>
         </div>
        
         <div class="col-12 col-md-9">
          <input type="text" id="text-input" name="proname1" class="form-control" value="">
          <small class="form-text text-muted">Enter Name Of product.</small>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label  class=" form-control-label">Product Price:</label>
         </div>
         <div class="col-12 col-md-9">
          <input type="number" id="email-input" name="proprice1" class="form-control" value="">
          <small class="help-block form-text">Enter Price Of product.</small>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label  class=" form-control-label">Product offer:</label>
         </div>
         <div class="col-12 col-md-9">
          <input type="number"  name="special_price1" class="form-control" value="">
          <small class="help-block form-text">Enter offer price </small>
         </div>
        </div>

        <div class="row form-group">
         <div class="col col-md-3">
          <label for="textarea-input" class=" form-control-label">Product Description:</label>
         </div>
         <div class="col-12 col-md-9">
          <textarea name="prodes1" id="prodes1" rows="9" class="form-control" ></textarea>
         </div>
        </div>
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="select" class=" form-control-label">Select Category:</label>
         </div>
         <div class="col-12 col-md-9">
          <select name="catid1" id="select" class="form-control">
           <option value="0">Please select</option>
           <?php 
               
           $query="SELECT * FROM category";
           $result=mysqli_query($conn,$query);
           while($category=mysqli_fetch_assoc($result))
           {

           ?>
           <option value="<?php echo $category['cat_id'];?>"><?php echo $category['cat_name'];?></option>
          
          <?php } ?>
          </select>
         </div>
        </div>
        
        <div class="row form-group">
         <div class="col col-md-3">
          <label for="file-multiple-input" class=" form-control-label">Insert Images:</label>
         </div>
         <div class="col-12 col-md-9">
          <img src="" style="width: 200px; height: 150px;" name="proimg">
          <input type="file" name="product_image" class="form-control-file">
         </div>
        </div>
        <div class="card-footer">
      
        <button type="submit" class="btn btn-primary" name="submit1" >
          <i class="fa fa-dot-circle-o" ></i> Update
         </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

             </div>
       </form>
      </div>
      
     </div>

    </div>
   </div>
   <!-- edit Product-->
      </div>
      
     </div>
    </div>
   </div>
   <!-- end modal large -->
  <?php include_once('include/admin_footer.php'); ?>
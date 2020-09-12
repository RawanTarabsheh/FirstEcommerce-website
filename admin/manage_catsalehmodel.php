    <?php   ob_start();
    include_once ('include/admin_header.php'); 
    require      ('include/connection.php'); 
    
if (isset($_POST['submit'])) {
    $name      = $_POST['name'];
    $size      = $_POST['size'];
    $designe   = $_POST['designe'];

    $img_name      =$_FILES['cat-img']['name'];
    $temp_name     =$_FILES['cat-img']['tmp_name'];
    $path          ='images/';
    //perform qurry saving the instruction in a string
    $qurry = "INSERT INTO categories(category_name,category_size,category_desinge,cat_img)
              values('$name','$size','$designe','$img_name')";
    mysqli_query($conn, $qurry);
    header("Location: manage_cat.php");
    exit(); // stop the script continuing just in case
}
if ($_GET['action'] && $_GET['id']) {
    if ($_GET['action'] == 'delete') {
        $qurry2 = "DELETE FROM categories WHERE category_ID ={$_GET['id']}";
        mysqli_query($conn, $qurry2);
        header("location:manage_cat.php");
        exit();
    }
}
if (isset($_POST['submit1'])) {
    $name1      = $_POST['name1'];
    $size1      = $_POST['size1'];
    $designe1   = $_POST['designe1'];
    $img_name   =$_FILES['cat-img']['name'];
    $temp_name  =$_FILES['cat-img']['tmp_name'];
    $path       ='images/';
    
    $qurry3 = "UPDATE categories SET category_name          ='$name1',
                                 category_size              ='$size1',
                                 category_desinge           ='$designe1',
                                 cat_img                    ='$img_name'
                                 WHERE category_ID          ={$_POST['cat_id']}";
    echo "<h1>" . $_GET['cat_id'] . "</h1>";
    mysqli_query($conn, $qurry3);
    $qurry4    = "SELECT * FROM categories WHERE category_ID={$_POST['cat_id']}";

    header("location:manage_cat.php");
    exit();
}
//$qurry4      = "SELECT * FROM categories WHERE category_ID={$_GET['id']}";
//$result4     = mysqli_query($conn, $qurry4);
//$oldData     = mysqli_fetch_assoc($result4);


include_once('includs/admin_header.php');

?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".open", function() {
        //var myBookId = $(this).data('catid');
        var myBookIdd = this.getAttribute('data-catid');
        var myCatName = this.getAttribute('data-catName');
        var myCatSize = this.getAttribute('data-catSize');
        var myCatdesigne = this.getAttribute('data-catDesinge');
        //console.log(myCatName);
        //console.log(typeof(myCatName));
        //console.log(this.getAttribute('data-catName'));
        $('input[name=cat_id]').val(myBookId);
        $('input[name=cat_id]').val(myBookIdd);
        $('input[name=name1]').val(myCatName);
        $('input[name=size1]').val(myCatSize);
        $('input[name=designe1]').val(myCatdesigne);
        console.log(myBookId);
        // As pointed out in comments, 
        // it is unnecessary to have to manually call the modal.
        $('#mediumModal1').modal('show');
    });
</script>
<div class="row pt-5 pl-3">
    <div class="col-md-11 pl-3">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">data table</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">All Categories</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="time">
                        <option selected="selected">Today</option>
                        <option value="">3 Days</option>
                        <option value="">1 Week</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters</button>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#mediumModal">
                    <i class="zmdi zmdi-plus"></i>add category</button>
                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <select class="js-select2" name="type">
                        <option selected="selected">Export</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
            </div>
        </div>
        <!-- modal medium -->
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage Categories</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Creat category</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">category name</label>
                                                <input id="cc-pament" name="name" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">category size</label>
                                                <input id="cc-pament" name="size" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">category designe</label>
                                                <input id="cc-pament" name="designe" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                            <input class='btn btn-info' name='cat-img' type='file' value='upload' style="width: 130px;">
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">Create
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end modal medium -->
        <div class="modal fade" id="mediumModal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Edit Categories</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Edit category</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" class="form1" enctype="multipart/form-data">
                                            <div class="form-group">

                                                <input id="cc-pament" class="form-control" type='hidden' name='cat_id' id="cattt_id" value="">
                                            </div>
                                            <div class="form-group">


                                                <label for="cc-payment" class="control-label mb-1">category name</label>
                                                <input id="cc-pament" id="name1" name="name1" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">category size</label>
                                                <input id="cc-pament" id="size1" name="size1" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">category designe</label>
                                                <input id="cc-pament" id="designe1" name="designe1" type="text" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                            <input class='btn btn-info' name='cat-img' type='file' value='upload' style="width: 130px;">
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit1">Edit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal2 end -->

        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>
                            <label class="au-checkbox">
                                <input type="checkbox">
                                <span class="au-checkmark"></span>
                            </label>
                        </th>
                        <th>category id</th>
                        <th>category name</th>
                        <th>category size</th>
                        <th>category designe</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qurry          = "SELECT * FROM categories";
                    $result         = mysqli_query($conn, $qurry); //alaways after the select
                    //we use while since it will keep going as long as i have element in the DB
                    while ($cat   = mysqli_fetch_assoc($result)) {
                        echo "<tr class='tr-shadow'>
                             <td>
                                <label class='au-checkbox'>
                                    <input type='checkbox'>
                                    <span class='au-checkmark'></span>
                                </label>
                            </td>";
                        echo "<td>{$cat['category_ID']}</td>";
                        echo "<td>{$cat['category_name']}</td>";
                        echo "<td>{$cat['category_size']}</td>";
                        echo "<td>{$cat['category_desinge']}</td>";
                        echo "<td><img src='images/{$cat['cat_img']}' style='height : 60px;width:60px;'></td>";  
                        echo "<td>
                                 <form method='get' action=''>
                                  <div class='table-data-feature'>
                                                         
                                      <a data-toggle='modal' 
                                        data-catid      ='{$cat['category_ID']}'
                                        data-catName    ='{$cat['category_name']}'
                                        data-catSize    ='{$cat['category_size']}'
                                        data-catDesinge ='{$cat['category_desinge']}'
                                        
                                        class='open btn btn-warning' id='editplz'>Edit</a>
                          
                                     <button class='item' data-toggle='tooltip' data-placement='top' title='Delete' name='action' value='delete' />
                                        <i class='zmdi zmdi-delete'></i>
                                     </button>
                                     <input type='hidden' name='cat_id' value='{$cat['category_ID']}' />
                                     <input type='hidden' name='id' value= '{$cat['category_ID']}' >
                                 </div>
                               </form>            
                             </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php include_once('includs/admin_footer.php') ?>
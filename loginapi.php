<?php ob_start();
session_start();
	require      ('include/connection.php'); ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#ok").hide();
                 $("#no").hide();
                $("#c_email").blur(function(){
                    var email=$("#c_email").val();
                    //alert(email);
                   $.ajax(
                            {
                                type: "POST",
                                url: "getemail.php",
                                data :
                                {
                                    "email": email,
                                },  
                                success: function(response)
                                {
                               console.log(response);
                                if(response=="email founded")
                                {
                                  $("#ok").show();
                                  $("#no").hide();  
                                }
                                

                            else
                            {
                                 $("#ok").hide();
                                 $("#no").show();

                            }
                                }
                            });
                });

            });

        </script>

<?php
	if(isset($_POST['submit']))
	{
		$email    =$_POST['email'];
        $password =md5($_POST['password']);

        $query="SELECT * FROM customers WHERE customer_email='$email' AND customer_password='$password'";
        $login=mysqli_query($conn,$query);
        //if(!empty($admin['admin_id']))
        if(mysqli_num_rows($login) == 1)
        {
        	$customer=mysqli_fetch_assoc($login);
        	 if(isset($_POST['remember'])) {
                $_SESSION['remmeber_id']=$customer['customer_id'];
        	 	//setcookie ("admin_email",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));        	
        }
        	$_SESSION['id']=$customer['customer_id'];
             header("Location:index.php");
        }
        else
        {
        	$error="User Not Found";
        }
	}
	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                        	<?php
                        	if(isset($error))
                        	{
                        		echo '<div class="alert alert-danger">'.$error.'</div>';
                        	}
                        	?>
                            <form action="" method="post">
                                <div class="form-group">
                                   <?php
                                   if(isset($_SESSION['remmeber_id']))
                                   {
                                    $query1="SELECT * FROM customers WHERE customer_id={$_SESSION['remmeber_id']}";
                                    $remember=mysqli_fetch_assoc(mysqli_query($conn,$query1));
                                    $email=$remember['customer_email'];
                                    $password=$remember['customer_password'];
                                   }
                                   else
                                   {
                                     $email="";
                                    $password="";
                                   }
                                   ?>
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="<?php echo $email;?>" id="c_email">
                                    <div >
                                    <i  style="font-size: 20px;color: green;" id="ok">✅</i>
                                     <i  style="font-size: 20px;color: red;" id="no">❎</i></div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password"  value="<?php echo $password;?>">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">sign in</button>
                              
                            </form>
                           <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="customer_register.php">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
        </div>

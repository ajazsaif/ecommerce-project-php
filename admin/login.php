<?php 
error_reporting(0);
session_name('medicare_admin');
session_start();
session_regenerate_id();
 include("includes/function.php");
    define ('__WEBROOT__', "http://localhost/ecommerce-project-php/admin");
    if(isset($_SESSION["admin-email"]) && ($_SESSION["role"] == "admin")){
         header("location:".__WEBROOT__."/index.php");
    }

 
    //sanitize input and login processs
    if(isset($_POST["submit"])){
        include("includes/dbcontroller.php");

        $db_handle  =  new DBController();
        $email          =   $db_handle->escapeString(valid_input(strtolower($_POST["email"])));
        $password       =   $db_handle->escapeString(valid_input($_POST["password"]));
        if(empty($email) or empty($password)){
            $err_msg    =   "Field can'nt be left blank !";
        }
//                        elseif(validate_email($email) == "error"){
//                            $err_msg    =   "Invalid email id Format !";
//                        }
        else{
            $check_query    =   " select username,role,pass from admin_user where username = '".$email."'";
            if($db_handle->numRows($check_query) == 1){
            $Row        =   $db_handle->RunQuery($check_query);
            $db_handle->Close();
            unset($db_handle);
            $AdminEmail = $Row[0]["username"];  
            $AdminPass  = $Row[0]["pass"];  
            $AdminRole  = $Row[0]["role"];
            if(($AdminEmail == $email) && ($AdminRole == "admin")){
                if(password_verify($password, $AdminPass)){
                    $_SESSION["admin-email"]    =   $AdminEmail;
                    $_SESSION["role"]           =   $AdminRole;
                    redirect_page_url(__WEBROOT__."/index.php");
                }
                else{
                    $err_msg = "Invalid Email Or Password !";
                }
                
            }
                else{
                    $err_msg = "Invalid Email Or Password !";
                }
        }
     else{
            $err_msg = "Invalid Email Or Password !";
        }

        } 
    }
        
?>
<!DOCTYPE html>
<html>
<head>
    <title>wiseinmind | Login</title>
    <?php include("./includes/head-meta.php"); ?>
</head>
<body class="hold-transition login-page">
    <div style="background-color:rgba(0,0,0,0.5);position:fixed;top:0;left:0;right:0;bottom:0"></div>
    <div class="login-box col-md-4">
        <div class="login-box-body">
            <div class="login-logo">
            <img src="<?php echo __WEBROOT__; ?>/images/logo.png" width="100%" />
        <?php 
               //err msg display here
            if(isset($err_msg)){
                echo "<span style='color:white;'>$err_msg</span>"; 
            }
            ?>
        </div>
            <form action="<?php echo htmlspecialchars('');?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="toggleswitch round"></span>
                        </label>
                        <label style="color:#fff;float:right">Remember me</label>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
                    </div>
                </div>
            </form>
            <a href="javascript:void(0);" style="color:#fff;">I forgot my password</a>
        </div>
    </div>
</body>
    <?php include("./includes/js-meta.php"); ?>
</html>
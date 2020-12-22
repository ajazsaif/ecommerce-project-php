<?php
require_once('includes/top.php');
$page = "login";
if(isset($_SESSION['vemail']) && !empty($_SESSION['vemail'])){
    redirect_page_url(__WEBROOT__.'/useradmin/profile.php');
}
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title><?php echo $page_title;?> | Login / Register</title>
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="">
    <?php if(isset($_GET['resperr']) || isset($_GET['err']) || isset($_GET['email'])){ ?>
    <style>
    .modal { padding-right: 0px;background-color: rgba(4, 4, 4, 0.8); }
    .modal-dialog { top: 20%;width: 100%;position: absolute; }
    .modal-content { border-radius: 0px;border: none;top: 40%; }
    .modal-body {color: white; } 
    </style> 
    <?php } ?>
    <style type="text/css">.errForm{color:red;}</style>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li>Login / Register</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mb40">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form id="login_form" action="<?php echo htmlspecialchars(__WEBROOT__.'/modules/login.php');?>" method="post" autocomplete="off" class="create-account-form" >
                        <span class="heading-title">Login</span>
                        <div class="form-group">
                            <label>Email address</label>
                            <input class="form-control" type="email" name="log_email">
                        </div>	
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="log_pass">
                        </div>
                        <div class="form-group">
                            <button id="btn-login-submit" name="login_check" type="submit" class="main-btn">Login</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-8">
                    <form action="<?php echo htmlspecialchars(__WEBROOT__.'/modules/signup.php');?>" method="post" autocomplete="off" id="register-form" class="create-account-form" >
                        <span class="heading-title">Register</span>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="name">
                            </div>	
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lname">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone No.</label>
                                <input class="form-control" type="text" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input class="form-control" type="password" name="pws">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group col-md-12">
                                <button id="btn-signup-submit" name="signup" type="submit" class="main-btn">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("./includes/footer.php"); ?>
    <!--model start here-->
<?php 
    if(isset($_GET['suc']) && $_GET['suc'] == 'suc'){
   
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content">
      <div class="modal-body">
      <h2>Congratulation!</h2>
      <h4>Thanks For Registration.</h4>
      </div>
    </div>
  </div>
</div>
    <?php } ?>
    <?php 
    
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'errplog'){
      
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content" style="background-color:#8B0000;">
      <div class="modal-body" >
      <h2>OOPS!</h2>
      <h4>Wrong login details !</h4>
      </div>
    </div>
  </div>
</div>
    <?php } } ?>
    <?php 
    
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'err'){
      
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content" style="background-color:#8B0000;">
      <div class="modal-body" >
      <h2>OOPS!</h2>
      <h4>Email Id is required !</h4>
      </div>
    </div>
  </div>
</div>
    <?php } } ?>
    <?php 
    
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'errp'){
      
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content" style="background-color:#8B0000;">
      <div class="modal-body" >
      <h2>OOPS!</h2>
      <h4>Password is required !</h4>
      </div>
    </div>
  </div>
</div>
    <?php } } ?>
    <?php 
    
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'errm'){
      
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content" style="background-color:#8B0000;">
      <div class="modal-body" >
      <h2>OOPS!</h2>
      <h4>Invalid Email Id !</h4>
      </div>
    </div>
  </div>
</div>
    <?php } } ?>

    <?php 
    
    if(isset($_GET['email'])){
      
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content" style="background-color:#8B0000;">
      <div class="modal-body" >
      <h2>OOPS!</h2>
      <h4>Email id already exist !</h4>
      </div>
    </div>
  </div>
</div>
    <?php } ?>
    
    <?php 
    if(isset($_GET['err']) && $_GET['err'] == 'err'){
   
    ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="float: none;left: 0;margin: 0 auto;right: 0;width: 300px;">
    <div class="modal-content" style="background-color:#8B0000;">
      <div class="modal-body" >
      <h2>OOPS!</h2>
      <h4>Something is wrong.</h4>
      </div>
    </div>
  </div>
</div>
    <?php } ?>
</body>
    <?php include("./includes/js-meta.php"); ?>
<?php 
    if(isset($_GET['suc']) && $_GET['suc'] == 'suc'){
   
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } ?>
    <?php 
    if(isset($_GET['err']) && $_GET['err'] == 'err'){
   
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } ?>
    <?php 
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'errplog'){
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } } ?>
    <?php 
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'err'){
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } } ?>
    <?php 
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'errp'){
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } } ?>
    <?php 
    if(isset($_GET['resperr'])){
        if(base64_decode($_GET['resperr']) == 'errm'){
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } } ?>

    <?php 
    if(isset($_GET['email'])){
    ?>
    <script type="text/javascript"> 
        $(window).on('load',function(){ 
            $('.bs-example-modal-lg').modal('show'); 
            setTimeout(function() {$('.bs-example-modal-lg').modal('hide');}, 3000);
        }); 
    </script>
    <?php } ?>
    <script src="<?= __WEBROOT__.'/js/jquery.validate.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        var addCategoryForm = $("#login_form");
        var validator = addCategoryForm.validate({
            errorClass:'errForm',
            rules:{
                log_email:{ required : true, email:true },
                log_pass : { required : true}
            },
            messages:{
                log_email :{ required : "Email is required" },      
                log_pass : { required : "Password is required"}
            },
            submitHandler:function(form){
                $('#btn-login-submit').prop('disabled', 'disabled');
                $('#btn-login-submit').val('Waiting....');
                form.submit();
            }
        });
        //load state
    });
    $(document).ready(function(){
        var addCategoryForm = $("#register-form");
        var validator = addCategoryForm.validate({
            errorClass:'errForm',
            rules:{
                name:{ required : true},
                lname:{ required : true},
                email:{ required : true},
                phone:{ required : true},
                pws : { required : true},
                password : { required : true, equalTo: '[name="pws"]'},
            },
            messages:{
                name :{ required : "First Name is required" },      
                lname :{ required : "Last Name is required" },      
                email :{ required : "Eamil is required" },      
                phone :{ required : "Phone number is required" },       
                pws : { required : "Password is required"},
                password : { required : "Password is required"},
            },
            submitHandler:function(form){
                $('#btn-signup-submit').prop('disabled', 'disabled');
                $('#btn-signup-submit').val('Waiting....');
                form.submit();
            }
        });
        //load state
    });
    </script>
</html>
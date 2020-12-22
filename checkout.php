<?php
include("./includes/top.php");
//unset($_SESSION['chkoutenc']);
//if(empty($_SESSION['vemail']) || ($_SESSION['plogin'] != 'true')){
//    redirect_page_url(__WEBROOT__.'/login.php');
//}
//unset checkout session variable here if visitor is coming directly checkout page
//fecth user address from database
    $get_uid_details=   "SELECT id FROM `users` WHERE email = '".$_SESSION['vemail']."' ";
    $vistor_result  =   $db_handle->RunQuery($get_uid_details);
    $uidss          =   $vistor_result[0]['id'];
    //pre($vistor_result);

$vistor_billing_address =   "SELECT * FROM `user_address` WHERE uid = ".$uidss." ";
if($db_handle->numRows($vistor_billing_address)>0){
   $vistor_details  =    $db_handle->RunQuery($vistor_billing_address);
}
define('LOGICHEAD',TRUE);
include("logic.php");
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("./includes/head-meta.php"); ?>
    <title>Checkout</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <script type="text/javascript">
        function clear_storage(){
            localStorage.removeItem("__dillionecom");
        }
    </script> 
    <?php if(isset($_GET['resperr']) || isset($_GET['err']) || isset($_GET['email'])){ ?>
    <style>
    .modal { padding-right: 0px;background-color: rgba(4, 4, 4, 0.8); }
    .modal-dialog { top: 20%;width: 100%;position: absolute; }
    .modal-content { border-radius: 0px;border: none;top: 40%; }
    .modal-body {color: white; } 
    </style> 
    <?php } ?>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    <?php 
        if($sucess){
            echo "<script>clear_storage();</script>";
            redirect_url(__WEBROOT__.'/thanks.php?ord='.$order_id);
        }
    ?>
    
    <section class="breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo __WEBROOT__; ?>">Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section class="checkout-area">
			<div class="container">
				<div class="row">
                    <form action="<?php echo htmlspecialchars('');?>" method="post" autocomplete="off" method="post" >
                        <input type="hidden" name="items" id="local_item">
                        <div class="col-md-8">
                            <div class="checkout-left-area">
                                <div class="panel-group" id="accordion">

                                    <div class="panel panel-default actives">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                            <span>1</span>Billing Information</a>
                                          </h4>
                                        </div>
                                        <div id="collapse2" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>First Name <span class="required">*</span></label>										
                                                            <input type="text" placeholder="" class="form-control" name="bfname" value="<?php echo $vistor_details[0]['fname'];?>" reuired />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Last Name <span class="required">*</span></label>										
                                                            <input type="text" name="blname" value="<?php echo $vistor_details[0]['lname'];?>" required placeholder="" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Email <span class="required">*</span></label>										
                                                            <input type="email" placeholder="" class="form-control" name="bemail" value="<?php echo $vistor_details[0]['email'];?>" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Phone No. <span class="required">*</span></label>										
                                                            <input type="text" placeholder="" class="form-control" name="bphone" value="<?php echo $vistor_details[0]['phone'];?>" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>City <span class="required">*</span></label>
                                                            <input type="text" placeholder="City" value="<?php echo $vistor_details[0]['city'];?>" name="bcity" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>State <span class="required">*</span></label>
                                                            <input type="text" placeholder="State" value="<?php echo $vistor_details[0]['state'];?>" name="bstate" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Country <span class="required">*</span></label>
                                                            <input type="text" placeholder="Country" value="<?php echo $vistor_details[0]['country'];?>" name="bcountry" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Zip Code <span class="required">*</span></label>
                                                            <input type="text" placeholder="Zip code" value="<?php echo $vistor_details[0]['zip_code'];?>" name="bzip_code" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Address <span class="required">*</span></label>
                                                            <input type="text" placeholder="Street address" class="form-control" value="<?php echo $vistor_details[0]['address'];?>" name="baddress" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">									
                                                            <input type="text" placeholder="Apartment, suite, unit etc. (optional)" value="<?php echo $vistor_details[0]['address_alt'];?>" name="baddress_opt" />
                                                        </div>
                                                    </div>
                                                    <?php if(empty($_SESSION['vemail'])){ ?>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list create-acc">	
                                                            <label>
                                                                <input id="cbox" type="checkbox" name="login-radio" /> Create an account?</label>
                                                        </div>
                                                        <div id="cbox_info" class="checkout-form-list create-account">

                                                            <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Password  <span class="required">*</span></label>
                                                                    <input type="password" placeholder="Password" name="pws" id="pass" />	
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Confirm Password  <span class="required">*</span></label>
                                                                    <input type="password" name="password" id="re_pass"  placeholder="Confirm Password" />
                                                                    <span id="alt" style="color:#ff4557;"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>							
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                    <span>2</span>Diffrent Shipping</a>
                                            </h4>
                                        </div>
                                        <div id="collapse3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="different-address">
                                                    <div class="ship-different-title">
                                                        <h3>
                                                            <label><input id="ship-box" value="bill_ship_same" name="bill_ship" type="checkbox" /> Ship to a different address?</label>

                                                        </h3>
                                                    </div>
                                                    <div id="ship-box-info">
                                                        <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>First Name <span class="required">*</span></label>										
                                                            <input type="text" placeholder="First Name" name="sfname" value="<?php echo $vistor_detailss[0]['fname'];?>" class="form-control last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Last Name <span class="required">*</span></label>										
                                                            <input type="text" placeholder="Last Name" name="slname" value="<?php echo $vistor_detailss[0]['lname'];?>" class="form-control last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Email <span class="required">*</span></label>										
                                                            <input type="email" name="semail" value="<?php echo $vistor_detailss[0]['email'];?>" placeholder="Email" class="form-control last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Phone No. <span class="required">*</span></label>										
                                                            <input type="text" name="sphone" value="<?php echo $vistor_detailss[0]['phone'];?>" placeholder="Phone No." class="form-control last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>City <span class="required">*</span></label>
                                                            <input type="text" name="scity" value="<?php echo $vistor_detailss[0]['city'];?>" placeholder="City" class="form-control last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>State <span class="required">*</span></label>
                                                            <input type="text" name="sstate" value="<?php echo $vistor_detailss[0]['state'];?>" placeholder="State" class="last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Country <span class="required">*</span></label>
                                                            <input type="text" name="scountry" value="<?php echo $vistor_detailss[0]['country'];?>" placeholder="Country" class="last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Zip Code <span class="required">*</span></label>
                                                            <input type="text" value="<?php echo $vistor_detailss[0]['zip_code'];?>" placeholder="Zip Code" name="szip_code" class="last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Address <span class="required">*</span></label>
                                                            <input type="text" name="saddress" value="<?php echo $vistor_detailss[0]['address'];?>" placeholder="Street address" class="form-control last" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">									
                                                            <input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="saddress_opt" value="<?php echo $vistor_detailss[0]['address_alt'];?>" class="last" />
                                                        </div>
                                                    </div>
                                                </div>
                                                    </div>
                                                    <div class="order-notes">
                                                        <div>
                                                            <label>Order Notes</label>
                                                            <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." name="smessage" ></textarea>
                                                        </div>									
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            <span>3</span>Payment Information</a>
                                          </h4>
                                        </div>
                                        <div id="collapse4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="payment-met">
                                                    <div id="payment-form">
                                                        <ul class="payment-item">
                                                            <?php 
                                                            //get payment options
                                                            $payment_optionss = "SELECT * FROM `payment_option` ORDER BY serial_no ASC";
                                                            if($db_handle->numRows($payment_optionss) > 0){

                                                                $payment_optionsR = $db_handle->RunQuery($payment_optionss);
                                                                //$ik = 0;
                                                                foreach ($payment_optionsR as $key=> $payment_optionsVal) {
                                                                    //$ik++;
                                                        ?>
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="payment_mmode" value="<?php echo $payment_optionsVal['id'];?>" <?php echo $key == 0 ? 'checked' : ''; ?> ><?php echo $payment_optionsVal['city'];?>
                                                                </label>
                                                                <span class="<?= $payment_optionsVal['id'] ?> PaymentBox" style="display: <?= $key == 0 ? 'block' : 'none' ?>;"><?php echo $payment_optionsVal['name'];?></span>
                                                            </li>
                                                             <?php } } ?>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <input type="submit" id="submit" name="corder" class="main-btn" value="Confirm Order" />
                        </div>
                        
                    </form>
					<div class="col-md-4">
						<div class="checkout-right-area">
							<h3>YOUR CHECKOUT PROGRESS</h3>
							<ul>
								<li><a data-toggle="collapse" href="#collapse2" data-parent="#accordion"> Billing Address</a></li>
								<li><a data-toggle="collapse" href="#collapse3" data-parent="#accordion"> Shipping Address</a></li>
								<li><a data-toggle="collapse" href="#collapse4" data-parent="#accordion"> Payment Method</a></li>
							</ul>
						</div>
                        
                        <div class="checkout-right-area mt40">
							<h3>YOUR ORDER OVERVIEW</h3>
                            <div class="table-responsive" id="checkout_cart">
                                
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</section>
    
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
    <?php include("./includes/footer.php"); ?>
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
    <script>
    $(document).ready(function(){
          $("input").keyup(function(){
               var pass1 = $("#pass").val();
               var pass2 = $("#re_pass").val();
               
               if(pass2.length > 0){
                   if(pass1 != pass2)
                   {
                     $("#submit").attr('disabled',true);
                     $("#alt").text("*Re Password Should be Same as Password*");
                   }
                   if(pass1 == pass2) {
                       $("#submit").attr('disabled',false);
                        $("#alt").text(" ");
                   }
               }
                      
          });
         
    });
</script>
    
    <script type="text/javascript">
        $(document).ready(function(){
           $('input[type="radio"]').change(function(){
               var inputValue = $(this).attr("value");
               var targetBox = $("." + inputValue);
               $(".PaymentBox").not(targetBox).hide();
               $(targetBox).slideToggle();
           });
       });
        /*Create an account toggle function*/
    $('#ship-box').on('click', function () {
        $('#ship-box-info').slideToggle(1000);
         if($(this).is(':checked')) {
            $('.last').prop('required',true);
            }
            if($(this).is(":not(:checked)")){
                $('.last').prop('required',false);
            }
    });
     /*Create an account toggle function*/
    $('#cbox').on('click', function () {
        $('#cbox_info').slideToggle(900);
        if($(this).is(':checked')) {
            $('#pass').prop('required',true);
        }
        if($(this).is(":not(:checked)")){
            $('#pass').prop('required',false);
        }
    });
    </script>
    <script>
    jQuery(document).ready(function($) {
         $('#local_item').val(localStorage.getItem('__dillionecom'));
        var retrievedObject = null;
        if (localStorage) {
            retrievedObject = localStorage.getItem('__dillionecom');
        } else {
            alert("Error: This browser is still not supported; Please use google chrome!");
        }
        var parsedArray = null;
        if (retrievedObject){
            parsedArray = JSON.parse(retrievedObject);    
        }
        if(parsedArray == null){
            $("#id-cart-value").html(0);
        }else{
            $("#id-cart-value").html(parsedArray.length);
        }

        $.ajax({
            type: "POST",
            url: '<?php echo __WEBROOT__; ?>/ajax/cart_items_check.php',          
            data: {
                myData:localStorage.getItem('__dillionecom')
            },
            cache: false,
            //dataType: "JSON",
            success: function (data) {
                //console.log(data);
                $("#checkout_cart").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                  //alert('error');
              } 
        });

        var url="<?php echo __WEBROOT__;?>";
        if(parsedArray == ''){
           window.location.replace(url);
        }
        
    });
</script>
</html>